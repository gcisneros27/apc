<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'blockuis'),
));
?>
		<?php echo $form->beginUiForm('Cargando...');	?>
				  <div class="two fields">
					  	  <?php echo $form->fieldSelect2Left($model,'nacionalidad',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,$data=array('V' => 'Venezolano', 'E' => 'Extranjero','P' => 'Pasaporte')); ?>				      
					  	  <?php echo $form->fieldTextLeft($model,'cedula',$disabledifisnotnew=true,$htmlOptions=array('onblur'=>'buscarCedula(this.value);','maxlength'=>'8'),$getPost); ?>				      
					</div>
					<div class="two fields">
					  	  <?php echo $form->fieldTextLeft($model,'nombre1',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  		  <?php echo $form->fieldTextLeft($model,'nombre2',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  	</div>
					<div class="two fields">  
					  	  <?php echo $form->fieldTextLeft($model,'apellido1',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  		  <?php echo $form->fieldTextLeft($model,'apellido2',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>				    
					</div>				  
				    <div class="two fields">  
					  	  <?php echo $form->fieldTextLeft($model,'correo',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  		  <?php echo $form->fieldTextLeft($model,'telefono',$disabledifisnotnew=false,$htmlOptions=array('maxlength'=>'11'),$getPost); ?>					    
				    </div>					  
					<div class="ui horizontal icon divider">
					  <i class="circular pencil icon"></i>
					</div>			
					<h3 class="ui header center aligned">Datos de Usuario</h3>
				    <div class="two fields">  
					  	  <?php echo $form->fieldTextLeft($model,'tx_usuario',$disabledifisnotnew=true,$htmlOptions=array(),$getPost); ?>
				  		  <?php echo $form->fieldContrasenaLeft($model,'tx_contrasena',$disabledifisnotnew=false,$htmlOptions=array('maxlength'=>'11'),$getPost); ?>					    
				    </div>				  
				    <div class="two fields">  
					  	  <?php echo $form->fieldSelect2Left($modelAA,'itemname',$disabledifisnotnew=false,$htmlOptions=array(),$getPost,true,$data=CHtml::listData(AuthItem::model()->findAll('type=:tipo AND name!=:name1 AND name!=:name2 order by "name"',array(':tipo'=>2,':name1'=>'guest',':name2'=>'authenticated')), 'name','name'  )); ?>				      
					  	  <?php echo $form->fieldCheckLeft($model,'bo_activado',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>				      		
				    </div>				  
        <div style="text-align:center">
            <?php echo $form->saveResetButton()?>
	</div>
<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>
<?php 
Yii::app()->clientScript->registerScript('formularioEnterCedula','
	$("#'.(CHtml::activeId($model,'cedula')).'").keypress(function(e) {
		if (e.which == 13) {
		var ced=$("#'.(CHtml::activeId($model,'cedula')).'").val();		
			//buscarCedula(ced);
			if(ced.trim()!=""){	
				$("#'.(CHtml::activeId($model,'nombre1')).'").focus();
			}
			return false;
		}
	});
',CClientScript::POS_READY);
?>
<?php 
/* Realiza la carga de los datos a partir de la cedula ingresada */
Yii::app()->clientScript->registerScript('dataOnidex','
	function buscarCedula(cedula){		
			if((cedula.trim()!="")){
				var c="'.CController::createUrl('/comun/BuscarOnidex').'";	
				$.ajax({
					url:c,
					cache: false,                
					type: "POST",
					data: ({cedula:cedula}),
					beforeSend: function (){
						$( "#cargando" ).addClass( "active" );
					}, 
					success: function(data) 
					{	
						try
				       {
				       		$( "#cargando" ).removeClass( "active" );
							var d=jQuery.parseJSON(data)
							if(Object.keys(d).length>0){
								$("#'.(CHtml::activeId($model,'nombre1')).'").attr("value",d.nombre1);
								$("#'.(CHtml::activeId($model,'nombre2')).'").attr("value",d.nombre2);
								$("#'.(CHtml::activeId($model,'apellido1')).'").attr("value",d.apellido1);
								$("#'.(CHtml::activeId($model,'apellido2')).'").attr("value",d.apellido2);
								$("#'.(CHtml::activeId($model,'correo')).'").attr("value",d.correo);
								var telefono = d.telefono;
								if(telefono!=""){
									$("#'.(CHtml::activeId($model,'telefono')).'").attr("value",d.telefono);
								}
								$("#'.(CHtml::activeId($model,'nacionalidad')).'").select2("val", d.nacionalidad);
								$("#'.(CHtml::activeId($model,'fe_nacimiento')).'").attr("value",d.fe_nacimiento);
							}
				       }
				       catch(err)
				       {
				       		$( "#cargando" ).removeClass( "active" );
				       		limpiarCampos();
//				              alert("error");
				       }
					},
			      error: function (xhr, ajaxOptions, thrownError) {
			      	$( "#cargando" ).removeClass( "active" );
			      	limpiarCampos();
//			        alert(xhr.status);
//			        alert(thrownError);
			      }
				});	
			}
			else {
				limpiarCampos();

			}
}

function limpiarCampos(){
				$("#'.(CHtml::activeId($model,'nombre1')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'nombre2')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'apellido1')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'apellido2')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'correo')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'telefono')).'").attr("value","");
				$("#'.(CHtml::activeId($model,'nacionalidad')).'").select2("val", "");
				$("#'.(CHtml::activeId($model,'fe_nacimiento')).'").attr("value","");

}
',CClientScript::POS_END);
?>
