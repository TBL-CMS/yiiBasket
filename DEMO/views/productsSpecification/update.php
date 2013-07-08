<?php
/* @var $this ProductsSpecificationController */
/* @var $model ProductsSpecification */

$this->breadcrumbs=array(
	'Products Specifications'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductsSpecification', 'url'=>array('index')),
	array('label'=>'Create ProductsSpecification', 'url'=>array('create')),
	array('label'=>'View ProductsSpecification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductsSpecification', 'url'=>array('admin')),
);
?>

<h1>Update ProductsSpecification <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>