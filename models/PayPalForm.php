<?php
/**
 * PayPalModel
 **/
class PayPalForm extends CModel
{
	public $order_id;
	public $email;
	public $currency;

	public function attributeNames() {
		return array(
				'order_id' => Shop::t('Order id'),
				'currency' => Shop::t('Currency'),
				'email' => Shop::t('Email'),
				);
	}

	public function beforeValidate() {
		$this->currency='GBP';

		return parent::beforeValidate(); 
	}

	public function rules()
	{
		return array(
				array('email', 'CEmailValidator'),
				array('order_id, currency', 'required')
					);
	}

	public function handlePayPal($order) {
		if(Yii::app()->myBasket->payPalMethod !== false 
				&& $order->payment_method == Yii::app()->myBasket->payPalMethod) {

				Yii::import('application.modules.yiiBasket.components.payment.Paypal');
				$paypal = new Paypal();
				// paypal email
				$paypal->addField('business', Yii::app()->myBasket->payPalBusinessEmail);

				// Specify the currency
				$paypal->addField('currency_code', $this->currency);

				// Specify the url where paypal will send the user on success/failure
				$paypal->addField('return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/success'));
				$paypal->addField('cancel_return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/failure'));
				$paypal->addField('notify_url',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/ipn'));

				// Specify the product information
				$paypal->addField('order_id', $order->id);
				$paypal->addField('item_name', 'Order number '.$order->id);
				$paypal->addField('amount', $order->getTotalPrice());

				if(Yii::app()->myBasket->payPalTestMode)
					$paypal->enableTestMode();

				// Let's start the train!
				return $paypal->submitPayment();

		}
		return true;
	}

}
