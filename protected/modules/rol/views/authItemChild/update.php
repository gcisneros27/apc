<?php
$this->breadcrumbs=array(
	'Auth Item Children'=>array('index'),
	$model->parent=>array('view','id'=>$model->parent),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Create AuthItemChild', 'url'=>array('create')),
	array('label'=>'View AuthItemChild', 'url'=>array('view', 'id'=>$model->parent)),
	array('label'=>'Manage AuthItemChild', 'url'=>array('admin')),
);
?>

<h1>Update AuthItemChild <?php echo $model->parent; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>