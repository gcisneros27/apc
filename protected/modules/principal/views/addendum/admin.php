<?php
/* @var $this AddendumController */
/* @var $model Addendum */
?>
<?php   echo SemanticForm::beginUiAdmin(
        'Listado de Addenda',
        $menu=array(
                     	array('name'=>'Volver a Contratos','url'=>array('/principal/Contrato/Admin','id'=>$modelContrato->idPuntoCuenta->id_punto_cuenta),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                        array('name'=>'Registrar Addendum','url'=>array('/principal/Addendum/Create','id'=>$modelContrato->id_contrato),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
//                     array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create'),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					),
        'red'
        
        );

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'addendum-grid',
        'itemsCssClass'=>'ui table segment',
	'pagerCssClass'=>'pagination pagination-centered',
	'dataProvider'=>$model->search($modelContrato->id_contrato),
	'filter'=>$model,
        'ajaxUrl'=>Yii::app()->createUrl("/principal/Addendum/admin",array('id'=>$modelContrato->id_contrato)),
        'pager'=> array(
			'header' => '',
			'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
	),
	'columns'=>array(
		'nu_addendum',
		//'fecha_addendum',
                array(
                        'header'=>'Fecha de Aprobación',
                        'name'=>'fe_addendum',
                        'value'=>'implode("-",array_reverse(explode("-",$data->fecha_addendum)))',
                        'class'=>'SYDateColumn',		
                    ),
		//'monto_addendum',
                array(
                        
                        'name'=>'monto_addendum',
                        'value'=>'$data->monto_addendum',
                    ),
		//'id_estatus_addendum',
                array(
			'name'=>'id_estatus_addendum',
			'value'=> '$data->idEstatusAddendum->nb_estatus_addendum',
			'filter'=>
			CHtml::activeDropDownList($model,'id_estatus_addendum',CHtml::listData(EstatusAddendum::model()->findAll('st_estatus_addendum=TRUE'),'id_estatus_addendum','nb_estatus_addendum'),
				array('class'=>'ui dropdown','prompt'=>'--SELECCIONE--',)),
                        'type'=>'html',        

                    ), 
		//'st_addendum',
		//'id_contrato',
		/*
		'id_punto_cuenta',
		*/
		array(
			'class'=>'CButtonColumn',
                        'header'=>"Acción",
                        'template' => '{view}{update}{borrar}',
                        'buttons'=>array(
                            'view' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/View")',
                                                'label' => '<i class="zoom in black circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'view fancybox sin_sub') ,
                                                'imageUrl'=>false,
                                            ),
                            
                            'update' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/Update")',
                                                'label' => '<i class="edit black circular icon link comentario-hover" data-content="Modificar Addendum" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
                                                'imageUrl'=>false,								
                                                        ),
                            'borrar' => array(
//			                        'visible'=>'Yii::app()->user->checkAccess("rol/AuthItem/Delete")',
						'label' =>'<i class="trash red circular icon link comentario-hover" data-content="Eliminar Addendum" data-variation="inverted" style="display:inline"></i>',
			                        'url'=>"CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_addendum))",
                                                'imageUrl'=>false,
                                                'options'=>array('title'=>'','class'=>'sin_sub3 sin_sub','id'=>"borrar") ,
                                                                            'click'=>"function() {
                                                                                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
                                                                                                $.fn.yiiGridView.update('addendum-grid', {
                                                                                                        type:'POST',
                                                                                                        url:$(this).attr('href'),
                                                                                                        success:function(texto) {
                                                                                                                        if(texto=='eliminado'){ $.fn.yiiGridView.update('addendum-grid');alert('El Addendum ha sido eliminado exitosamente.');}
                                                                                                                        
                                                                                                                        else alert('Error al eliminar el registro.');
										                                        		
										                                                
										                                                
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