<?php
/* @var $this OffersController */
/* @var $model Offers */

$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Offers', 'url'=>array('index')),
	array('label'=>'Create Offers', 'url'=>array('create')),
	array('label'=>'Update Offers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Offers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Offers', 'url'=>array('admin')),
);
?>

<h1>View Offers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'under_title',
		'main_features',
		'deal',
		'important_information',
		'overview',
		'next_step',
		'price',
		'saving',
		'number_available',
		'number_available_at_insert',
		'terms',
		'exclusive',
		'purchase_next_step',
		'merchant_id',
		'listing_order',
		'created',
		'updated',
		'date_start',
		'date_end',
		'active',
		'deleted',
	),
)); ?>

<? $this->widget('AddToCart', array('model'=>$model)); ?>