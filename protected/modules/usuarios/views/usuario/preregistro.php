<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.tools.min.js'); 
Yii::app()->clientScript->registerCss('nuevocss','
			#persona label {
				display:inline;
				margin-right:30px;
			}
			');
?>
<?php
 /*   Yii::app()->clientScript->registerScript('formularioTooltip','
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


    <div class="row" id="personaced">
		<?php echo $form->labelEx($modelPersona,'nu_cedula'); ?>
        <?php echo $form->dropDownList($modelPersona,'tx_nacionalidad',array('V'=>'V','E'=>'E','P'=>'P'),array('toolt'=>'l','prompt'=>'--','title'=>'<b>Nacionalidad</b><br/>V = Venezolano.<br/>E = Extranjero.<br/>P = Pasaporte.')); ?>
		<?php echo $form->textField($modelPersona,'nu_cedula',array('toolt'=>'r','title'=>'Indique su cédula.<br/>Permitido solo números sin puntos ni comas<br/>En caso de ser persona jurídica escriba la cédula del representante legal de la empresa.')); ?>
		<?php echo $form->error($modelPersona,'tx_nacionalidad'); ?>
		<?php echo $form->error($modelPersona,'nu_cedula'); ?>
	</div>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		
		<div>
        
        <?php echo $form->labelEx($Captcha,'verifyCode'); ?>
		<?php echo $form->textField($Captcha,'verifyCode',array('autocomplete'=>'off','style'=>'width:195px','toolt'=>'r','title'=>'Introduzca el código que aparece en la imagen<br/>Solo letras. No distingue de mayúsculas y minúsculas<br/>Para cambiar el código haga click en la imagen')); ?>
		</div>
        <?php echo $form->error($Captcha,'verifyCode'); ?>
        <div style="width:160px;display:inline-block;">
		<?php $this->widget('CCaptcha',array(
				'clickableImage'=>true,
				'showRefreshButton'=>false,
				)); ?>
        </div>
		
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
        <?php echo CHtml::button('Cancelar', array('submit' => array('/usuario/usuario/'))); ?>
	</div>
    </div>

	

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>