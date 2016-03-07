<?php
/* @var $this PuntoCuentaController */
/* @var $data PuntoCuenta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_punto_cuenta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_punto_cuenta), array('view', 'id'=>$data->id_punto_cuenta)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_punto_padre')); ?>:</b>
	<?php echo CHtml::encode($data->id_punto_padre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_punto_cuenta')); ?>:</b>
	<?php echo CHtml::encode($data->co_punto_cuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presidencial')); ?>:</b>
	<?php echo CHtml::encode($data->presidencial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_bs')); ?>:</b>
	<?php echo CHtml::encode($data->monto_bs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_disp_bs')); ?>:</b>
	<?php echo CHtml::encode($data->monto_disp_bs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_dv')); ?>:</b>
	<?php echo CHtml::encode($data->monto_dv); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_disp_dv')); ?>:</b>
	<?php echo CHtml::encode($data->monto_disp_dv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tp_moneda')); ?>:</b>
	<?php echo CHtml::encode($data->id_tp_moneda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tp_recurso')); ?>:</b>
	<?php echo CHtml::encode($data->id_tp_recurso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asunto')); ?>:</b>
	<?php echo CHtml::encode($data->asunto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presentado')); ?>:</b>
	<?php echo CHtml::encode($data->presentado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_funcionario')); ?>:</b>
	<?php echo CHtml::encode($data->id_funcionario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_aprobacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_aprobacion); ?>
	<br />

	*/ ?>

</div>