<?php
/* @var $this ProductsSpecificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Specifications',
);

?>

<h1>Products Specifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
