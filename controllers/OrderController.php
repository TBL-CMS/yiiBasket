<?php

class OrderController extends Controller
{
	
	/** Creation of a new Order 
	 * Before we create a new order, we need to gather Customer information.
	 * If the user is logged in, we check if we already have customer information.
	 * If so, we go directly to the Order confirmation page with the data passed
	 * over. Otherwise we need the user to enter his data, and depending on
	 * whether he is logged in into the system it is saved with his user 
	 * account or once just for this order.	
	 */
	public function actionCreate($customer = null, $payment_method = null)
	{
		// Shopping cart is empty, taking a order is not allowed yet
		if(ShopBasket::getCartContent() == array())
			$this->redirect(array('/yiiBasket/basket/review'));
	
		//Set State
		if(isset($_POST['PaymentMethod'])) 
			Yii::app()->user->setState('payment_method', $_POST['PaymentMethod']);
		if(isset($_POST['Order'])) 
			Yii::app()->user->setState('order_options', $_POST['Order']);
		
		//Check if everything is there
		if(!$customer)
			$customer = Yii::app()->user->getState('customer_id');
		if(!Yii::app()->user->isGuest && !$customer)
			$customer = Customer::model()->find('user_id = :user_id ', array(':user_id' => Yii::app()->user->id));
		if(!$payment_method)
			$payment_method = Yii::app()->user->getState('payment_method');
				
		if(!$customer) {
			$this->render('/account/register', array(
						'action' => array('/account/register')));
			Yii::app()->end();
		}
		if(!$payment_method) {
			$this->render('paymentMethod', array(
						'customer' => ShopBasket::getCustomer()));
			Yii::app()->end();
		}

		//Complete the Order!
		if($customer && $payment_method) {
			if(is_numeric($customer))
				$customer = Customer::model()->findByPk($customer);
				
			$this->render('create', array(
				'customer' => $customer,
			));
		}
	}
	
	public function actionConfirm() {
		
		Yii::app()->user->setState('order_comment', @$_POST['Order']['Comment']);
		if(isset($_POST['accept_terms']) && $_POST['accept_terms'] == 1) {
		
			$order = new Orders();
			//$order->applyOrderOptions();

			$customer = ShopBasket::getCustomer();
			$cart = ShopBasket::getCartContent();

			$order->customer_id = $customer->id;

			// fetch delivery data
			$address = new DeliveryAddress();
			if($customer->deliveryAddress)
				$address->attributes = $customer->deliveryAddress->attributes;
			else
				$address->attributes = $customer->address->attributes;
			$address->save();

			$order->delivery_address_id = $address->id;

			// fetch billing data
			$address = new BillingAddress();
			if($customer->billingAddress)
				$address->attributes = $customer->billingAddress->attributes;
			else
				$address->attributes = $customer->address->attributes;
			$address->save();
			$order->billing_address_id = $address->id;
			$order->payment_method = Yii::app()->user->getState('payment_method');
			$order->comment = Yii::app()->user->getState('order_comment');
			$order->status = 'new';

			if($order->save()) {
				foreach($cart as $position => $product) {
					$position = new OrdersItems;
					$position->order_id = $order->id;
					$position->product_id = $product['product_id'];
					$position->amount = $product['amount'];
					$position->specifications = json_encode($product['Variations']);
					$position->shipping_method = $product['ShippingMethod'];
					$position->save();
				}
			
				ShopBasket::mailNotification($order);
				ShopBasket::flushCart(true);

				//PAYPAL METHODS!!!!
				if(Yii::app()->myBasket->payPalMethod !== false 
						&& $order->payment_method == Yii::app()->myBasket->payPalMethod) 
					$this->redirect(array(Yii::app()->myBasket->payPalUrl,
								'order_id' => $order->id));
				else
					$this->redirect('success');
			} 
				$this->redirect('failure');
		} else {
			ShopBasket::setFlash('Please accept our Terms and Conditions to continue');
			$this->redirect(array('create'));
		}
	}
	
	public function actionUpdateAddress()
    {
    	if(isset($_POST['DeliveryAddress']) && @$_POST['toggle_delivery'] == true) {
			/*if(Address::isEmpty($_POST['DeliveryAddress'])) {
				ShopBasket::setFlash('Delivery address is not complete! Please fill in all fields to set the Delivery address');
			} else {*/
				$deliveryAddress = new DeliveryAddress;
				$deliveryAddress->attributes = $_POST['DeliveryAddress'];
				if($deliveryAddress->save()) {
					$model = ShopBasket::getCustomer();

					if(isset($_POST['toggle_delivery']))
						$model->delivery_address_id = $deliveryAddress->id;
					else
						$model->delivery_address_id = 0;
					if($model->save(false, array('delivery_address_id')))
						ShopBasket::setFlash('Delivery address updated!');
				}
			//}
		}

		if(isset($_POST['BillingAddress']) && @$_POST['toggle_billing'] == true) {
			/*if(Address::isEmpty($_POST['BillingAddress'])) {
				ShopBasket::setFlash('Billing address is not complete! Please fill in all fields to set the Billing address');
			} else {*/
				$BillingAddress = new BillingAddress;
				$BillingAddress->attributes = $_POST['BillingAddress'];
				if($BillingAddress->save()) {
					$model = ShopBasket::getCustomer();
					if(isset($_POST['toggle_billing']))
						$model->billing_address_id = $BillingAddress->id;
					else
						$model->billing_address_id = 0;
					if($model->save(false, array('billing_address_id')))
						ShopBasket::setFlash('Billing address updated!');
				}
			//}
		}
		
		$this->redirect('create');
    }

	public function actionSuccess()
	{
		$this->render('success');
	}

	public function actionFailure()
	{
		$this->render('failure');
	}
	
	public function actionPaypal($order_id = null) {
		$model = new PayPalForm();

		if($order_id !== null)
			$model->order_id = $order_id;

		$order = Orders::model()->findByPk($model->order_id);

		if($order->customer->user_id != Yii::app()->user->id)
			throw new CHttpException(403);

		if($order->status != Orders::STATUS_NEW) {
			ShopBasket::setFlash('The order is already paid');
			$this->redirect('/');
		}


		if(isset($_POST['PayPalForm'])) {
			$model->attributes = $_POST['PayPalForm'];

			if($model->validate()) {
				echo $model->handlePayPal($order);
			}
		}

		$this->render('paypal_form', array(
					'model' => $model));
	}
	
}