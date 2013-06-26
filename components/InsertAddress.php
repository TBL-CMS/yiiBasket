<?php

Yii::import('zii.widgets.CPortlet');

class InsertAddress extends CPortlet
{

	public $customer;
	
	protected function renderContent()
	{ 
		if(isset($this->customer->deliveryAddress))
			$deliveryAddress = $this->customer->deliveryAddress;
		else
			$deliveryAddress = new DeliveryAddress;
	
		$this->render('insertAddress', array(
			'customer'=>$this->customer,
			'deliveryAddress'=>$deliveryAddress,
		));
	}
}