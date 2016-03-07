<?php
/* @var $this AddendumController */
/* @var $model Addendum */
?>
<?php   
echo SemanticForm::preForm(
  $form='_form',
  $this,
  array(
		'model'=>$model,
                'getPost'=>$getPost,
                
  ),
  'Modificar Addendum',
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Addenda','url'=>array('/principal/Addendum/Admin','id'=>$model->idContrato->id_contrato),'htmlOptions'=>array('class'=>'item')),
		//array('name'=>'Registrar Menu','url'=>array('/administracion/MMenu/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create')
  		  		
	)
);
?>