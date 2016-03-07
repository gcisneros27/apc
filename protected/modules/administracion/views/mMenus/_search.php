<?php
/* @var $this MMenusController */
/* @var $model MMenus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_menu'); ?>
		<?php echo $form->textField($model,'id_menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_menu_padre'); ?>
		<?php echo $form->textField($model,'id_menu_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_menu'); ?>
		<?php echo $form->textArea($model,'nombre_menu',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->