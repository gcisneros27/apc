<?php
/* @var $this PuntoCuentaController */
/* @var $model PuntoCuenta */
?>
<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
		'getPost'=>$getPost,
//  		'modelSubItems'=>$modelSubItems
  ),
  'Modificar Menu',
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Puntos de Cuenta','url'=>array('/principal/PuntoCuenta/Admin'),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Registrar Punto de Cuenta','url'=>array('/principal/PuntoCuenta/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
  		
	)
);
?>