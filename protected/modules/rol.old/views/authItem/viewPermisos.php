<?php
/* @var $this MFuncionariosController */
/* @var $model MFuncionarios */

echo SemanticForm::beginUiView('Visualizar Reglas', 
		$opciones=array('ancho'=>'100%',
				'menu'=>array(
	  				 array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
                     //array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create','publico'=>'true'),
                     array('name'=>'Registrar Tarea','url'=>array('/rol/AuthItem/CreateTarea'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create','publico'=>'true' ),
                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ,'publico'=>'true'),
                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
					 array('name'=>'Visualizar Reglas','url'=>array('/rol/AuthItem/ViewPermisos','modulo'=>$modulo),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
					
	)));?>
	<div class="ui form segment">
		
		<?php $form=$this->beginWidget('SemanticForm', array(
			'id'=>'administrar-modulos-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
		
			<div class="ui form">
				<div class="ui form secondary segment">
					<div id="cargando" class="ui dimmer">
						<div class="ui text loader">Cargando...</div>
					</div>			
						<!-- FORMULARIO -->			  
											
						<div class="one field">
						
						
						
							<div id="reglas" style="padding-top:50px;padding-bottom:50px">
			<?php 
			
					$controlador="";
					if(count($rules)>1){
						foreach ($rules as $rule){
							if ($controlador!=$rule['controlador']){
								echo "<br/><br/><br/>Controlador: ".$rule['controlador']."<br/><br/>";
								$controlador=$rule['controlador'];
							}
							$accion = explode("/",$rule['name']);
							echo "array('allow','actions' => array('".$accion[2]."'),	'roles' => array('".$rule['name']."')),<br/>";
						}
					}
					else{?>
						<div style="text-align:center">
							El M&oacute;dulo "<?php echo $modulo?>" no posee reglas para visualizar
						</div>
						<?php  
					}
					
			?>
			</div>
			<input type="hidden" id="moduloo" />
			
			
			
						</div>
				</div>
			</div>
		    
		   <?php $this->endWidget(); ?>
		
		</div><!-- form -->
	<?php SemanticForm::endOnlyView(); ?>