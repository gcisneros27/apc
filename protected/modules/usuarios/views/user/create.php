
		
<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
                'getPost'=>$getPost,
                'modelAA'=>$modelAA,
                
  ),
  'Registrar Usuario',
  $claseTitulo='icon inverted circular red user',
  $color='red',
  $menu=array(
		array('name'=>'Listar Usuarios','url'=>array('/usuarios/User/Admin'),'htmlOptions'=>array('class'=>'item')),
		//array('name'=>'Registrar Menu','url'=>array('/administracion/MMenu/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create')
  		  		
	)
);
?>	