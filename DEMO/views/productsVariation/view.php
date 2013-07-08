<?php
/* @var $this ProductsVariationController */
/* @var $model ProductsVariation */

$this->breadcrumbs=array(
	'Products Variations'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductsVariation', 'url'=>array('index')),
	array('label'=>'Create ProductsVariation', 'url'=>array('create')),
	array('label'=>'Update ProductsVariation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductsVariation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductsVariation', 'url'=>array('admin')),
);
?>

<h1>View ProductsVariation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'specification_id',
		'title',
		'price_adjustion',
		'listing_order',
	),
)); ?>
