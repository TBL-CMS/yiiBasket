<?php

/**
 * To use: $this->widget('AddToCart', array('model'=>$model));
 */

Yii::import('zii.widgets.CPortlet');

class AddToCart extends CPortlet
{
	public $model;
	
	protected function renderContent()
	{
		$this->render('addToCart', array(
			'model' => $this->model,
		));
	}
}