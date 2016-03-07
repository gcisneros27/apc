<?php
/* @var $this RMenusAuthitemController */
/* @var $model RMenusAuthitem */
/* @var $form CActiveForm */
?>

<div class="ui form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'rmenus-authitem-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'blockuis'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

 	<?php echo $form->beginUiForm('Cargando...');	?>

    <div class="one field">
      <?php  echo $form->fieldTextLeft($model,"nombre_item",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nombre_item'),),false); ?>
      <?php //echo CHtml::activeHiddenField($model,"idmotivoInfraccion"); ?>
    </div>
    <div class="one field">
      <?php echo $form->fieldSelect2Left($model,'operacion',$disabledifisnotnew=false,$htmlOptions=array(),false,$conLabel = true,
      							$data=CHtml::listData(Authitem::model()->findAll(array('condition'=>'type=0','order'=>'name')), 'name','name'),$combosLimipiar=array(),$indice=NULL, $opciones = array('conLabel'=>TRUE,'multiple'=>true)); ?>

    </div>
	<?php echo $form->saveResetButton()?>
<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
