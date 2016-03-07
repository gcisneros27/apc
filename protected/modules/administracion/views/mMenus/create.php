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
		'arbol'=>$arbol,
//  		'modelSubItems'=>$modelSubItems
  ),
  'Registrar Menu',
  $claseTitulo='icon inverted circular red menu',
  $color='flagBlue',
  $menu=array(
		array('name'=>'Listar Menu','url'=>array('/administracion/MMenu/Admin'),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Registrar Menu','url'=>array('/administracion/MMenu/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create')
  		  		
	)
);
?>