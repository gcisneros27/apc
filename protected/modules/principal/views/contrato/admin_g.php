<?php
/* @var $this ContratoController */
/* @var $model Contrato */
?>
<?php   echo SemanticForm::beginUiAdmin(
        'Listado de Contratos',
        $menu=array(
                     	array('name'=>'Volver a Puntos de Cuenta','url'=>array('/principal/PuntoCuenta/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                       //array('name'=>'Registrar Contrato','url'=>array('/principal/Contrato/Create','id'=>$modelPunto->id_punto_cuenta),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
//                     array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create'),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					),
        'red'
        
        );

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contratog-grid',
        'itemsCssClass'=>'ui table segment',
	'pagerCssClass'=>'pagination pagination-centered',
	'dataProvider'=>$model->searchG(),
	//'afterAjaxUpdate'=>"function(id,data){ $('#Contrato_co_contrato').addClass('ui dropdown')}",
		 
	'filter'=>$model,
        //'ajaxUrl'=>Yii::app()->createUrl("/principal/Contrato/admin"),
        'pager'=> array(
			'header' => '',
			'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
	),
	'columns'=>array(
		//'co_contrato',
                array(
			'name'=>'id_punto_cuenta',
			'value'=> '$data->idPuntoCuenta->co_punto_cuenta',
			'filter'=>
			CHtml::activeDropDownList($model,'id_punto_cuenta',CHtml::listData(PuntoCuenta::model()->findAll(),'id_punto_cuenta','co_punto_cuenta'),
				array('class'=>'ui dropdown','prompt'=>'--SELECCIONE--',)),
                        'type'=>'html',        

                    ), 
                array(
			'name'=>'co_contrato',
			'value'=> '$data->co_contrato',
			'filter'=>
			CHtml::activeDropDownList($model,'co_contrato',CHtml::listData(Contrato::model()->findAll(),'co_contrato','co_contrato'),
				array('class'=>'ui dropdown','prompt'=>'--SELECCIONE--',)),
                        'type'=>'html',        

                    ), 
                'objeto',
		
                array(
                        
                        'name'=>'monto_total',
                        'value'=>'$data->monto_total',
                    ),
                   array(
                            'header'=>'Estado',
                            'name'=>'id_estado',
                            //'visible'=>(($modelActo->visibilidad==0)),
                            'value'=>'(isset($data->idEstado->nombre))?$data->idEstado->nombre:""',
                            'filter'=>CHtml::activeDropDownList($model,'id_estado',CHtml::listData(GeoEstado::model()->findAll(),'geo_estado_id','nombre'),
                                            array(
                                                 'prompt'=>'--Seleccione--',
                                                'class'=>'ui selection dropdown','prompt'=>'SELECCIONE',

                                                )
                                                ),///Carga el filtro como una lista
                        ),
                //'id_estado',
		//'nb_obra',
		
		
		/*
		'id_municipio',
		'id_parroquia',
		'id_tp_contrato',
		'id_institucion',
		'fecha_suscripcion',
		'fecha_culminacion',
		'monto_total',
		'avance_financiero',
		'avance_fisico',
		'observaciones',
		'id_estatus',
		'nb_constructor',
		'telf_constructor',
		'correo_constructor',
		'nb_inspector',
		'telf_inspector',
		'correo_inspector',
		*/
		array(
			'class'=>'CButtonColumn',
                        'header'=>"Acción",
                        'template' => '{view}',
                        'buttons'=>array(
                            'view' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/View")',
                                                'label' => '<i class="zoom in black circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'view fancybox sin_sub') ,
                                                'imageUrl'=>false,
                                            ),
                            
                            'update' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/Update")',
                                                'label' => '<i class="edit black circular icon link comentario-hover" data-content="Modificar Contrato" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
                                                'imageUrl'=>false,								
                                                        ),
                            'addenda' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/Update")',
                                                'label' => '<i class="add square blue circular icon link comentario-hover" data-content="Administrar Addenda" data-variation="inverted" style="display:inline"></i>',
                                                'url'=>"Yii::app()->createUrl('principal/addendum/admin',array('id'=>\$data->id_contrato))",
                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
                                                'imageUrl'=>false,								
                                                        ),
                            'borrar' => array(
//			                        'visible'=>'Yii::app()->user->checkAccess("rol/AuthItem/Delete")',
						'label' =>'<i class="trash red circular icon link comentario-hover" data-content="Eliminar Contrato" data-variation="inverted" style="display:inline"></i>',
			                        'url'=>"CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_contrato))",
                                                'imageUrl'=>false,
                                                'options'=>array('title'=>'','class'=>'sin_sub3 sin_sub','id'=>"borrar") ,
                                                                            'click'=>"function() {
                                                                                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
                                                                                                $.fn.yiiGridView.update('contrato-grid', {
                                                                                                        type:'POST',
                                                                                                        url:$(this).attr('href'),
                                                                                                        success:function(texto) {
                                                                                                                        if(texto=='eliminado'){ $.fn.yiiGridView.update('contrato-grid');alert('El contrato ha sido eliminado exitosamente.');}
                                                                                                                        else alert('Error al eliminar el contrato.');
										                                        		
										                                          }
										                                });
										                                return false;
										                        }",
			                                                ),
                        ),
		),
	),
)); ?>
<?php
   echo SemanticForm::endUiAdmin(); 
?>