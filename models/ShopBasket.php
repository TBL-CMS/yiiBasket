<?php
class ShopBasket {

	/* set a flash message to display after the request is done */
	public static function setFlash($message) 
	{
		Yii::app()->user->setFlash('yiiBasket',$message);
	}

	public static function hasFlash() 
	{
		return Yii::app()->user->hasFlash('yiiBasket');
	}

	/* retrieve the flash message again */
	public static function getFlash() {
		if(Yii::app()->user->hasFlash('yiiBasket')) {
			return Yii::app()->user->getFlash('yiiBasket');
		}
	}
	
	public static function getCartContent() {
		if(is_string(Yii::app()->user->getState('cart')))
			return json_decode(Yii::app()->user->getState('cart'), true);
		else
			return Yii::app()->user->getState('cart');
	}
	
	public static function priceFormat ($price) {
		return yii_money_format($price);
	}
	
	public static function setCartContent($cart) { 
		Yii::app()->user->setState('cart', json_encode($cart));
		return true;
	}
	
	public static function getPriceTotal() {
		$price_total = 0;
		$tax_total = 0;
		foreach(ShopBasket::getCartContent() as $product)  {
			$model = Offers::model()->findByPk($product['product_id']);
			$price_total += $model->getPrice($product['Variations'], $product['amount'], $product['ShippingMethod']);
		}

		$price_total = ShopBasket::priceFormat($price_total);

		return $price_total;
	}
	
	public static function flushCart($full = false) {
		if($full) {
			Yii::app()->user->setState('cart', array());
			Yii::app()->user->setState('shipping_method', null);
			Yii::app()->user->setState('payment_method', null);
			Yii::app()->user->setState('order_comment', null);
		}

		return ShopBasket::setCartContent(array());	
	}
	
	public static function getCustomer() {
		if(!Yii::app()->user->isGuest)
			if($customer = Customer::model()->find('user_id = :uid', array(':uid' => Yii::app()->user->id))) 
				return $customer;
	
		if($customer_id = Yii::app()->user->getState('customer_id')) 
				return Customer::model()->find('user_id = :uid', array(':uid' => Yii::app()->user->id));
	}
	
	public static function mailNotification ($order) {
		$email = Yii::app()->myBasket->orderNotificationFromEmail;
		$from = Yii::app()->myBasket->shopName;
		$reply = Yii::app()->myBasket->orderNotificationReplyEmail;
		$subject = "Order #{$order->order_Code} has been made in ".$from;
		
		$name='=?UTF-8?B?'.base64_encode($from).'?=';
		$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
		//use 'contact' view from views/mail
		//$viewFile='application.modules.yiiBasket.views.mail.orderNotification';
		$mail = new YiiMailer('orderNotification', array('model'=>$order));
		//render HTML mail, layout is set from config file or with $mail->setLayout('layoutName')
		$mail->render();
		//set properties as usually with PHPMailer
		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = $subject;
		$mail->AddAddress($order->customer->user->email);
		//send
		if ($mail->Send())
			return true;
	}

    /**
     * Return the total amount of products in cart
     * @return int total Amount
     */
    public static function getCartTotal(){
        $totalAmount=0;
        $cart = self::getCartContent();
        foreach ($cart as $key => $value) {
            if(is_numeric($value['amount']))
            $totalAmount += $value['amount'];
        }
        return $totalAmount;
    }

}