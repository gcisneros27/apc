<?php
/* @var $this ContratoController */
/* @var $model Contrato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_contrato'); ?>
		<?php echo $form->textField($model,'id_contrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_punto_cuenta'); ?>
		<?php echo $form->textField($model,'id_punto_cuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_contrato'); ?>
		<?php echo $form->textField($model,'co_contrato',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nb_obra'); ?>
		<?php echo $form->textArea($model,'nb_obra',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'objeto'); ?>
		<?php echo $form->textArea($model,'objeto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estado'); ?>
		<?php echo $form->textField($model,'id_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_municipio'); ?>
		<?php echo $form->textField($model,'id_municipio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_parroquia'); ?>
		<?php echo $form->textField($model,'id_parroquia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tp_contrato'); ?>
		<?php echo $form->textField($model,'id_tp_contrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_institucion'); ?>
		<?php echo $form->textField($model,'id_institucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_suscripcion'); ?>
		<?php echo $form->textField($model,'fecha_suscripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_culminacion'); ?>
		<?php echo $form->textField($model,'fecha_culminacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_total'); ?>
		<?php echo $form->textField($model,'monto_total',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avance_financiero'); ?>
		<?php echo $form->textField($model,'avance_financiero',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avance_fisico'); ?>
		<?php echo $form->textField($model,'avance_fisico',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nb_constructor'); ?>
		<?php echo $form->textArea($model,'nb_constructor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telf_constructor'); ?>
		<?php echo $form->textArea($model,'telf_constructor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_constructor'); ?>
		<?php echo $form->textArea($model,'correo_constructor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nb_inspector'); ?>
		<?php echo $form->textArea($model,'nb_inspector',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telf_inspector'); ?>
		<?php echo $form->textArea($model,'telf_inspector',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_inspector'); ?>
		<?php echo $form->textArea($model,'correo_inspector',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->