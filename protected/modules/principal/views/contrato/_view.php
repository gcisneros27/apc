<?php
/* @var $this ContratoController */
/* @var $data Contrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_contrato')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_contrato), array('view', 'id'=>$data->id_contrato)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_punto_cuenta')); ?>:</b>
	<?php echo CHtml::encode($data->id_punto_cuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->co_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_obra')); ?>:</b>
	<?php echo CHtml::encode($data->nb_obra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('objeto')); ?>:</b>
	<?php echo CHtml::encode($data->objeto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_municipio')); ?>:</b>
	<?php echo CHtml::encode($data->id_municipio); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_parroquia')); ?>:</b>
	<?php echo CHtml::encode($data->id_parroquia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tp_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->id_tp_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_institucion')); ?>:</b>
	<?php echo CHtml::encode($data->id_institucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_suscripcion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_suscripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_culminacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_culminacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_total')); ?>:</b>
	<?php echo CHtml::encode($data->monto_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avance_financiero')); ?>:</b>
	<?php echo CHtml::encode($data->avance_financiero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avance_fisico')); ?>:</b>
	<?php echo CHtml::encode($data->avance_fisico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_constructor')); ?>:</b>
	<?php echo CHtml::encode($data->nb_constructor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telf_constructor')); ?>:</b>
	<?php echo CHtml::encode($data->telf_constructor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_constructor')); ?>:</b>
	<?php echo CHtml::encode($data->correo_constructor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_inspector')); ?>:</b>
	<?php echo CHtml::encode($data->nb_inspector); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telf_inspector')); ?>:</b>
	<?php echo CHtml::encode($data->telf_inspector); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_inspector')); ?>:</b>
	<?php echo CHtml::encode($data->correo_inspector); ?>
	<br />

	*/ ?>

</div>