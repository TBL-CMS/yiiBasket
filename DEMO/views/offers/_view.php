<?php
/* @var $this OffersController */
/* @var $data Offers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('under_title')); ?>:</b>
	<?php echo CHtml::encode($data->under_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_features')); ?>:</b>
	<?php echo CHtml::encode($data->main_features); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deal')); ?>:</b>
	<?php echo CHtml::encode($data->deal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('important_information')); ?>:</b>
	<?php echo CHtml::encode($data->important_information); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('overview')); ?>:</b>
	<?php echo CHtml::encode($data->overview); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('next_step')); ?>:</b>
	<?php echo CHtml::encode($data->next_step); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saving')); ?>:</b>
	<?php echo CHtml::encode($data->saving); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_available')); ?>:</b>
	<?php echo CHtml::encode($data->number_available); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_available_at_insert')); ?>:</b>
	<?php echo CHtml::encode($data->number_available_at_insert); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terms')); ?>:</b>
	<?php echo CHtml::encode($data->terms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exclusive')); ?>:</b>
	<?php echo CHtml::encode($data->exclusive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_next_step')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_next_step); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_id')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listing_order')); ?>:</b>
	<?php echo CHtml::encode($data->listing_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_start')); ?>:</b>
	<?php echo CHtml::encode($data->date_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_end')); ?>:</b>
	<?php echo CHtml::encode($data->date_end); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>