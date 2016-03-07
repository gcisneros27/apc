<?php
/* @var $this MMenusController */
/* @var $model MMenus */
?>
<?php   echo SemanticForm::beginUiAdmin(
        'Listar Menus',
        $menu=array(
                     	array('name'=>'Listar Menus','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
        				array('name'=>'Registrar Menus','url'=>array('/administracion/MMenus/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),
//                     array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create'),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					)
        
        );

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mmenus-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'ui table segment',
	'pagerCssClass'=>'pagination pagination-centered',
	'filter'=>$model,
	'afterAjaxUpdate'=>"function(id,data){ $('a.fancybox').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayColor':'#FFFFFF','titlePosition':'outside'}); $('.comentario-hover').popup({  on: 'hover'});}",
	'pager'=> array(
			'header' => '',
			'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
	),
	'ajaxUrl'=>Yii::app()->createUrl("/administracion/Mmenus/admin"),		
	'columns'=>array(
			        			'nombre_menu',
								array(
									'name'=>'id_menu_padre',
									'value'=> '($data->id_menu_padre!="")?$data->idMenuPadre->nombre_menu:""',
								   	'filter'=>
										CHtml::activeDropDownList($model,'id_menu_padre',CHtml::listData(MMenus::model()->findAll(),'id_menu','nombre_menu'),
										array('class'=>'ui selection dropdown','prompt'=>'--SELECCIONE--',)),										

									),
						'orden',
					array(
						'class'=>'CButtonColumn',
			                        'header'=>"Acción",
			                        'template' => '{view}{update}
			                        				{subir}{bajar}
			                        				{administrar}{borrar}',
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
					                        				'visible'=>'$data->visibleSubir($data->id_menu_padre,$data->orden)',
					                        				'label' => '<i class="long arrow up icon link comentario-hover" data-content="Subir" data-variation="inverted" style="display:inline"></i>',
					                        				'url'=>"CHtml::normalizeUrl(array('subirOrden', 'id'=>\$data->id_menu))",
					                        				'imageUrl'=>false,
					                        				'options'=>array('title'=>'','class'=>'sin_sub2 sin_sub','id'=>"subir") ,
					                        				'click'=>"function() {
							                        					 if(!confirm('¿Seguro que desea Subir este registro?')) return false;
																		$.fn.yiiGridView.update('mmenus-grid', {
																								type:'POST',
														                                        url:$(this).attr('href'),
														                                        success:function(texto) {
														                                        		if(texto=='exitoso'){ $.fn.yiiGridView.update('mmenus-grid');alert('El registro fue modificado exitosamente.');}
							                                       										else alert('Error al Subir el elemento.');
														                                        }});
														                                return false;
														                        }",
					                        		),
			                        		
					                        		'bajar' => array(
									                        'visible'=>'$data->visibleBajar($data->id_menu_padre,$data->orden)',
					                        				'label' => '<i class="long arrow down icon link comentario-hover" data-content="Bajar" data-variation="inverted" style="display:inline"></i>',
					                        				'url'=>"CHtml::normalizeUrl(array('bajarOrden', 'id'=>\$data->id_menu))",
					                        				'imageUrl'=>false,
					                        				'options'=>array('title'=>'','class'=>'sin_sub1 sin_sub','id'=>"bajar") ,
					                        				'click'=>"function() {
					                        					 if(!confirm('¿Seguro que desea Bajar este registro?')) return false;
																$.fn.yiiGridView.update('mmenus-grid', {
																						type:'POST',
												                                        url:$(this).attr('href'),
												                                        success:function(texto) {
												                                        		if(texto=='exitoso'){ $.fn.yiiGridView.update('mmenus-grid');alert('El registro fue modificado exitosamente.');}
					                                       										else alert('Error al Bajar el elemento.');
												                                        }});
												                                return false;
												                        }",
					                        		),
			                                       'administrar' => array(
// 					                        				'visible'=>'Yii::app()->user->checkAccess("documento/MMenus/Admin")',
 					                        				'label' => '<i class="browser in circular icon link comentario-hover" data-content="Administrar SubItems" data-variation="inverted" style="display:inline"></i>',
 					                        				'url'=>"CHtml::normalizeUrl(array('RMenusAuthitem/admin', 'id'=>\$data->id_menu))",
 					                        				'options'=>array('title'=>'','class'=>'view sin_sub') ,
 					                        				'imageUrl'=>false,
 					                        		),
			                                       'borrar' => array(
//			                                        			'visible'=>'Yii::app()->user->checkAccess("rol/AuthItem/Delete")',
												                'label' => '<i class="trash circular icon link comentario-hover" data-content="Eliminar" data-variation="inverted" style="display:inline"></i>',
			                                        			'url'=>"CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_menu))",
																'imageUrl'=>false,
																'options'=>array('title'=>'','class'=>'sin_sub3 sin_sub','id'=>"borrar") ,
															    'click'=>"function() {
										                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
										                                $.fn.yiiGridView.update('mmenus-grid', {
										                                        type:'POST',
										                                        url:$(this).attr('href'),
										                                        success:function(texto) {
										                                        		if(texto=='eliminado'){ $.fn.yiiGridView.update('mmenus-grid');alert('El registro ha sido eliminado exitosamente.');}
										                                        		else if(texto=='tiene_hijos')alert('Error al eliminar. El menu posee elementos dependientes');
			                                       										else if(texto=='posee_funcionarios')alert('Error al eliminar. El menu posee funcionarios asociados.');
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
