<?php
/* @var $this RMenusAuthitemController */
/* @var $data RMenusAuthitem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_item_authitem')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_item_authitem), array('view', 'id'=>$data->id_item_authitem)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_menu')); ?>:</b>
	<?php echo CHtml::encode($data->id_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarea')); ?>:</b>
	<?php echo CHtml::encode($data->tarea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruta_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->ruta_imagen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orden')); ?>:</b>
	<?php echo CHtml::encode($data->orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_item')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('operacion')); ?>:</b>
	<?php echo CHtml::encode($data->operacion); ?>
	<br />


</div>