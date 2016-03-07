
<h1 align="center">Cambiar Contraseña <?php echo $model->tx_usuario; ?></h1>




<div class="container" style="text-align:center;">
<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<div  class="form" style="overflow:hidden;border:1px solid #CECECE;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(128, 129, 129, 0.6);-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(128, 129, 129, 0.6);box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(128, 129, 129, 0.6); padding-top:17px; width:500px; margin: 0px auto; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5 ;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-usuarios-form',
	//'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		//'validateOnSubmit'=>true,
	),
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nueva'); ?>
		<?php echo $form->passwordField($model,'nueva',array('toolt'=>'r','style'=>'width:195px','title'=>'Indique una contraseña mayor o igual a 4 dígitos.<br>Procure que esta contraseña sea única y no guarde relación con otra cuenta electrónica.')); ?>
		<?php echo $form->error($model,'nueva'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'repetirnueva'); ?>
		<?php echo $form->passwordField($model,'repetirnueva',array('toolt'=>'r','style'=>'width:195px','title'=>'Repita la contraseña anterior')); ?>
		<?php echo $form->error($model,'repetirnueva'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cambiar' : 'Modificar'); ?>
        <?php echo CHtml::button('Cancelar', array('submit' => array('/usuario/usuario/'))); ?>
	</div>
	

	

<?php $this->endWidget(); ?>

</div>

</div><!-- form -->
