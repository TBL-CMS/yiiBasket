<?php
/* @var $this ProductsDeliveryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Deliveries',
);

?>

<h1>Products Deliveries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
