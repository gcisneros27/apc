<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.tools.min.js'); ?>
<?php
   /* Yii::app()->clientScript->registerScript('formularioTooltip','
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
    		',CClientScript::POS_READY);*/
?>
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1 align="center">Datos Personales</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-form',
	//'enableAjaxValidation'=>true,
	//'enableClientValidation'=>true,
	'clientOptions'=>array(
		//'validateOnSubmit'=>true,
	),
)); ?>
<div style="text-align:center;"> 
	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
  <div class="borderfomulario" style="border:#AD1818 2px solid; width:370px; margin: 0px auto; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5;">     
  

    <div class="row">
		<?php echo $form->labelEx($modelPersona,'nu_cedula'); ?>
        <?php echo $form->dropDownList($modelPersona,'tx_nacionalidad',array('V'=>'V','E'=>'E','P'=>'P'),array('toolt'=>'l','prompt'=>'--','title'=>'<b>Nacionalidad</b><br/>V = Venezolano.<br/>E = Extranjero.<br/>P = Pasaporte.')); ?>
		<?php echo $form->textField($modelPersona,'nu_cedula',array('toolt'=>'r','title'=>'Indique su cédula.<br/>Permitido solo números sin puntos ni comas.')); ?>
		<?php echo $form->error($modelPersona,'tx_nacionalidad'); ?>
		<?php echo $form->error($modelPersona,'nu_cedula'); ?>
	</div>


    <br/><div class="row">
    	<?php echo $form->labelEx($model,'tx_pregunta_secreta'); ?>
    	<b><?php echo Usuario::model()->findByAttributes(array('tx_usuario'=>strtolower(Yii::app()->user->getState('tx_usuario')),'st_usuario'=>1))->tx_pregunta_secreta; ?></b>
	</div><br/>

	<div class="row">
		<?php echo $form->labelEx($model,'tx_respuesta_pregunta'); ?>
		<?php echo $form->textField($model,'tx_respuesta_pregunta',array('toolt'=>'r','style'=>'width:195px','title'=>'Indique la respuesta a la pregunta secreta.')); ?>
		<?php echo $form->error($model,'tx_respuesta_pregunta'); ?>
	</div>
	
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Enviar'); ?>
	        <?php echo CHtml::button('Cancelar', array('submit' => array('/usuario/usuario/'))); ?>
		</div>
    </div>

	

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>