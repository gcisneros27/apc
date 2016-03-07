<div align="center" style=" width:890px;">
<div  class="form" style=" padding-top:17px; width:500px; border: #AD1818 2px solid; margin: 0px auto; -moz-border-radius: 10px; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5 ;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-usuarios-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php echo $form->labelEx($model,'oldpass'); ?>
		<?php echo $form->passwordField($model,'oldpass',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'oldpass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'newpass'); ?>
		<?php echo $form->passwordField($model,'newpass',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'newpass'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'renewpass'); ?>
		<?php echo $form->passwordField($model,'renewpass',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'renewpass'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>