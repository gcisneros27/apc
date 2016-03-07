<div class="view" >

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id'=>$data->id_usuario)); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('nb_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->nb_usuario); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('id_rol')); ?>:</b>
	<?php echo CHtml::encode($data->idRol->nb_rol); ?>
	<br />
	
    
    
    <b><?php echo CHtml::encode('Estatus'); ?>:</b>
	<?php echo CHtml::encode((($data->activado)?"Activo":"No Activo")); ?>
	<br />
	
    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id'=>$data->id_usuario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('int_cedula')); ?>:</b>
	<?php echo CHtml::encode($data->int_cedula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->txt_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_apellidos')); ?>:</b>
	<?php echo CHtml::encode($data->txt_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_rol')); ?>:</b>
	<?php echo CHtml::encode($data->id_rol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_email_institucional')); ?>:</b>
	<?php echo CHtml::encode($data->txt_email_institucional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_email_personal')); ?>:</b>
	<?php echo CHtml::encode($data->txt_email_personal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_tlf_ofic')); ?>:</b>
	<?php echo CHtml::encode($data->txt_tlf_ofic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_tlf_personal')); ?>:</b>
	<?php echo CHtml::encode($data->txt_tlf_personal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_login')); ?>:</b>
	<?php echo CHtml::encode($data->txt_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_password')); ?>:</b>
	<?php echo CHtml::encode($data->txt_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bol_activo')); ?>:</b>
	<?php echo CHtml::encode($data->bol_activo); ?>
	<br />

	*/ ?>

</div>