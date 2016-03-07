<?php
/* @var $this ContratoController */
/* @var $model Contrato */

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
  'Modificar Contrato',
  $claseTitulo='icon inverted circular red file text',
  $color='red',
  $menu=array(
		array('name'=>'Listar Contratos','url'=>array('/principal/Contrato/Admin','id'=>$model->id_punto_cuenta),'htmlOptions'=>array('class'=>'item')),
		array('name'=>'Registrar Contrato','url'=>array('/principal/Contrato/Create','id'=>$model->id_punto_cuenta),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
  		
	)
);
?>