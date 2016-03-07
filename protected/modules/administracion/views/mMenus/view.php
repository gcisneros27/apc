<?php
/* @var $this MMenusController */
/* @var $model MMenus */

$this->breadcrumbs=array(
	'Mmenuses'=>array('index'),
	$model->id_menu,
);

$this->menu=array(
	array('label'=>'List MMenus', 'url'=>array('index')),
	array('label'=>'Create MMenus', 'url'=>array('create')),
	array('label'=>'Update MMenus', 'url'=>array('update', 'id'=>$model->id_menu)),
	array('label'=>'Delete MMenus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_menu),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MMenus', 'url'=>array('admin')),
);
?>

<h1>View MMenus #<?php echo $model->id_menu; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_menu',
		'id_menu_padre',
		'nombre_menu',
	),
)); ?>
