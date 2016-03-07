<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'auth-item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('OnSubmit'=>'$.blockUI({ message: $("#domMessage")});$("#box6Clear").click();'),
)); ?>

	<div class="ui form">
		<div class="ui form secondary segment">
			<div id="cargando" class="ui dimmer">
				<div class="ui text loader">Cargando...</div>
			</div>			<p class="note" style="text-align:center">Los Campos con <span class="required">*</span> son obligatorios.</p>
			
				<div class="one field">
					<?php  echo $form->fieldTextLeft($model,'name',$disabledifisnotnew=TRUE,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre de la Operación' , "data-variation"=>"inverted","data-position"=>"left center",'placeholder'=>$model->getAttributeLabel('name')),$getPost); ?>				           
				</div>
				<div class="one field">
					<?php  echo $form->fieldTextAreaLeft($model,'description',$disabledifisnotnew=FALSE,$htmlOptions=array('style'=>"width: 100%; height: 63px;",'class'=>'comentario-focus','data-content'=>'Descripción de la Operación' , "data-variation"=>"inverted","data-position"=>"left center",'placeholder'=>$model->getAttributeLabel('descripcion')),$getPost); ?>				           
				</div>
				
				
				<div class="span10">
					<?php
							echo $this->renderPartial('draggdropOperacion', array('model'=>$model,'operaciones'=>$operaciones,'operacionesChild'=>$operacionesChild
								)); 
					?>
				</div>
				<div class="ui divider"></div>
				<div style="text-align:center">
					<?php echo CHtml::htmlButton('<i class="save icon"></i>'.(($model->isNewRecord)?'Registrar':'Modificar'),array('confirm'=>'¿Está seguro de Guardar los Cambios?','type'=>"submit",'class' => 'ui teal right submit labeled icon button')); ?>
					<?php echo CHtml::htmlButton('<i class="undo icon"></i> Limpiar', array('type'=>"reset",'class' => 'ui blue right labeled icon button'));	?>
				</div>
		</div>
	</div>

    
    
   <?php $this->endWidget(); ?>

</div><!-- form -->
