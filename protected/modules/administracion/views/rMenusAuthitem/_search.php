<?php
/* @var $this RMenusAuthitemController */
/* @var $model RMenusAuthitem */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_item_authitem'); ?>
		<?php echo $form->textField($model,'id_item_authitem'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_menu'); ?>
		<?php echo $form->textField($model,'id_menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarea'); ?>
		<?php echo $form->textArea($model,'tarea',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ruta_imagen'); ?>
		<?php echo $form->textArea($model,'ruta_imagen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orden'); ?>
		<?php echo $form->textField($model,'orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_item'); ?>
		<?php echo $form->textArea($model,'nombre_item',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operacion'); ?>
		<?php echo $form->textArea($model,'operacion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->