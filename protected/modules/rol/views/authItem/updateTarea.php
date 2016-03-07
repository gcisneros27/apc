<?php
/*
$this->breadcrumbs=array(
	'Lista de Item'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Modificar Item',
);
*/
$this->menu=array(
	//array('label'=>'Listar Item', 'url'=>array('index')),
	//array('label'=>'Crear Item', 'url'=>array('create')),
	array('label'=>'Ver Item', 'url'=>array('view', 'id'=>$model->name)),
	array('label'=>'Administrar Item', 'url'=>array('admin')),
);
?>


<div align="center" style="margin:0 auto 0 auto; width:890px; padding-bottom:10px;">
<h1>Modificar Tarea "<?php echo $model->name; ?>"</h1>
</div>

<?php echo $this->renderPartial('_formTarea', array(
			'model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,
			'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
			'getPost'=>$getPost,
		)); ?>

