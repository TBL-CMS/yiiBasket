<?php
/* @var $this ProductsDeliveryController */
/* @var $model ProductsDelivery */

$this->breadcrumbs=array(
	'Products Deliveries'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductsDelivery', 'url'=>array('index')),
	array('label'=>'Create ProductsDelivery', 'url'=>array('create')),
	array('label'=>'View ProductsDelivery', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductsDelivery', 'url'=>array('admin')),
);
?>

<h1>Update ProductsDelivery <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>