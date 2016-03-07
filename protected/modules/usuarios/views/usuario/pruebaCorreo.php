<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prueba',
	'clientOptions'=>array(
	),
)); ?>


<div style="padding:50px;">
	<div class="row">
		<?php echo CHtml::label('Dirección de correo',''); ?>
		<?php echo CHtml::textField('correo'); ?>
	</div>

    <div class="row buttons">
		<?php echo CHtml::submitButton('Enviar correo de prueba'); ?>
	</div>
</div>    

<?php $this->endWidget(); ?>
</div><!-- form -->
