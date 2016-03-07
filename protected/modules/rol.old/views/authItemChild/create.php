<?php
$this->breadcrumbs=array(
	'Auth Item Children'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Manage AuthItemChild', 'url'=>array('admin')),
	array('label'=>'Administrar Roles', 'url'=>array('adminRol')),
	
);
?>

<h1>Create AuthItemChild</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>