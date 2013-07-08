<?php
/* @var $this OffersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Offers',
);

?>

<h1>Offers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
