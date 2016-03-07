<?php
/* @var $this AddendumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Addendums',
);

$this->menu=array(
	array('label'=>'Create Addendum', 'url'=>array('create')),
	array('label'=>'Manage Addendum', 'url'=>array('admin')),
);
?>

<h1>Addendums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
