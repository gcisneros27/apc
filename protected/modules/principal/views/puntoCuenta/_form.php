<?php
/* @var $this PuntoCuentaController */
/* @var $model PuntoCuenta */
/* @var $form CActiveForm */
?>
<?php
Yii::app()->clientScript->registerScript('muestra_oculta','
                            jQuery("#PuntoCuenta_presidencial").change(function(){
                            if($("#PuntoCuenta_presidencial").is(\':checked\') ){
                                $(".oc1").hide("slow");
                                
                            }
                            else{
                                $(".oc1").show("slow");
                            }
                        });
  
');
?>

<div class="ui form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'punto-cuenta-form',
	'enableAjaxValidation'=>false,
	//'htmlOptions'=>array('class'=>'blockuis'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
        <?php // echo $form->errorSummary($model); ?>
<?php echo $form->beginUiForm('Cargando...');	?>
	

        
        <div class="one field">
            <?php  echo $form->fieldCheck($model,'presidencial',$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre del Menu, otem o subitem.' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('presidencial'),)); ?>
        </div>
        
        <div class="two fields">
            <?php  echo $form->fieldTextLeft($model,"co_punto_cuenta",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Código del Punto de Cuenta' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('co_punto_cuenta'),),false); ?>
            
            <?php echo $form->fieldSelect2Left($model,'id_punto_padre',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(PuntoCuenta::model()->findAll('presidencial=:st',array(':st'=>true)), 'id_punto_cuenta','co_punto_cuenta'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>				      
            
        </div>
        <div class="two fields">
            <?php  echo $form->fieldTextLeft($model,"monto_bs",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto en Bolivares' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_bs'),),false); ?>
            
            <?php  echo $form->fieldTextLeft($model,"monto_disp_bs",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto Disponible en Bolivares' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_disp_bs'),),false,$param=array('claseGlobal'=>'oc1')); ?>
               
        </div>
        <div class="two fields">
            <?php  echo $form->fieldTextLeft($model,"monto_dv",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto en Divisas' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_dv'),),false); ?>
           
            <?php  echo $form->fieldTextLeft($model,"monto_disp_dv",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto Disponible en Divisas' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_disp_dv'),),false,$param=array('claseGlobal'=>'oc1')); ?>
              
        </div>
        <div class="two fields">
            <?php echo $form->fieldSelect2Left($model,'id_tp_moneda',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(Moneda::model()->findAll('st_moneda=:st',array(':st'=>true)), 'id_moneda','nb_moneda'),$combosLimipiar=array(),$indice=NULL,$opcion=array()); ?>				      
            <?php echo $form->fieldSelect2Left($model,'id_tp_recurso',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(TipoRecurso::model()->findAll('st_tp_recurso=:st',array(':st'=>true)), 'id_tp_recurso','nb_tp_recurso'),$combosLimipiar=array(),$indice=NULL,$opcion=array()); ?>				      				      
        </div>
        
        <div class="one field">
        <?php  echo $form->fieldTextLeft($model,"asunto",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Asunto del Punto de Cuenta' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('asunto'),),false); ?>    
        </div>
        <div class="one field">
        <?php  echo $form->fieldTextAreaLeft($model,"descripcion",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Descripción del Punto de Cuenta' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('descripcion'),),false); ?>    
        </div>
	<div class="one field">
        <?php  echo $form->fieldTextLeft($model,"presentado",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Punto de Cuenta Presentado Por:' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('presentado'),),false); ?>    
        </div>
        <div class="two fields">
         <?php echo $form->fieldSelect2Left($model,'id_funcionario',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(Funcionario::model()->findAll('st_funcionario=:st',array(':st'=>true)), 'id_funcionario','cargo_funcionario'),$combosLimipiar=array(),$indice=NULL,$opcion=array()); ?>				         
         <?php  echo $form->fieldCalendarLeft($model,"fecha_aprobacion",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Fecha de Aprobación del Punto de Cuenta' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('fecha_aprobacion'),),false,$rango='1900:c'); ?>       
        </div>

	

	
        <div style="text-align:center">
            <?php echo $form->saveResetButton()?>
	</div>
<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->