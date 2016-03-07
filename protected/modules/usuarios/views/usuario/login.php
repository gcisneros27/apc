

<div class="ui horizontal segments red segment"  style="padding-top: 10px">


<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>


<!--    <div class="row">
      <div class="column">
        <h1 class="center aligned ui header">
          APLICACIÓN DE PUNTOS DE CUENTA
        </h1>
      </div>
    </div>-->
    
        <div class="ui segment">
      <div class="ten wide column">
          <div style="text-align: center"><h2 class="ui header">Aplicación de Puntos de Cuenta</h2></div>
          
        <img class="ui centered large rounded fluid image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/gmvv.png">

        <div class="ui section divider"></div>
        <div class="ui animated selection list">
          <div class="item">
            MINISTERIO DEL PODER POPULAR PARA HÁBITAT Y VIVIENDA
            <div class="right floated">APC</div>
          </div>
        </div>
      </div>
        </div>
 <div class="ui segment">
 <?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'login-form',
	'clientOptions'=>array(

	),
)); ?>
 
		<div class="ui secondary form segment">
		  <h3 class="ui header center aligned">Inicio de Sesión</h3>
	      <div class="field <?php echo ($model->hasErrors('tx_usuario'))?'error':(($getPost)?'success':''); ?>">
	      	<?php echo $form->label($model,'tx_usuario'); ?>
	        <div class="ui left icon input">
  			  <?php echo $form->textField($model,'tx_usuario',array('class'=>'comentario-focus','data-content'=>'Nombre de usuario. No distingue de mayúsculas y minúsculas' , "data-variation"=>"inverted","data-position"=>"left center",'placeholder'=>$model->getAttributeLabel('tx_usuario'),)); ?>
	          <i class="user icon"></i>
                    
			  <?php echo $form->requerido($model,'tx_usuario',array()); ?>
                       
			  
	        </div>
                  <?php echo $form->error($model,'tx_usuario',array('class'=>'ui red pointing prompt label transition visible')); ?>
	      </div>
	      <div class="field <?php echo ($model->hasErrors('tx_contrasena'))?'error':(($getPost)?'success':''); ?>">
	        <?php echo $form->label($model,'tx_contrasena'); ?>
	        <div class="ui left icon input">
	          <?php echo $form->passwordField($model,'tx_contrasena',array('class'=>'comentario-focus','data-content'=>'Contraseña de usuario. Distingue de mayúsculas y minúsculas' , "data-variation"=>"inverted","data-position"=>"left center",'placeholder'=>$model->getAttributeLabel('tx_contrasena'),)); ?>
	          <i class="lock icon"></i>
			  <?php echo $form->requerido($model,'tx_contrasena',array()); ?>
			  
	        </div>
                  <?php echo $form->error($model,'tx_contrasena',array('class'=>'ui red pointing prompt label transition visible')); ?>
	      </div>
	      <div class="field <?php echo ($Captcha->hasErrors('verifyCode'))?'error':(($getPost)?'success':''); ?>">
	        <?php echo $form->label($Captcha,'verifyCode'); ?>
	        <div class="ui left icon input">
 			  <?php echo $form->textField($Captcha,'verifyCode',array('autocomplete'=>'off','class'=>'comentario-focus','data-content'=>'Introduzca el código que aparece en la imagen. Solo letras. No distingue de mayúsculas y minúsculas. Para cambiar el código haga click en la imagen', "data-variation"=>"inverted","data-position"=>"left center")); ?>
	          <i class="attention icon"></i>
				<?php echo $form->requerido($Captcha,'verifyCode',array()); ?>
 		</div>
                  <?php echo $form->error($Captcha,'verifyCode',array('class'=>'ui red pointing prompt label transition visible')); ?>
                  <div style="text-align: center;margin-top:2%">
				<?php $this->widget('CCaptcha',array(
						'clickableImage'=>true,
						'showRefreshButton'=>false,
						)); ?>
		        </div>
                  
	      </div>
	      
	      <div class="field">
	      
			<div class="ui slider checkbox">
				<?php echo $form->checkBox($model,'recordarme',array('data-content'=>'Mantiene la sesión activa por 30 días o hasta que cierre la sesión',"data-variation"=>"inverted","data-position"=>"left center")); ?>
				<?php echo $form->labelEx($model,'recordarme'); ?>
			</div>	      
				      
		  </div>     
	      
	      	      
	      <div class="ui error message">
	        <div class="header">We noticed some issues</div>
	      </div>    
                  <div style="text-align: center">
		  <?php echo CHtml::htmlButton('<i class="sign in icon"></i> Ingresar', array('type'=>"submit",'class' => 'ui blue right submit labeled icon button'));	?>	      
                  </div>
	    </div>        
 
 <?php $this->endWidget(); ?>
 </div>        
      
   
</div>

