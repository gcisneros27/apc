<?php
/* @var $this AddendumController */
/* @var $data Addendum */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_addendum')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_addendum), array('view', 'id'=>$data->id_addendum)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_addendum')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_addendum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_addendum')); ?>:</b>
	<?php echo CHtml::encode($data->monto_addendum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus_addendum')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus_addendum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_addendum')); ?>:</b>
	<?php echo CHtml::encode($data->st_addendum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->id_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_punto_cuenta')); ?>:</b>
	<?php echo CHtml::encode($data->id_punto_cuenta); ?>
	<br />


</div>