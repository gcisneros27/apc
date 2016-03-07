<?php
/* @var $this AddendumController */
/* @var $model Addendum */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'addendum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php echo $form->beginUiForm('Cargando...');	?>
        
         <div class="one field">
         <?php echo $form->fieldSelect2Left($model,'id_punto_cuenta',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(PuntoCuenta::model()->findAll('presidencial=:st',array(':st'=>true)), 'id_punto_cuenta','co_punto_cuenta'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>
         </div>
        <div class="one field">
            <?php  echo $form->fieldCalendarLeft($model,"fecha_addendum",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Fecha del Addendum' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('fecha_addendum'),),false,$rango='1900:c'); ?>       
        </div>
        
        <div class="one field">
        <?php  echo $form->fieldTextLeft($model,"monto_addendum",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto de Incremento' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_addendum'),),false); ?>    
        </div>
        <div class="one field">
         <?php echo $form->fieldSelect2Left($model,'id_estatus_addendum',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(EstatusAddendum::model()->findAll('st_estatus_addendum=:st',array(':st'=>true)), 'id_estatus_addendum','nb_estatus_addendum'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>
         </div>

	<div style="text-align:center">
            <?php echo $form->saveResetButton()?>
	</div>
<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->