<?php echo ShopBasket::getFlash(); ?>

<? $this->widget('InsertAddress', array('customer'=>$customer)); ?>

<?=CHtml::beginForm(array('/yiiBasket/order/confirm'));?>

	<?=CHtml::textArea('Order[Comment]', Yii::app()->user->getState('order_comment'), array('class' => 'order_comment'));?>
	
	<?=CHtml::checkBox('accept_terms','active');?>
	
	<?=CHtml::submitButton('Confirm Order');?>
			
<?=CHtml::endForm();?>