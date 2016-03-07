<style>
	table.preview tr.new{
		background-color:#C5FBBD;
	}
	td.tdact,th.tdact {
		border: 1px solid #529EC6;
	}
</style>

<div class="form">
<?php $form = new SemanticForm();?>
<?php 
 		$tabla="";
 		$i=0;
 		$accioness=false;
 		$cont="";
 		
 		$controllers = Yii::app()->metadata->getControllers($modulo);
 		foreach ($controllers as $controlador){
 			
 	 			if ($controlador!='DefaultController'){
 	 				
 					$visualizarController = TRUE;
 					$nb_controlador=explode("Controller", $controlador);
 					$actions = Yii::app()->metadata->getActions($controlador,$modulo);
 					$acciones =array();
 					//guardar las acciones del modulo
 					foreach ($actions as $action){
 						//no permitir que la accion  s se guarde en el array
 						//construccion de la accion completa
 						if($action!='s')
 							$acciones[]= $modulo."/".$nb_controlador[0]."/".$action;
 					}
 					//1- que los valores sean unico
 					//2- convertir el array en un string separado por coma y comilla '
 					//3- agragrar las comillas ' que abren y cierran
 					//4- colocar la cadena en minuscula
 					$acciones_array =strtolower("'".implode("','", array_unique($acciones))."'");
 					
 					//buscar todas las rutas del modulo que esta registrada
 					$connection=Yii::app()->db;
 					$query =$connection->createCommand('SELECT lower(name) as ruta FROM "seguridad"."authitem" "t" WHERE type=0 AND LOWER(TRIM(name))in ('.$acciones_array.')');
 					$permiso=$query->queryAll();
 					$permisos= array();
 					foreach($permiso AS $keyP => $valueP){
 						$permisos[]=trim($valueP['ruta']);
 					}

 					//si tiene acciones que no han sido guardadas entra en la condicion
 					if(count($acciones)>count($permisos)){?>
 						<div class="ui positive message fields" >
										<div class="fifteen wide field" style="font-color:red;cursor: pointer; text-align: left" onClick='showhide("<?php echo $i?>")'>
											<b ><?php  echo $nb_controlador[0]?></b>
											<?php echo CHtml::image('images/down.png','',array('id'=>'image_'.$i,'style'=>'vertical-align:middle;')); ?>
											<?php echo CHtml::hiddenField('oculto_'.$i, 0); ?>
											
										</div>
										<div class="one wide field" id="id_chk_<?php echo $i?>" style="display: none"><input style="align:right" type="checkbox" name="1" id="checkbox_<?php echo $nb_controlador[0]?>" onClick='seleccionarTodos("<?php echo $nb_controlador[0]?>")' /></div>
			 			</div>
						<div class="menu " id="id_<?php echo $i?>" style="display: none">
 						<?php 
 						foreach ($acciones as $keyA => $valueA){
 							//si no se encuentra el permiso en el array permiso crea los campos
 								if(array_search(strtolower($valueA), $permisos)===false){
 									$modelOperaciones [$i]= new RegistrarOperacion('inicial');
			 						$modelOperaciones[$i]->nombre_controller= $nb_controlador[0];
			 						$modelOperaciones[$i]->operacion_ruta= $valueA;
			 						echo CHtml::activeHiddenField($modelOperaciones[$i],"[$i]nombre_controller");
			 						echo CHtml::activeHiddenField($modelOperaciones[$i],"[$i]operacion_ruta");
			 						$accioness=true;?>
			 						<div class="fields">
			 							<div class="seven wide field" style="text-align: left"><?php echo $valueA ?></div>
			 							<div class="seven wide field" style="text-align: left">
			 								<?php  echo $form->textField($modelOperaciones[$i],"[$i]operacion_descripcion",$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Descripcion de la Operación' , 
 																		"data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>'Descripción de la Operación', 'width'=>'100%')); ?>
			 							</div>
			 							<div class="two wide field"  style="align:right">
			 								<?php  	echo 	$form->checkBox($modelOperaciones[$i],"[$i]operacion_chk",array('class'=>$nb_controlador[0]));?></div>
			 							</div>
 								<?php 
 									
 								}
 						$i++;}
 					?></div><?php 	
 					}
 				
 	 		}
	}
	?>	

				<?php if($accioness){?>
					<div class="ui divider"></div>
						<div style="text-align:center">
				    		<?php echo CHtml::htmlButton('<i class="save icon"></i> Guardar', array('type'=>"submit",'class' => 'ui green right submit labeled icon button'));?>		      
					  		<?php echo CHtml::htmlButton('<i class="eraser icon"></i> Limpiar', array('type'=>"reset",'class' => 'ui blue right labeled icon button'));	?>	
					  	</div>
				<?php }
					else{?>
						No se encontraron nuevas acciones del modulo <?php echo $modulo; }?>
					
	
<!-- form -->	
	
	</div>
	