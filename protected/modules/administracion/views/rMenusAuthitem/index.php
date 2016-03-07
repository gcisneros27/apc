<?php
/* @var $this RMenusAuthitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rmenus Authitems',
);

$this->menu=array(
	array('label'=>'Create RMenusAuthitem', 'url'=>array('create')),
	array('label'=>'Manage RMenusAuthitem', 'url'=>array('admin')),
);
?>

<h1>Rmenus Authitems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
