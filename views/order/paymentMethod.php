<?
$form=$this->beginWidget('CActiveForm', array(
			'id'=>'customer-form',
			'action' => array('//yiiBasket/order/create'),
			'enableAjaxValidation'=>false,
			)); 
?>

<p>Choose your Payment method</p>

<?php
$i = 0;
	echo '<fieldset>';
foreach(PaymentMethod::model()->findAll() as $method) {
	echo '<div class="row">';
	echo CHtml::radioButton("PaymentMethod", $i == 0, array(
				'value' => $method->id));
	echo CHtml::tag('p', array(
				'class' => 'shop_selection',
				'onClick' => "
				$(\"input[name='PaymentMethod'][value='".$method->id."']\").attr('checked','checked');"),
			$method->title . '<br />'.$method->description);
	echo '</div>';
	echo '<div class="clear"></div>';
	$i++;
}
	echo '</fieldset>';
	?>


<div class="row buttons">
<?php echo CHtml::submitButton('Continue',array('id'=>'next')); ?>
</div>

<?php
echo '</div>';
$this->endWidget(); 
?>