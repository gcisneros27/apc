<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.tools.min.js'); ?>
<?php

	Yii::app()->clientScript->registerCss('nuevocss','
			#persona label {
				display:inline;
				margin-right:30px;
			}
			');
    /*Yii::app()->clientScript->registerScript('formularioTooltip','
        $("#registro-form [toolt=\"r\"]").tooltip({

			// place tooltip on the right edge
			position: "center right",
		
			// a little tweaking of the position
			offset: [-2, 10],
		
			// use the built-in fadeIn/fadeOut effect
			//effect: "fade",
		
			// custom opacity setting
			opacity: 0.7,
    		
    		events: {
			  def:     "focus mouseenter,mouseleave mouseout blur",    // default show/hide events for an element
			  input:   "focus mouseenter,mouseleave mouseout blur",               // for all input elements
			  widget:  "focus mouseenter,mouseleave mouseout blur",  // select, checkbox, radio, button
			  tooltip: "mouseenter,mouseenter mouseout blur"     // the tooltip element
			}
		
		});
    ',CClientScript::POS_READY);
    Yii::app()->clientScript->registerScript('formularioTooltipl','
    		$("#registro-form [toolt=\"l\"]").tooltip({
    
    		// place tooltip on the right edge
    		position: "center left",
    
    		// a little tweaking of the position
    		offset: [-2, -10],
    
    		// use the built-in fadeIn/fadeOut effect
    		//effect: "fade",
    
    		// custom opacity setting
    		opacity: 0.7,
    
    		events: {
    		def:     "focus mouseenter,mouseleave mouseout blur",    // default show/hide events for an element
    		input:   "focus mouseenter,mouseleave mouseout blur",               // for all input elements
    		widget:  "focus mouseenter,mouseleave mouseout blur",  // select, checkbox, radio, button
    		tooltip: "mouseenter,mouseenter mouseout blur"     // the tooltip element
    }
    
    });
    		',CClientScript::POS_READY);
    Yii::app()->clientScript->registerScript('formularioTooltipc','
    		$("#registro-form [toolt=\"c\"]").tooltip({
    
    		// place tooltip on the right edge
    		position: "center left",
    
    		// a little tweaking of the position
    		offset: [-2, -50],
    
    		// use the built-in fadeIn/fadeOut effect
    		//effect: "fade",
    
    		// custom opacity setting
    		opacity: 0.7,
    
    		events: {
    		def:     "focus mouseenter,mouseleave mouseout blur",    // default show/hide events for an element
    		input:   "focus mouseenter,mouseleave mouseout blur",               // for all input elements
    		widget:  "focus mouseenter,mouseleave mouseout blur",  // select, checkbox, radio, button
    		tooltip: "mouseenter,mouseenter mouseout blur"     // the tooltip element
    }
    
    });
    		
    		jQuery("input[name=\''.CHtml::activeName($modelRegistro,'id_tp_persona').'\']").change(function(){
				if (jQuery("input[name=\''.CHtml::activeName($modelRegistro,'id_tp_persona').'\']:checked").val() == "1") {
					jQuery("#personarif").hide("slow");
				} else {
					jQuery("#personarif").show("slow");
				}
    		})
    		',CClientScript::POS_READY);*/
?>
<?php
$this->pageTitle=Yii::app()->name . ' - Registro de Usuario';
$this->breadcrumbs=array(
	'Registro de Usuario',
);
?>

<h1 align="center">Registrar Usuario</h1>
<div style="text-align:center;">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-form',
	//'enableAjaxValidation'=>true,
	//'enableClientValidation'=>true,
	'clientOptions'=>array(
		//'validateOnSubmit'=>true,
	),
));  ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<div class="borderfomulario" style="border:#AD1818 2px solid; width:450px; margin: 0px auto; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5;">
   <table>
   	<tr>
   		<td style="text-align:center;vertical-align:top;">
	   		<div class="row">
				<?php echo $form->labelEx($modelPersona,'nu_cedula'); ?>
		        <?php echo $form->dropDownList($modelPersona,'tx_nacionalidad',array('V'=>'V','E'=>'E','P'=>'P'),array('toolt'=>'l','prompt'=>'--','title'=>'<b>Nacionalidad</b><br/>V = Venezolano.<br/>E = Extranjero.<br/>P = Pasaporte.','disabled'=>'disabled')); ?>
				<?php echo $form->textField($modelPersona,'nu_cedula',array('toolt'=>'c','title'=>'Para cambiar la cédula o la nacionalidad debe cancelar este proceso e iniciar el registro nuevamente','style'=>'width:150px;','readonly'=>'readonly')); ?>
				<?php echo $form->error($modelPersona,'tx_nacionalidad'); ?>
				<?php echo $form->error($modelPersona,'nu_cedula'); ?>
			</div>
		</td>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($modelPersona,'tx_nombre1'); ?>
				<?php echo $form->textField($modelPersona,'tx_nombre1',array('toolt'=>'r','style'=>'width:195px','title'=>'Indique su primer nombre.<br/>Permitido solo letras y palabras acentuadas<br/>En caso de ser persona jurídica escriba el primer nombre del representante legal de la empresa.')); ?>
				<?php echo $form->error($modelPersona,'tx_nombre1'); ?>
			</div>
   		</td>
   	</tr>
   	<tr>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($modelPersona,'tx_apellido1'); ?>
				<?php echo $form->textField($modelPersona,'tx_apellido1',array('toolt'=>'l','style'=>'width:195px','title'=>'Indique su primer apellido.<br/>Permitido solo letras y palabras acentuadas<br/>En caso de ser persona jurídica escriba el primer apellido del representante legal de la empresa.')); ?>
				<?php echo $form->error($modelPersona,'tx_apellido1'); ?>
			</div>
   		</td>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
   				<?php echo $form->labelEx($modelPersona,'tx_correo'); ?>
				<?php echo $form->textField($modelPersona,'tx_correo',array('toolt'=>'r','style'=>'width:195px','title'=>'Indique una dirección de correo electrónico valida, ya que se usara para completar el registro.')); ?>
				<?php echo $form->error($modelPersona,'tx_correo'); ?>
			</div>
   		</td>
   	</tr>
   	<tr>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($model,'tx_contrasena'); ?>
				<?php echo $form->passwordField($model,'tx_contrasena',array('toolt'=>'l','style'=>'width:195px','title'=>'Indique una contraseña mayor o igual a 4 dígitos.<br>Procure que esta contraseña sea única y no guarde relación con otra cuenta electrónica.')); ?>
				<?php echo $form->error($model,'tx_contrasena'); ?>
			</div>
   		</td>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($model,'repetirclave'); ?>
				<?php echo $form->passwordField($model,'repetirclave',array('toolt'=>'r','style'=>'width:195px','title'=>'Repita la contraseña anterior')); ?>
				<?php echo $form->error($model,'repetirclave'); ?>
			</div>
   		</td>
   	</tr>
   	<tr>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($model,'tx_pregunta_secreta'); ?>
				<?php echo $form->textField($model,'tx_pregunta_secreta',array('toolt'=>'l','style'=>'width:195px','title'=>'Indique una pregunta o una frase que tenga algún significado personal.')); ?>
				<?php echo $form->error($model,'tx_pregunta_secreta'); ?>
			</div>
   		</td>
   		<td style="text-align:center;vertical-align:top;">
   			<div class="row">
				<?php echo $form->labelEx($model,'tx_respuesta_pregunta'); ?>
				<?php echo $form->textField($model,'tx_respuesta_pregunta',array('toolt'=>'r','style'=>'width:195px','title'=>'Indique una respuesta o una frase relacionada con la pregunta secreta.')); ?>
				<?php echo $form->error($model,'tx_respuesta_pregunta'); ?>
			</div>
   		</td>
   	</tr>
   	<tr>
   		<td style="text-align:center;" colspan="2">
   			<div class="row buttons">
			<?php echo CHtml::submitButton('Registrar'); ?>
       		<?php echo CHtml::button('Cancelar', array('submit' => array('/usuario/usuario/'))); ?>
			</div>
   		</td>
   	</tr>
   </table>

	
</div>


<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
