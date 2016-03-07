<?php
/* @var $this MMenusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mmenuses',
);

$this->menu=array(
	array('label'=>'Create MMenus', 'url'=>array('create')),
	array('label'=>'Manage MMenus', 'url'=>array('admin')),
);
?>

<h1>Mmenuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
