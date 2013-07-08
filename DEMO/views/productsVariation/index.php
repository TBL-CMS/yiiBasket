<?php
/* @var $this ProductsVariationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Variations',
);

?>

<h1>Products Variations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
