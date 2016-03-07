
<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
			'model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,
			'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
			'getPost'=>$getPost,
		),
  'Modificar Item '.$model->name,
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Crear Tarea','url'=>array('/rol/authItem/createTarea'),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Agregar Permisos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'create')),
	)
);
?>