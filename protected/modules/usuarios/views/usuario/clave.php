<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-usuarios-form',
	//'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		//'validateOnSubmit'=>true,
	),
)); ?>
<div class="borderfomulario" style="border:#AD1818 2px solid; width:620px; margin: 0px auto; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5;padding:10px 5px 12px 5px;text-align:justify;">
 <?php
                $accountStatus = array('1'=>'<b>Opción 1:</b> Ingresar tu <b>Cédula de Identidad</b> y responde la <b>pregunta secreta</b> para cambiar tu clave',
				 '2'=>'<b>Opción 2:</b> Ingresar tu <b>Usuario</b> para recibir una clave <b>temporal</b> por email',
                 '3'=>'<b>Opción 3:</b> Si olvidaste tu usuario ingresa tu <b>cédula</b> para recuperarlo');
                echo CHtml::radioButtonList('opcion','',$accountStatus,array('separator'=>'<br/><br/>'));
        ?>

	<br/><br/>
	<div class="row buttons" style="text-align:center;">
		<?php echo CHtml::submitButton('Enviar'); ?>
        <?php echo CHtml::button('Cancelar', array('submit' => array('/usuario/usuario/login'))); ?>
	</div>
</div>

<?php $this->endWidget(); ?>