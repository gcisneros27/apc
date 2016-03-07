<?php   echo SemanticForm::beginUiAdmin(
        'Administracion de Roles',
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
		'itemsCssClass'=>'ui table segment',
		'pagerCssClass'=>'pagination pagination-centered',
 		'afterAjaxUpdate'=>"function(id,data){ $('a.fancybox').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayColor':'#FFFFFF','titlePosition':'outside'}); $('.comentario-hover').popup({  on: 'hover'});}",
                    'pager'=> array(
                        'header' => '',  
                        'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css', 
                    ),
 		'id'=>'auth-item-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'name',
			array(
			'header'=>'Tipo',
			'name'=>'type',
			'value'=> '$data->tipoItem($data->type)',
			'filter' =>array('2'=>'Rol','1' => 'Tarea', '0' => 'Operacion') 
			),
			//'type',
			'description',
			//'bizrule',
			//'data',
							array(
							'header'=>"Acción",
							'class'=>'CButtonColumn',
							'template' => '{view}{update}{borrar}',
							'buttons'=>array(	
									'view' => array(
										'visible'=>'Yii::app()->user->checkAccess("rol/authItem/view")',
						                'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
										'options'=>array('title'=>'','class'=>'fancybox sin_sub') ,
										'imageUrl'=>false,
									),			
									'update' => array(
										'visible'=>'Yii::app()->user->checkAccess("rol/authItem/update")',
						                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
										'options'=>array('title'=>'','class'=>'sin_sub') ,
										'imageUrl'=>false,								
									),
									'borrar' => array(
						                'label' => '<i class="trash circular icon link comentario-hover" data-content="Eliminar" data-variation="inverted" style="display:inline"></i>',
				                        'url' =>'Yii::app()->controller->createUrl("authItem/delete",array("id"=>$data->name,))',
										'imageUrl'=>false,
										'options'=>array('title'=>'','class'=>'sin_sub2 sin_sub','id'=>"borrar") ,
									    'click'=>"function() {
				                                if(!confirm('¿Seguro que desea eliminar registro?')) return false;
				                                $.fn.yiiGridView.update('auth-item-grid', {
				                                        type:'POST',
				                                        url:$(this).attr('href'),
				                                        success:function(texto) {
				                                        		if(texto=='eliminado')alert('Elemento de autorizacion ha sido eliminado exitosamente.');
				                                        		else if(texto=='asignado')alert('Error, elemento de autorizacion está asignado actualmente a uno o mas usuarios.');
				                                        		else if(texto=='relacionado')alert('Error, elemento de autorizacion está relacionado actualmente con uno o mas elementos de autorizacion.');
				                                        		else if(texto=='no existe')alert('Error, elemento de autorizacion no existe.');
				                                        		else alert('Error al eliminar elemento de autorizacion.');
				                                        		
				                                                $.fn.yiiGridView.update('auth-item-grid');
				                                                
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

<?php 
$this->widget('application.extensions.fancybox.EFancyBox', array(
                'target'=>'a.fancybox',
                'mouseEnabled'=>false,
                'config'=>array(
                        'scrolling'=> 'auto',
						'transitionIn'=>'elastic',
						'transitionOut'=>'elastic',
						'speedIn'=>	600, 
						'speedOut'=>200, 
						'overlayColor'=>'#022033',
						'titlePosition'=>'outside',
						'centerOnScroll'=>true,
						'overlayColor'=>'#FFFFFF',
					),
                )
        );
?>