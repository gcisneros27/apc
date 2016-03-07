<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
		'getPost'=>$getPost,
  		'modelAA'=>$modelAA,
  ),
  'Modificar Usuario',
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Usuarios','url'=>array('/usuarios/User/Admin'),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Registrar Usuario','url'=>array('/usuarios/User/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
  		
	)
);
?>	