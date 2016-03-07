<?php
/* @var $this RMenusAuthitemController */
/* @var $model RMenusAuthitem */

$this->breadcrumbs=array(
	'Rmenus Authitems'=>array('index'),
	$model->id_item_authitem,
);

$this->menu=array(
	array('label'=>'List RMenusAuthitem', 'url'=>array('index')),
	array('label'=>'Create RMenusAuthitem', 'url'=>array('create')),
	array('label'=>'Update RMenusAuthitem', 'url'=>array('update', 'id'=>$model->id_item_authitem)),
	array('label'=>'Delete RMenusAuthitem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_item_authitem),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RMenusAuthitem', 'url'=>array('admin')),
);
?>

<h1>View RMenusAuthitem #<?php echo $model->id_item_authitem; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_item_authitem',
		'id_menu',
		'tarea',
		'ruta_imagen',
		'orden',
		'nombre_item',
		'operacion',
	),
)); ?>
