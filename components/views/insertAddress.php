<h3>Delivery address</h3>

<div class="current_address">
<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$deliveryAddress,
			'htmlOptions' => array('class' => 'detail-view'),
			'attributes'=>array(
				'title',
				'firstname',
				'lastname',
				'street',
				'postal',
				'city',
				'region'
				),
			)); ?>
</div>
<br/>

<? $form=$this->beginWidget('CActiveForm', array(
	'id'=>'address-form',
	'action' => array('/yiiBasket/order/updateAddress'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 
?>

<?php
echo CHtml::checkBox('toggle_delivery',
		$customer->deliveryAddress !== NULL, array(
			'style' => 'float: left')); 
echo CHtml::label(
		'update delivery address', 'toggle_delivery', array(
			'style' => 'cursor:pointer'));

?>

<div class="form">
<fieldset id="delivery_information" style="display: none;">
<div class="payment_address">

<h3>update delivery address</h3>

<div class="row">
<?php echo $form->labelEx($deliveryAddress,'title'); ?>
<?php echo $form->textField($deliveryAddress,'title',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'title'); ?>
</div>


<div class="row">
<?php echo $form->labelEx($deliveryAddress,'firstname'); ?>
<?php echo $form->textField($deliveryAddress,'firstname',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'firstname'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($deliveryAddress,'lastname'); ?>
<?php echo $form->textField($deliveryAddress,'lastname',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'lastname'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($deliveryAddress,'street'); ?>
<?php echo $form->textField($deliveryAddress,'street',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'street'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($deliveryAddress,'city'); ?>
<?php echo $form->textField($deliveryAddress,'postal',array('size'=>10,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'postal'); ?>

<?php echo $form->textField($deliveryAddress,'city',array('size'=>32,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'city'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($deliveryAddress,'region'); ?>
<?php echo $form->textField($deliveryAddress,'region',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($deliveryAddress,'region'); ?>
</div>

<div class="row buttons">
<?php
echo CHtml::submitButton('Update');
?>
</div>

</div>
</fieldset>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('toggle', "
		if($('#toggle_delivery').attr('checked'))
		$('#delivery_information').show();
		$('#toggle_delivery').click(function() { 
			$('#delivery_information').toggle(500);
			});
		");
?>