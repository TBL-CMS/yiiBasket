<?php
/* @var $this ProductsDeliveryController */
/* @var $model ProductsDelivery */

$this->breadcrumbs=array(
	'Products Deliveries'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductsDelivery', 'url'=>array('index')),
	array('label'=>'Create ProductsDelivery', 'url'=>array('create')),
	array('label'=>'Update ProductsDelivery', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductsDelivery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductsDelivery', 'url'=>array('admin')),
);
?>

<h1>View ProductsDelivery #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'title',
		'description',
		'delivery_cost',
	),
)); ?>
