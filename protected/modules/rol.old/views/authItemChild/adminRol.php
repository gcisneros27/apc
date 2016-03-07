<?php
$this->breadcrumbs=array(
	'Auth Item Children'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Manage AuthItemChild', 'url'=>array('admin')),
	
);
?>

<h1>Administracion de Elementos de Autorizacion</h1>

<?php echo $this->renderPartial('_adminRol', array('model'=>$model)); ?>