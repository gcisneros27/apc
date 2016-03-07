
<div class="ui one column grid">
  <div class="column">
    <div class="ui piled teal segment">
      <h2 class="ui header center aligned color_titulo">
        <i class="icon inverted circular teal settings"></i> Cambiar Contraseña <?php echo $model->tx_usuario; ?>
      </h2>
		<div class="ui section divider"></div>
		<div class="container" >
		<?php
		    foreach(Yii::app()->user->getFlashes() as $key => $message) {
		    	$titulo="";
		    	if ($key=="success")$titulo="¡Registro Guardado Exitosamente!";
		    	else if ($key=="error")$titulo="¡Error!";
		    	else if ($key=="info")$titulo="¡Información!";
		    	else if ($key=="warning")$titulo="¡Importante!";
		        echo 
					'<div class="ui '.($key).' message" style="text-align: center">
					  <i class="close icon"></i>
					    <div class="header"> '.($titulo).'</div>
					     '.($message).'
					</div>';	
		    }
		?>
		</div>  
		<?php $form=$this->beginWidget('SemanticForm', array(
			'id'=>'user-usuarios-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('class'=>'blockuis'),
		));
		?>
		<div class="ui comments form">
				<div class="ui form secondary segment">
				  <div id="cargando" class="ui dimmer">
				    <div class="ui text loader">Cargando...</div>
				  </div>				
				  <h3 class="ui header center aligned">Datos Personales</h3>
				  <div class="one field">
					  	  <?php echo $form->fieldContrasenaLeft($model,'tx_contrasena',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  	</div>
					<div class="one field">  
					  	  <?php echo $form->fieldContrasenaLeft($model,'nueva',$disabledifisnotnew=false,$htmlOptions=array(),$getPost); ?>
				  	</div>
					<div class="one field">  
					  	  <?php echo $form->fieldContrasenaLeft($model,'repetirnueva',$disabledifisnotnew=false,$htmlOptions=array('maxlength'=>100),$getPost); ?>
				  	</div>
				
					<div class="ui divider"></div>
					<div style="text-align:center">
			  			<?php echo CHtml::htmlButton('<i class="save icon"></i> Guardar', array('type'=>"submit",'class' => 'ui teal right submit labeled icon button'));	?>	      
			  			<?php echo CHtml::htmlButton('<i class="undo icon"></i> Limpiar', array('type'=>"reset",'class' => 'ui blue right labeled icon button'));	?>
					</div>
				</div>
   		</div>

<?php $this->endWidget(); ?>

</div>
  </div>
</div>
		