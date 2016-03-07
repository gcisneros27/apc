<?php
/* @var $this RMenusAuthitemController */
/* @var $model RMenusAuthitem */

?>
<?php   echo SemanticForm::beginUiAdmin(
        'Listado de Items del Menú',
        $menu=array(
                     array('name'=>'Listar Items del Menú','url'=>array('/administracion/RMenusAuthitem/Admin','id'=>$id),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ),
                     array('name'=>'Regresar Al listado de Menú','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'admin'),
        			 array('name'=>'Registrar Items del Menú','url'=>array('/administracion/RMenusAuthitem/Create','id'=>$id),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					)
        
        );

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rmenus-authitem-grid',
	'dataProvider'=>$model->search($id),
	'itemsCssClass'=>'ui table segment',
	'pagerCssClass'=>'pagination pagination-centered',
	'filter'=>$model,
	'afterAjaxUpdate'=>"function(id,data){ $('a.fancybox').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayColor':'#FFFFFF','titlePosition':'outside'}); $('.comentario-hover').popup({  on: 'hover'});}",
	'pager'=> array(
			'header' => '',
			'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
	),
	'ajaxUrl'=>Yii::app()->createUrl("/administracion/RMenusAuthitem/Admin",array("id"=>$id)),		
	'columns'=>array(
		'nombre_item',
		'operacion',
// 		'ruta_imagen',
// 		'orden',
//			        			'nombre_menu',
//								array(
//									'name'=>'id_menu_padre',
//									'value'=> '($data->id_menu_padre!="")?$data->idMenuPadre->nombre_menu:""',
//								   	'filter'=>
//										CHtml::activeDropDownList($model,'id_menu_padre',CHtml::listData(MMenus::model()->findAll(),'id_menu','nombre_menu'),
//										array('class'=>'ui selection dropdown','prompt'=>'--SELECCIONE--',)),										
//
//									),

					array(
						'class'=>'CButtonColumn',
			                        'header'=>"Acción",
			                        'template' => '{view}{update}{borrar}',
			                        'buttons'=>array(
													'view' => array(
//			                                                    'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/View")',
			                                                	'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
			                                                    'options'=>array('title'=>'','class'=>'view fancybox sin_sub') ,
			                                                    'imageUrl'=>false,
			                                            	),
			                                        'update' => array(
//			                                                'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/Update")',
			                                                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
			                                                'options'=>array('title'=>'','class'=>'update sin_sub') ,
			                                                'imageUrl'=>false,								
			                                        		),
			                                       'subir' => array(
					                        				'visible'=>'!(RMenusAuthitem::model()->find("id_menu=:id_menu ORDER BY orden ASC",array(":id_menu"=>$data->id_menu))->orden ==$data->orden)',
					                        				'label' => '<i class="long arrow up icon link comentario-hover" data-content="Subir" data-variation="inverted" style="display:inline"></i>',
					                        				'url'=>"CHtml::normalizeUrl(array('rMenusAuthitem/subirOrden', 'id'=>\$data->id_menu))",
					                        				'imageUrl'=>false,
					                        				'options'=>array('title'=>'','class'=>'sin_sub2 sin_sub','id'=>"subir") ,
					                        				'click'=>"function() {
							                        					 if(!confirm('¿Seguro que desea Subir este registro?')) return false;
																		$.fn.yiiGridView.update('rmenus-authitem-grid', {
																								type:'POST',
														                                        url:$(this).attr('href'),
														                                        success:function(texto) {
														                                        		if(texto=='exitoso'){ $.fn.yiiGridView.update('rmenus-authitem-grid');alert('El registro fue modificado exitosamente.');}
							                                       										else alert('Error al Subir el elemento.');
														                                        }});
														                                return false;
														                        }",
					                        		),
			                        		
					                        		'bajar' => array(
									                        'visible'=>'!(RMenusAuthitem::model()->find("id_menu=:id_menu ORDER BY orden DESC",array(":id_menu"=>$data->id_menu))->orden ==$data->orden)',
					                        				'label' => '<i class="long arrow down icon link comentario-hover" data-content="Bajar" data-variation="inverted" style="display:inline"></i>',
					                        				'url'=>"CHtml::normalizeUrl(array('rMenusAuthitem/bajarOrden', 'id'=>\$data->id_menu))",
					                        				'imageUrl'=>false,
					                        				'options'=>array('title'=>'','class'=>'sin_sub1 sin_sub','id'=>"bajar") ,
					                        				'click'=>"function() {
					                        					 if(!confirm('¿Seguro que desea Bajar este registro?')) return false;
																$.fn.yiiGridView.update('rmenus-authitem-grid', {
																						type:'POST',
												                                        url:$(this).attr('href'),
												                                        success:function(texto) {
												                                        		if(texto=='exitoso'){ $.fn.yiiGridView.update('rmenus-authitem-grid');alert('El registro fue modificado exitosamente.');}
					                                       										else alert('Error al Bajar el elemento.');
												                                        }});
												                                return false;
												                        }",
					                        		),
			                                       'borrar' => array(
//			                                        			'visible'=>'Yii::app()->user->checkAccess("rol/AuthItem/Delete")',
												                'label' => '<i class="trash circular icon link comentario-hover" data-content="Eliminar" data-variation="inverted" style="display:inline"></i>',
			                                        			'url'=>"CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_item_authitem))",
																'imageUrl'=>false,
																'options'=>array('title'=>'','class'=>'sin_sub3 sin_sub','id'=>"borrar") ,
															    'click'=>"function() {
										                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
										                                $.fn.yiiGridView.update('rmenus-authitem-grid', {
										                                        type:'POST',
										                                        url:$(this).attr('href'),
										                                        success:function(texto) {
										                                        		if(texto=='eliminado'){ $.fn.yiiGridView.update('rmenus-authitem-grid');alert('El registro ha sido eliminado exitosamente.');}
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
