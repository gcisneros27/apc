<?php
/* @var $this PuntoCuentaController */
/* @var $model PuntoCuenta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_punto_cuenta'); ?>
		<?php echo $form->textField($model,'id_punto_cuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_punto_padre'); ?>
		<?php echo $form->textField($model,'id_punto_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_punto_cuenta'); ?>
		<?php echo $form->textField($model,'co_punto_cuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'presidencial'); ?>
		<?php echo $form->checkBox($model,'presidencial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_bs'); ?>
		<?php echo $form->textField($model,'monto_bs',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_disp_bs'); ?>
		<?php echo $form->textField($model,'monto_disp_bs',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_dv'); ?>
		<?php echo $form->textField($model,'monto_dv',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_disp_dv'); ?>
		<?php echo $form->textField($model,'monto_disp_dv',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tp_moneda'); ?>
		<?php echo $form->textField($model,'id_tp_moneda'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tp_recurso'); ?>
		<?php echo $form->textField($model,'id_tp_recurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asunto'); ?>
		<?php echo $form->textArea($model,'asunto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'presentado'); ?>
		<?php echo $form->textArea($model,'presentado',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_funcionario'); ?>
		<?php echo $form->textField($model,'id_funcionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_aprobacion'); ?>
		<?php echo $form->textField($model,'fecha_aprobacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->