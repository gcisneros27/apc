
<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'auth-item-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('class'=>'blockuis','OnSubmit'=>'$.blockUI({ message: $("#domMessage")});$("#box6Clear").click();'),
));
?>

<div class="ui comments form">
		<div class="ui form secondary segment">
		  <div id="cargando" class="ui dimmer">
		    <div class="ui text loader">Cargando...</div>
		  </div>				
		  <h3 class="ui header center aligned">Datos de la Operacion</h3>
		  <div class="two fields">
			  	  <?php echo $form->fieldTextLeft($model,'name',$disabledifisnotnew=true,$htmlOptions=array('maxlength'=>'64'),$getPost); ?>				      
		  </div>
		  <div class="two fields">
			  	  <?php echo $form->fieldTextAreaLeft($model,'description',$disabledifisnotnew=false,$htmlOptions=array('rows'=>6, 'cols'=>50),$getPost); ?>				      
		  </div>	
		  <div class="two fields">	
					<?php
							echo $this->renderPartial('draggdropOperacion', array('model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,		 	'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild
								)); 
					?>
		  </div>
		
		<div class="ui divider"></div>
					<div style="text-align:center">
			  			<?php echo CHtml::htmlButton('<i class="save icon"></i> Guardar', array('type'=>"submit",'class' => 'ui teal right submit labeled icon button'));	?>	      
			  			<?php //echo CHtml::htmlButton('<i class="undo icon"></i> Limpiar', array('type'=>"reset",'class' => 'ui blue right labeled icon button'));	?>
					</div>
				</div>
   		</div>
 <?php $this->endWidget(); ?>  