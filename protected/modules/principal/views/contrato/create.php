<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
                'getPost'=>$getPost,
                'modelPunto'=>$modelPunto,
  ),
  'Registrar Contrato',
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Contratos','url'=>array('/principal/Contrato/Admin','id'=>$modelPunto->id_punto_cuenta),'htmlOptions'=>array('class'=>'item')),
		//array('name'=>'Registrar Menu','url'=>array('/administracion/MMenu/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create')
  		  		
	)
);
?>