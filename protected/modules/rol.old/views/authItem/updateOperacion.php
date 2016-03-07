<?php
/* @var $this ClienteController */
/* @var $model Cliente */
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Create',
);
echo SemanticForm::preForm(
  $form='_formOperacion',
  $this,
  array(
  			'model'=>$model,
  			'operaciones'=>$operaciones,
  			'operacionesChild'=>$operacionesChild,
  			'getPost'=>$getPost,
  ),
  'Modificar Operación',
  $claseTitulo='icon inverted circular flagBlue money',
  $color='flagBlue',
  $menu=array(
		array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
                     //array('name'=>'Modificar Operaci&oacute;n','url'=>array('/rol/AuthItem/UpdateOperacion','id'=>$model->name),'htmlOptions'=>array('class'=>'item'),'accion'=>'update','publico'=>'true'),
                     array('name'=>'Registrar Tarea','url'=>array('/rol/AuthItem/CreateTarea'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create','publico'=>'true' ),
                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ,'publico'=>'true'),
                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
					
	)
);

?>
