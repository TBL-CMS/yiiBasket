<?php
/* @var $this ProductsVariationController */
/* @var $model ProductsVariation */

$this->breadcrumbs=array(
	'Products Variations'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductsVariation', 'url'=>array('index')),
	array('label'=>'Create ProductsVariation', 'url'=>array('create')),
	array('label'=>'View ProductsVariation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductsVariation', 'url'=>array('admin')),
);
?>

<h1>Update ProductsVariation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>