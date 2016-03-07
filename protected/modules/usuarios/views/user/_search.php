<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'int_cedula'); ?>
		<?php echo $form->textField($model,'int_cedula'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_nombre'); ?>
		<?php echo $form->textField($model,'txt_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_apellidos'); ?>
		<?php echo $form->textField($model,'txt_apellidos',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_rol'); ?>
		<?php echo $form->textField($model,'id_rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_email_institucional'); ?>
		<?php echo $form->textField($model,'txt_email_institucional',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_email_personal'); ?>
		<?php echo $form->textField($model,'txt_email_personal',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_tlf_ofic'); ?>
		<?php echo $form->textField($model,'txt_tlf_ofic',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_tlf_personal'); ?>
		<?php echo $form->textField($model,'txt_tlf_personal',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_login'); ?>
		<?php echo $form->textField($model,'txt_login',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bol_activo'); ?>
		<?php echo $form->checkBox($model,'bol_activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_usuario'); ?>
		<?php echo $form->textField($model,'id_usuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->