<?php
/* @var $this ContratoController */
/* @var $model Contrato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'contrato-form',
	'enableAjaxValidation'=>false,
	//'htmlOptions'=>array('class'=>'blockuis'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>


<?php echo $form->beginUiForm('Cargando...');	?>
        
        
        <div class="two fields">
            <?php  echo $form->fieldTextLeft($model,"co_contrato",$disabledifisnotnew=true,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Número de Contrato' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('co_contrato'),),false); ?>
            
            <?php echo $form->fieldSelect2Left($model,'id_tp_contrato',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(TipoContrato::model()->findAll('st_tp_contrato=:st',array(':st'=>true)), 'id_tp_contrato','nb_tp_contrato'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>				      
            
        </div>
        <div class="three fields">
        <?php echo $form->fieldSelect2Left($model,'id_institucion',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(Institucion::model()->findAll('st_institucion=:st',array(':st'=>true)), 'id_institucion','nb_institucion'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>				      
        <?php  echo $form->fieldCalendarLeft($model,"fecha_suscripcion",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Fecha de Suscripción del contrato' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('fecha_suscripcion'),),false,$rango='1900:c'); ?>       
            <?php  echo $form->fieldCalendarLeft($model,"fecha_culminacion",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Fecha de Culminación del Contrato' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('fecha_culminacion'),),false,$rango='1900:c'); ?>       
        </div>
        <div class="one field">
         <?php  echo $form->fieldTextAreaLeft($model,"objeto",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Objeto del Contrato' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('objeto'),),false); ?>   
        </div>
        <div class="ui divider"></div>
        <div class="three fields">
            <?php /* echo $form->fieldSelect2Left($model,'id_estado',$disabledifisnotnew=false,$htmlOptions=array(),$getPost,$conLabel = true,
                                        $data=CHtml::listData(GeoEstado::model()->findAll(), 'geo_estado_id','nombre'),
                                        $combosLimipiar=array('id_municipio'=>$model,'id_parroquia'=>$model)); ?>
 					
            <?php  echo $form->fieldSelect2RemotoDependiente2($model,'id_municipio',$attributeDependiente='geo_estado_id',$clase='GeoMunicipio',$nombreDelCampo = 'nombre',$disabledifisnotnew=false,$htmlOptions=array(),$getPost, $controllerPrimeraBusqueda ='Comun/Busqueda',$controllerBusqueda='Comun/BusquedaModelo',$combosLimipiar=array('id_parroquia'=>$model),$indice=NULL,$opciones = array('conLabel'=>true)); ?>
            <?php  echo $form->fieldSelect2RemotoDependiente2($model,'id_parroquia',$attributeDependiente='geo_municipio_id',$clase='GeoParroquia',$nombreDelCampo='nombre',$disabledifisnotnew=false,$htmlOptions=array(),$getPost, $controllerPrimeraBusqueda='Comun/Busqueda',$controllerBusqueda='Comun/BusquedaModelo',array(),$indice=NULL,$opciones = array('conLabel'=>true)); */?>               
        	<?php  echo $form->fieldSelect2Left($model,'id_estado',$disabledifisnotnew=false,$htmlOptions=array(),$getPost,$conLabel = true,
                                                $data=CHtml::listData(GeoEstado::model()->findAll(array('condition'=>'nombre !=\'OTRO\'','order'=>'nombre')), 'geo_estado_id','nombre'),$combosLimipiar=array('id_municipio'=>$model,'id_parroquia'=>$model),$indice=NULL,$opciones = array('conLabel'=>true)); ?>
             <?php  echo $form->fieldSelect2Remoto($model,'id_municipio',array('clase'=>'GeoMunicipio','attributeDependientes'=>array('geo_estado_id'=>CHtml::activeId($model,'id_estado')),
                                        																					'combosLimipiar'=>array('id_parroquia'=>$model))); ?>
             <?php  echo $form->fieldSelect2Remoto($model,'id_parroquia',array('clase'=>'GeoParroquia','attributeDependientes'=>array('geo_municipio_id'=>CHtml::activeId($model,'id_municipio')))); ?>
                                    
                                    
        </div>
        <div class="one field">
            <?php  echo $form->fieldTextLeft($model,"nb_obra",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre de la Obra' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nb_obra'),),false); ?>   
        </div>
        
        <div class="three fields">
            <?php  echo $form->fieldTextLeft($model,"monto_total",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Monto total del Contrato' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('monto_total'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"avance_financiero",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Porcentaje de Avance Financiero' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('avance_financiero'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"avance_fisico",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Porcentaje de Avance Fisico' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('avance_fisico'),),false); ?>   
            
        </div>
	
        <div class="one field">
         <?php  echo $form->fieldTextAreaLeft($model,"observaciones",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Observaciones' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('observaciones'),),false); ?>   
        </div>
        <div class="one field">
	<?php echo $form->fieldSelect2Left($model,'id_estatus',$disabledifisnotnew=true,$htmlOptions=array(),$getPost,true,
                                                          $data=CHtml::listData(EstatusContrato::model()->findAll('st_estatus_contrato=:st',array(':st'=>true)), 'id_estatus_contrato','nb_estatus_contrato'),$combosLimipiar=array(),$indice=NULL,$opcion=array('claseGlobal'=>'oc1')); ?>				      
  
        </div>
	<div class="ui divider"></div>
        <div class="three fields">
            <?php  echo $form->fieldTextLeft($model,"nb_constructor",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre del Constructor' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nb_constructor'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"telf_constructor",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Telefono del Constructor' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('telf_constructor'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"correo_constructor",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Correo del Constructor' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('correo_constructor'),),false); ?>   
            
        </div>
        <div class="ui divider"></div>
        <div class="three fields">
            <?php  echo $form->fieldTextLeft($model,"nb_inspector",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Nombre del Inspector' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('nb_inspector'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"telf_inspector",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Telefono del Inspector' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('telf_inspector'),),false); ?>   
            <?php  echo $form->fieldTextLeft($model,"correo_inspector",$disabledifisnotnew=false,$htmlOptions=array('class'=>'comentario-focus','data-content'=>'Correo del Inspector' , "data-variation"=>"inverted","data-position"=>"top center",'placeholder'=>$model->getAttributeLabel('correo_inspector'),),false); ?>   
            
        </div>
	

	<div style="text-align:center">
            <?php echo $form->saveResetButton()?>
	</div>
<?php echo $form->endUiForm(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->