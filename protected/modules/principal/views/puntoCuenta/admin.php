<?php
/* @var $this PuntoCuentaController */
/* @var $model PuntoCuenta */
?>
<?php   echo SemanticForm::beginUiAdmin(
        'Listado de Puntos de Cuenta',
        $menu=array(
                     	//array('name'=>'Listar Menus','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                        array('name'=>'Registrar Punto de Cuenta','url'=>array('/principal/PuntoCuenta/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
//                     array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create'),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					),
        'red'
        
        );

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'punto-cuenta-grid',
        'itemsCssClass'=>'ui table segment',
	'pagerCssClass'=>'pagination pagination-centered',
	'dataProvider'=>$model->search(),
        'pager'=> array(
			'header' => '',
			'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
	),
	'filter'=>$model,
        'ajaxUrl'=>Yii::app()->createUrl("/principal/PuntoCuenta/admin"),
	'columns'=>array(
		
		
                array(
			'name'=>'id_punto_padre',
                        'type'=>'html',
			'value'=> '(!$data->presidencial)?$data->idPuntoPadre->co_punto_cuenta:$data->co_punto_cuenta',
                        'filter'=>
			CHtml::activeDropDownList($model,'id_punto_padre',CHtml::listData(PuntoCuenta::model()->findAll('presidencial=TRUE AND st_punto_cuenta=TRUE'),'id_punto_cuenta','co_punto_cuenta'),
				array('class'=>'ui dropdown','prompt'=>'--SELECCIONE--',)),
                               

                    ),
                array(
			'name'=>'co_punto_cuenta',
			'value'=> '$data->co_punto_cuenta',
			'filter'=>
			CHtml::activeDropDownList($model,'co_punto_cuenta',CHtml::listData(PuntoCuenta::model()->findAll('st_punto_cuenta=TRUE'),'co_punto_cuenta','co_punto_cuenta'),
				array('class'=>'ui dropdown','prompt'=>'--SELECCIONE--',)),
                        'type'=>'html',        

                    ),    
		array(
                        'header'=>'Fecha de Aprobación',
                        'name'=>'fe_aprobacion',
                        'value'=>'implode("-",array_reverse(explode("-",$data->fecha_aprobacion)))',
                        'class'=>'SYDateColumn',		
                    ),
		//'fecha_aprobacion',
		//'monto_bs',
                array(
                        
                        'name'=>'monto_bs',
                        'value'=>'$data->monto_bs',
                    ),
                 array(
                        
                        'name'=>'monto_dv',
                        'value'=>'$data->monto_dv',
                    ),
               //'monto_dv',
		/*'monto_disp_bs',
		
		
		'monto_disp_dv',
		'id_tp_moneda',
		'id_tp_recurso',
		'asunto',
		'descripcion',
		'presentado',
		'id_funcionario',
		'fecha_aprobacion',
		*/
		array(
			'class'=>'CButtonColumn',
                        'header'=>"Acción",
                        'template' => '{view}{pdf}{update}{contratos}{borrar}',
                        'buttons'=>array(
                            'view' => array(
			                        'visible'=>'Yii::app()->user->checkAccess("principal/PuntoCuenta/View")',
                                                'label' => '<i class="zoom in black circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'view fancybox sin_sub') ,
                                                'imageUrl'=>false,
                                            ),
                            'pdf' => array(
                                                'visible'=>'Yii::app()->user->checkAccess("principal/PuntoCuenta/ImprimirPdf")',
                                                'url' =>'Yii::app()->controller->createUrl("/principal/PuntoCuenta/imprimirPdf",array("id"=>$data->id_punto_cuenta))',
                                                'label' => '<i class="black file pdf outline circular icon link comentario-hover" data-content="Descargar Punto de Cuenta" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'sin_sub ifancybox') ,
                                                'imageUrl'=>false,
                                                ), 
                            'contratos' => array(
			                        'visible'=>'Yii::app()->user->checkAccess("principal/Contrato/Admin")',
                                                'label' => '<i class="legal brown circular icon link comentario-hover" data-content="Administrar Contratos" data-variation="inverted" style="display:inline"></i>',
                                                'url'=>"Yii::app()->createUrl('principal/contrato/admin',array('id'=>\$data->id_punto_cuenta))",
                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
                                                'imageUrl'=>false,								
                                                        ),
                            'update' => array(
//			                        'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/Update")',
                                                'label' => '<i class="edit black circular icon link comentario-hover" data-content="Modificar Punto de Cuenta" data-variation="inverted" style="display:inline"></i>',
                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
                                                'imageUrl'=>false,								
                                                        ),
                            'borrar' => array(
//			                        'visible'=>'Yii::app()->user->checkAccess("rol/AuthItem/Delete")',
						'label' =>'<i class="trash red circular icon link comentario-hover" data-content="Eliminar Punto de Cuenta" data-variation="inverted" style="display:inline"></i>',
			                        'url'=>"CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_punto_cuenta))",
                                                'imageUrl'=>false,
                                                'options'=>array('title'=>'','class'=>'sin_sub3 sin_sub','id'=>"borrar") ,
                                                                            'click'=>"function() {
                                                                                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
                                                                                                $.fn.yiiGridView.update('punto-cuenta-grid', {
                                                                                                        type:'POST',
                                                                                                        url:$(this).attr('href'),
                                                                                                        success:function(texto) {
                                                                                                                        if(texto=='eliminado'){ $.fn.yiiGridView.update('punto-cuenta-grid');alert('El Punto de Cuenta ha sido eliminado exitosamente.');}
                                                                                                                        
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