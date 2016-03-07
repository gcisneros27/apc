<?php   echo SemanticForm::beginUiAdmin(
        'Administrador de Usuarios',
        $menu=array(
                     	array('name'=>'Registrar Usuario','url'=>array('/usuarios/User/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create'),

					),
        'red'
        
        );

?>
			<?php
		
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'usuario-grid',
				'dataProvider'=>$model->search(),
				//'cssFile'=>Yii::app()->request->baseUrl.'',
				'itemsCssClass'=>'ui table segment',
				'pagerCssClass'=>'pagination pagination-centered',
				'filter'=>$model,
 				'afterAjaxUpdate'=>"function(id,data){ $('a.fancybox').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayColor':'#FFFFFF','titlePosition':'outside'}); $('.comentario-hover').popup({  on: 'hover'});}",
		        'pager'=> array(
		            'header' => '',  
		            'cssFile' => Yii::app()->request->baseUrl.'/css/mypager.css',
		        ),
				'ajaxUrl'=>Yii::app()->createUrl("/usuario/user/admin"),	
				'columns'=>array(
					array(
						'header'=>'Usuario ',
						'name'=>'tx_usuario',
						'value'=>'$data->tx_usuario',
						'filter'=>CHtml::activeTextField($model,'tx_usuario',array('class'=>'')),		
					),				
					/*'persona.cedula'=>array(
							'name'=>'tx_cod_activacion',
							'value'=>'$data->persona->nu_cedula',
							'header'=>'Cédula',
							),
					'tx_usuario',*/
					/*'id_rol'=>array(
						'header' => 'rol',
						'name'=>'id_rol',
						'value'=> '$data->idRol->txt_rol',
						'filter' => CHtml::ActiveDropDownList($model,'id_rol',CHtml::listData(Rol::model()->findAll(), 'id_rol', 'txt_rol' ), array('empty'=>'--Seleccione--')),
			        ),*/
					array(
							'header'=>'Rol',
							'name'=>'rol',
							'value'=>'$data->rol($data->id_usuario)',
							
							'filter' => CHtml::ActiveDropDownList($model,'rol',CHtml::listData(AuthItem::model()->findAll(array('order'=>"name",'condition'=>"type=2 AND name!='guest' and name!='authenticated'")),'name','name'), array('empty'=>'--Seleccione--','class'=>'ui input selection dropdown')),
					//'filter' =>false
					),			
					/*array(
						'name'=>'rol_id',
						'filter' => CHtml::activeDropDownList($model,'rol_id',CHtml::listData(Rol::model()->findAll(), 'id_rol', 'tx_rol'), array('empty'=>'--Seleccione--')),
						'value'=> '$data->rol->tx_rol',
					),*/
					'activado'=>array(
						'header' => 'Estatus',
						'name'=>'bo_activado',
						'value'=> '(($data->bo_activado)?\'Activo\':\'No activo\')',
						'filter' => CHtml::dropDownList('Usuario[bo_activado]',(($model->bo_activado)?'1':(($model->bo_activado==="0")?'0':'')),array('1'=>'Activo','0'=>'No activo',), array('empty'=>'--Seleccione--','class'=>'ui input selection dropdown')),
			        ),
					array(
						'header'=>"Acción",
						'class'=>'CButtonColumn',
						'template' => '{view}{update}',
						'buttons'=>array(	
								'view' => array(
									'visible'=>'Yii::app()->user->checkAccess("usuarios/User/View")',
					                'label' => '<i class="zoom in circular icon link comentario-hover" data-content="Ver" data-variation="inverted" style="display:inline"></i>',
									'options'=>array('title'=>'','class'=>'fancybox sin_sub') ,
									'imageUrl'=>false,
								),			
								'update' => array(
									'visible'=>'Yii::app()->user->checkAccess("usuarios/User/Update")',
					                'label' => '<i class="edit circular icon link comentario-hover" data-content="Modificar" data-variation="inverted" style="display:inline"></i>',
									'options'=>array('title'=>'','class'=>'sin_sub') ,
									'imageUrl'=>false,								
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