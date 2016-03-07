<?php
/* @var $this MMenusController */
/* @var $model MMenus */
?>
<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
//  		'modelSubItems'=>$modelSubItems
  ),
  'Registrar Items al Menú',
  $claseTitulo='icon inverted circular flagBlue money',
  $color='flagBlue',
  $menu=array(
		array('name'=>'Listar Items del Menú','url'=>array('/administracion/RMenusAuthitem/Admin','id'=>$model->id_menu),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ),
  		array('name'=>'Regresar Al listado de Menú','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'admin'),
        array('name'=>'Registrar Items del Menú','url'=>array('/administracion/RMenusAuthitem/Create','id'=>$model->id_menu),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
        array('name'=>'Modificar Items del Menú','url'=>array('/administracion/RMenusAuthitem/Update','id'=>$model->id_item_authitem),'htmlOptions'=>array('class'=>'item'),'accion'=>'update' ),
        
  )
);
?>