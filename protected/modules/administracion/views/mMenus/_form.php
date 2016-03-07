<?php
/* @var $this MmenusController */
/* @var $model MMenus */
/* @var $form CActiveForm */
?>

<div class="ui form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'mmenus-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'blockuis'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

 <?php echo $form->beginUiForm('Cargando...');	?>
            <!-- FORMULARIO -->
            <div class="one field">
                    <?php  echo $form->fieldTextLeft($model,'nombre_menu',$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre del Menu, otem o subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nombre_menu'),),false); ?>
                    <?php  //echo $form->fieldTextLeft($model,'orden',$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('orden'),),false); ?>

            </div>
            <div class="teen fields">
            <?php echo $form->fieldArbolareas($model, 'id_menu_padre',false,$arbol); ?>
            </div>
            <div class="one field">
                        <?php  echo $form->fieldTextLeft($model,"icono",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Icono del Items.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('icono'),),false); ?>
            </div>
            <div class="one field">
                        <?php  echo $form->fieldTextLeft($model,"color_texto",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Icono del Items.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('icono'),),false); ?>
            </div>
            <div class="one field">
                        <?php  echo $form->fieldTextLeft($model,"color_interfaz",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Icono del Items.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('icono'),),false); ?>
            </div>
        
            <div class="ui divider"></div>

			<div style="text-align:center">
				<?php echo CHtml::htmlButton('<i class="save icon"></i> Guardar', array('type'=>"submit",'class' => 'ui green right submit labeled icon button', 'id'=>'guardar'));?>
				<?php echo CHtml::htmlButton('<i class="eraser icon"></i> Limpiar', array('type'=>"reset",'class' => 'ui blue right labeled icon button'));	?>
				<?php echo CHtml::htmlButton('<i class="forward icon"></i> Guardar y Seguir', array('type'=>"submit",'class' => 'ui green right submit labeled icon button', 'id'=>'guardar_seguir'));?>
            </div>

<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
