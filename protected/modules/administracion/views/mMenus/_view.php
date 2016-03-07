<?php
/* @var $this MMenusController */
/* @var $data MMenus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_menu')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_menu), array('view', 'id'=>$data->id_menu)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_menu_padre')); ?>:</b>
	<?php echo CHtml::encode($data->id_menu_padre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_menu')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_menu); ?>
	<br />


</div>