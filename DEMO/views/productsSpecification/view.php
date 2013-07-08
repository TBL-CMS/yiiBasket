<?php
/* @var $this ProductsSpecificationController */
/* @var $model ProductsSpecification */

$this->breadcrumbs=array(
	'Products Specifications'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductsSpecification', 'url'=>array('index')),
	array('label'=>'Create ProductsSpecification', 'url'=>array('create')),
	array('label'=>'Update ProductsSpecification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductsSpecification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductsSpecification', 'url'=>array('admin')),
);
?>

<h1>View ProductsSpecification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'required',
	),
)); ?>
