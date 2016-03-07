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
<?php   echo SemanticForm::beginUiAdmin(
        'Administrar Perfiles',
        $menu=array(
                     array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
                     array('name'=>'Registrar Tarea','url'=>array('/rol/AuthItem/CreateTarea'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create','publico'=>'true' ),
                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ,'publico'=>'true'),
                     array('name'=>'Importar Permiso','url'=>array('/rol/AuthItem/ImportarPermiso'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
        			array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
					)
        
        );
?>

<div class="ui form">
<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'mdenuncias-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	//'htmlOptions' => array('OnSubmit'=>'$("#'.Chtml::activeId($model, 'checkSeleccionados').'").attr("value",$("#tdenuncias-grid").selGridView("getAllSelection"));'),
	//'htmlOptions'=>array('class'=>'blockuis'),
)); 
echo $form->beginUiForm('Cargando...');

?>

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'auth-item-grid',
			        'itemsCssClass'=>'ui table segment',
					'pagerCssClass'=>'pagination pagination-centered',
			        'pager'=> array(
			            'header' => '',  
			            'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css', 
			        ),  
			        'afterAjaxUpdate'=>"function(id,data){ $('a.fancybox').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayColor':'#FFFFFF','titlePosition':'outside'}); $('.comentario-hover').popup({  on: 'hover'});}",
				'dataProvider'=>$model->search(),
				'filter'=>$model,
// 				'selectableRows' => 100,
				'columns'=>array(
// 						array(
// 								'id'=>'denuncia_id',
// 								'class'=>'CCheckBoxColumn',
// 								'value' => '$data->name' ,
// 								'visible'=>(($model->type !=0 || $model->type =='')?TRUE:FALSE)
// 						),
			        			'name',
								array(
									'header'=>'Tipo',
									'name'=>'type',
									'value'=> '$data->tipoItem($data->type)',
									'filter'=>CHtml::activeDropDownList($model,'type',
										array('2'=>'Rol','1' => 'Tarea', '0' => 'Operacion'),
										array('class'=>'ui selection dropdown','prompt'=>'SELECCIONE',
										)
									),),
								'description',
					array(
						'class'=>'CButtonColumn',
			                        'header'=>"Acción",
			                        'template' => '{view}{viewOperacion}{viewTarea}{update}{updateTarea}{updateOperacion}{borrar}',
			                        'buttons'=>array(
													'view' => array(
			                                                    'visible'=>'(($data->type ==2)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/authItem/view")',
			                                                	'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
			                                                    'options'=>array('title'=>'','class'=>'fancybox sin_sub') ,
			                                                    'imageUrl'=>false,
			                                            	),
			                                         'viewTarea' => array(
			                                            		'visible'=>'(($data->type ==1)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/ViewTarea")',
			                                                	'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
			                                                    'url'=>"CHtml::normalizeUrl(array('AuthItem/viewTarea', 'id'=>\$data->name))",
			                                                	'options'=>array('title'=>'','class'=>'fancybox sin_sub') ,
			                                                    'imageUrl'=>false,
			                                            	),
			                                        'viewOperacion' => array(
			                                                    'visible'=>'(($data->type ==0)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/ViewOperacion")',
			                                                    'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
			                                                    'url'=>"CHtml::normalizeUrl(array('AuthItem/viewOperacion', 'id'=>\$data->name))",
			                                                	'options'=>array('title'=>'','class'=>'fancybox sin_sub') ,
			                                                    'imageUrl'=>false,
			                                            	),
			                                        'update' => array(
			                                                'visible'=>'(($data->type ==2)?TRUE:FALSE)',
			                                                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
			                                                'options'=>array('title'=>'','class'=>'sin_sub') ,
			                                                'imageUrl'=>false,								
			                                        		),
			                                         'updateTarea' => array(
			                                                'visible'=>'(($data->type ==1)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/UpdateTarea")',
			                                                'url'=>"CHtml::normalizeUrl(array('AuthItem/updateTarea', 'id'=>\$data->name))",
			                                                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
			                                                'options'=>array('title'=>'','class'=>'sin_sub') ,
			                                                'imageUrl'=>false,								
			                                        		),
			                                         'updateOperacion' => array(
			                                                'visible'=>'(($data->type ==0)?TRUE:FALSE)&&Yii::app()->user->checkAccess("rol/AuthItem/UpdateOperacion")',
			                                                'url'=>"CHtml::normalizeUrl(array('AuthItem/updateOperacion', 'id'=>\$data->name))",
			                                                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
			                                                'options'=>array('title'=>'','class'=>'sin_sub') ,
			                                                'imageUrl'=>false,								
			                                        		),
			                        		
			                                       'borrar' => array(
			                                        			'visible'=>'Yii::app()->user->checkAccess("rol/authItem/delete")',
												                'label' => '<i class="trash circular icon link comentario-hover" data-content="Eliminar" data-variation="inverted" style="display:inline"></i>',
			                                        			'url'=>"CHtml::normalizeUrl(array('AuthItem/delete', 'id'=>\$data->name))",
																'imageUrl'=>false,
																'options'=>array('title'=>'','class'=>'sin_sub2 sin_sub','id'=>"borrar") ,
															    'click'=>"function() {
										                                if(!confirm('¿Seguro que desea eliminar este  registro?')) return false;
										                                $.fn.yiiGridView.update('auth-item-grid', {
										                                        type:'POST',
										                                        url:$(this).attr('href'),
										                                        success:function(texto) {
										                                        		if(texto=='eliminado')alert('El registro ha sido eliminado exitosamente.');
										                                  
										                                        		else alert('Error al eliminar el registro.');
										                                        		
										                                                $.fn.yiiGridView.update('auth-item-grid');
										                                                
										                                        }
										                                });
										                                return false;
										                        }",
			                                                ),
			                                        ),
									),
				),
			)
			); ?>

	</div><br><br>
	<?php echo $form->endUiForm()	?>
	<?php $this->endWidget(); ?>
	<?php   echo SemanticForm::endUiAdmin()?>