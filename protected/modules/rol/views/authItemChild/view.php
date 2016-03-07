<?php 
$this->breadcrumbs=array(
	'Auth Item Children'=>array('index'),
	$model->parent,
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Create AuthItemChild', 'url'=>array('create')),
	array('label'=>'Update AuthItemChild', 'url'=>array('update', 'id'=>$model->parent)),
	array('label'=>'Delete AuthItemChild', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->parent),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuthItemChild', 'url'=>array('admin')),
);
?>

<h1>View AuthItemChild #<?php // echo $model->parent; ?></h1>

<?php
/*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'parent',
		'child',
	),
));  */ 
?>
