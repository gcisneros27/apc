<?php

$cs=Yii::app()->clientScript;
$cs->scriptMap=array(
    'jquery.js'=>false,
	'jquery.min.js'=>false,
	'jquery-ui.min.js'=>false,
	'jquery.toggle.buttons.js'=>false,
	'select2.js'=>false,
	'jquery-ui-i18n.min.js'=>false,
	'jquery.maskedinput.js'=>false,
);

?>

<div class="form">
<?php  $form = new SemanticForm();?>

	<div id="a<?php echo $id?>">
		<br>
    <div class="one field">
      <?php  echo $form->fieldTextLeft($model,"[$id]nombre_item",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nombre_item'),),false); ?>
      <?php //echo CHtml::activeHiddenField($model,"[$id]idmotivoInfraccion"); ?>
    </div>
    <div class="two fields">
      <?php echo $form->fieldSelect2Left($model,'operacion',$disabledifisnotnew=false,$htmlOptions=array(),false,$conLabel = true,
      $data=CHtml::listData(Authitem::model()->findAll(), 'name','name'),$combosLimipiar=array(),$indice=$id, $opciones = array('conLabel'=>TRUE,'multiple'=>true)); ?>

    </div>
					<div class="five fields">
						<?php  echo $form->fieldTextLeft($model,"[$id]ruta_imagen",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('ruta_imagen'),),false); ?>
						<?php  echo $form->fieldTextLeft($model,"[$id]orden",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('orden'),),false); ?>

					</div>
					  <div class="ui divider"></div>
				</div>

</div><!-- form -->
<?php Yii::app()->clientScript->registerScript('sdos','
							$("#'.CHtml::activeId($model,"[$id]id_motivo_economico").'").select2("val", "");',CClientScript::POS_LOAD);
?>
