<?php
/* @var $this ProductsVariationController */
/* @var $data ProductsVariation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specification_id')); ?>:</b>
	<?php echo CHtml::encode($data->specification_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_adjustion')); ?>:</b>
	<?php echo CHtml::encode($data->price_adjustion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listing_order')); ?>:</b>
	<?php echo CHtml::encode($data->listing_order); ?>
	<br />


</div>