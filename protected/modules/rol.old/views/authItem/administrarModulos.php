

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php 
Yii::app()->clientScript->registerScript('suno','	
	
	function buscarData(){
		var modulo=$("#'.CHtml::activeId($model,'modulos2').'").select2("val");

		var modulo_value=$("#'.CHtml::activeId($model,'modulos2').'").select2("val");
		if(modulo_value==""){
			$("#bVerReglas").css("display","none");
			$(\'#acciones\').html("");
			return;
		}
		
		$("#bVerReglas").css("display","block");
		$("#VerReglas").attr("href","'.CController::createUrl('/rol/authItem/ViewPermisos').'&modulo="+$("#'.(Chtml::activeId($model,"modulos2")).'").select2("val"));
		
		c="'.CController::createUrl('/rol/authItem/BuscarAcciones').'"
		$.ajax({
			url: c,
			cache: false,
			type: "POST",
			data: ({modulo : modulo}),
			beforeSend: function() {$(\'#acciones\').html(\'Cargando...\')}, 
			success: function(data) {
				if(data==\'\')data="No se encontraron nuevas acciones del modulo "+modulo;
				$(\'#acciones\').html(data);
			}
		});		
	}
',CClientScript::POS_HEAD);

?>
<?php
/* @var $this MFuncionariosController */
/* @var $model MFuncionarios */

echo SemanticForm::beginUiView('Visualizar Modulos', 
		$opciones=array('ancho'=>'100%',
								'menu'=>array  (
		 array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
                     //array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create','publico'=>'true'),
                     array('name'=>'Registrar Tarea','url'=>array('/rol/AuthItem/CreateTarea'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create','publico'=>'true' ),
                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ,'publico'=>'true'),
                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
					
	)));?>


                <p class="note" style="text-align:center">Los Campos con <span class="required">*</span> son obligatorios.</p>
	<div class="ui form">
		<?php $form=$this->beginWidget('SemanticForm', array(
			'id'=>'administrar-modulos-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
				<div class="ui form secondary segment">		
						<!-- FORMULARIO -->			  
											
						<div class="one field">
							<?php $mod=Yii::app()->metadata->getModules();
							
									$mod2=array();
									foreach ($mod as $key => $value) {
										if ($mod[$key]=='.svn')
						    				unset($mod[$key]);
						    			else {
						    				$mod2[$value]=$value;
						    			}
									}?>
							<?php echo $form->fieldSelect2Left($model,'modulos2',$disabledifisnotnew=false,$htmlOptions=array('onChange'=>'buscarData()'),false,$conLabel = true,
                                                              $data=$mod2,  array(),$keyndice=NULL,$opciones = array('conLabel'=>true)); ?>	
							      	        
						</div>
							
	
						<div id="bVerReglas" style="display: none">
							<?php echo CHtml::link('<i class="save icon"></i> Ver Reglas',
							        			array('/item/authItem/ViewPermisos','modulo'=>''),
							        			array('class'=>'ui blue right submit labeled icon button','id'=>'VerReglas')); ?>       
							<br><br>
						</div>	
							
						<div id="acciones" style="min-height:100px">
						
						<?php 
								$nombreControlador= '';
								$accioness= FALSE;
								if(count($modelOperaciones)>0){
									
								foreach ($modelOperaciones AS $key =>$value){
								if($nombreControlador !=$value->nombre_controller){
									if($nombreControlador!=''){echo '</div>';}
									$nombreControlador = $value->nombre_controller;
									$visualizarController = FALSE; 
									?>
							 							<div class="ui positive message fields" >
																	<div class="fifteen wide field" style="font-color:red;cursor: pointer; text-align: left" onClick='showhide("<?php echo $key?>")'>
																		<b ><?php  echo $value->nombre_controller?></b>
																		<?php echo CHtml::image('images/down.png','',array('id'=>'image_'.$key,'style'=>'vertical-align:middle;')); ?>
																		<?php echo CHtml::hiddenField('oculto_'.$key, 0); ?>
																		
																	</div>
																	<div class="one wide field" id="id_chk_<?php echo $key?>" style="display: none"><input style="align:right" type="checkbox" name="1" id="checkbox_<?php echo $value->nombre_controller?>" onClick='seleccionarTodos("<?php echo $value->nombre_controller?>")' /></div>
										 				</div>
														<div class="menu " id="id_<?php echo $key?>" style="display: none">
							 		<?php }
							 							echo CHtml::activeHiddenField($value,"[$key]nombre_controller");
							 							echo CHtml::activeHiddenField($value,"[$key]operacion_ruta");
							 						$accioness=true;?>
																<div class="fields">
																	<div class="seven wide field" style="text-align: left"><?php echo $value->operacion_ruta ?></div>
																	<div class="seven wide field" style="text-align: left">
																		<?php  echo $form->fieldTextLeft($value,"[$key]operacion_descripcion",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Descripción de la Operación' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$value->getAttributeLabel('operacion_descripcion')),false,$opciones = array('conLabel'=>false)); ?>				        
																	</div>
																									        
																	<div class="two wide field"  style="align:right">
																	<?php  	echo 	$form->checkBox($value,"[$key]operacion_chk",array('class'=>$value->nombre_controller)); ?></div>
																</div>
						<?php }
							}?>
				</div>
				<?php if($accioness):?>
					<?php echo $form->saveResetButton()?>
					</div>
				<?php endif;?>
				
			</div>
		   <?php $this->endWidget(); ?>
		
		<!-- form -->
		
		
		<?php 
		Yii::app()->clientScript->registerScript('cambiarPersona',"
		    $('.ui.checkbox').checkbox();
		        ",CClientScript::POS_READY
		        );
		?>
	</div>        
   
<?php echo SemanticForm::endUiView(); ?>

<?php 

Yii::app()->clientScript->registerScript('report', '
	function showhide(id) {
		if($("#oculto_"+id).attr("value")!=0) {
			$("#oculto_"+id).attr("value",0);
			$("#image_"+id).attr("src","images/down.png");
			$("#id_"+id).hide("fast");
			$("#id_chk_"+id).hide("fast");
		} 
		else {
			$("#contenedor"+id).show("fast");
			$("#oculto_"+id).attr("value",1);
			$("#id_"+id).show("fast");
			$("#id_chk_"+id).show("fast");
			$("#image_"+id).attr("src","images/up.png");
			
		}
	}
		
	function seleccionarTodos(id) {
		 if ($("#checkbox_"+id).is(\':checked\')) {
			$("."+id).attr(\'checked\',true);
	    } else {
	       $("."+id).attr(\'checked\',false);
	    }
			
	}',CClientScript::POS_HEAD);

?>