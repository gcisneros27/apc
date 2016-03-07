<?php
/* @var $this AddendumController */
/* @var $model Addendum */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_addendum'); ?>
		<?php echo $form->textField($model,'id_addendum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_addendum'); ?>
		<?php echo $form->textField($model,'fecha_addendum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_addendum'); ?>
		<?php echo $form->textField($model,'monto_addendum',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus_addendum'); ?>
		<?php echo $form->textField($model,'id_estatus_addendum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'st_addendum'); ?>
		<?php echo $form->checkBox($model,'st_addendum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_contrato'); ?>
		<?php echo $form->textField($model,'id_contrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_punto_cuenta'); ?>
		<?php echo $form->textField($model,'id_punto_cuenta'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->