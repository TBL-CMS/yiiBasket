<?php

class BasketController extends Controller
{
	public $productController='offers';
	
	// Add a new product to the shopping cart
	public function actionCreate()
	{
		$product=Products::model()->findByPk($_POST['product_id']);
	
		if(!is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
			ShopBasket::setFlash('Illegal amount given');
			$this->redirect(array($this->productController.'/view', 'id' => $_POST['offer_id']));
		}

		if(isset($_POST['Variations'])) {
			foreach($_POST['Variations'] as $key => $variation) {
				$specification = OffersSpecification::model()->findByPk($key);
				if($specification->required && $variation[0] == '') {
					ShopBasket::setFlash('Please select a {specification}', array('{specification}' => $specification->title));
					$this->redirect(array($this->productController.'/view', 'id' => $_POST['product_id']));
				}

			}
		}
		
		if(!isset($_POST['ShippingMethod'])) {
			//ShopBasket::setFlash('Please select shipping method');
			//$this->redirect(array('/'.$this->productController.'/view', 'id' => $_POST['offer_id']));
			if($delivery = $product->delivery) {
				$_POST['ShippingMethod'] = $delivery[0]->id;
			}
		}
		
		$cart = ShopBasket::getCartContent();

		// remove potential clutter
		if(isset($_POST['yt0']))
			unset($_POST['yt0']);
		if(isset($_POST['yt1']))
			unset($_POST['yt1']);

		$cart[] = $_POST;

		ShopBasket::setCartcontent($cart);
		ShopBasket::setFlash('The product has been added to the shopping cart');
		
		$this->redirect('review');
	}
	
	public function actionDelete($id)
	{
		$id = (int) $id;
		$cart = json_decode(Yii::app()->user->getState('cart'), true);

		unset($cart[$id]);
		Yii::app()->user->setState('cart', json_encode($cart));

		$this->redirect('/yiiBasket/basket/review');
	}
	
	public function actionReview()
	{
		$cart = ShopBasket::getCartContent();
//dump($cart); die();
		$this->render('review',array(
			'products'=>$cart
		));
	}
	
	public function actionUpdateAmount() 
	{
		$cart = ShopBasket::getCartContent();

		foreach($_GET as $key => $value) {
			if(substr($key, 0, 7) == 'amount_') {
				if($value == '')
					return true;
				if (!is_numeric($value) || $value <= 0)
					throw new CException('Wrong amount');
				$position = explode('_', $key);
				$position = $position[1];
				
				if(isset($cart[$position]['amount']))
					$cart[$position]['amount'] = $value;
					$product = Products::model()->findByPk($cart[$position]['product_id']);
					echo ShopBasket::priceFormat($product->getPrice($cart[$position]['Variations'], $value, $cart[$position]['ShippingMethod']));
					return ShopBasket::setCartContent($cart);
			}	
		}

	}
	
	public function actionUpdateShippingType()
	{
		$cart = ShopBasket::getCartContent();

		foreach($_GET as $key => $value) {
			if(substr($key, 0, 9) == 'shipping_') {
				if($value == '')
					return true;
				if (!is_numeric($value) || $value <= 0)
					throw new CException('Wrong amount');
				$position = explode('_', $key);
				$position = $position[1];
				
				if(isset($cart[$position]['ShippingMethod']))
					$cart[$position]['ShippingMethod'] = $value;
					$product = Products::model()->findByPk($cart[$position]['product_id']);
					
					$totalPrice = ShopBasket::priceFormat(@$product->getPrice($cart[$position]['Variations'], $cart[$position]['amount'], $value));
					$shippingCost = Products::getShippingCost($cart[$position]['ShippingMethod']);
					echo json_encode(array('totalPrice'=>$totalPrice, 'shippingCost'=>$shippingCost));		
					
					return ShopBasket::setCartContent($cart);
			}	
		}
	}
	
	public function actionGetPriceTotal() 
	{
		echo ShopBasket::getPriceTotal();
	}

	/*public function actionGetShippingCost() {
		echo ShopBasket::getShippingMethod(true);
	}*/
	
	public function actionFlush()
	{
		ShopBasket::flushCart(true);
	}
}