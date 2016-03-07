<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-item-form',
	'enableAjaxValidation'=>true,
)); ?>


	<p class="note">Los Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>



	<div>Usuarios</div>
	<br/>
 	<div>
	<?php
	
    $criteria = new CDbCriteria;
    //$modelauthitemchild = new AuthItemChild;
    $criteria->order = 'nb_usuario ASC';
    

	echo $form->dropDownList($model, 'nb_usuario',
								CHtml::listData(UsuUsuario::model()->findAll($criteria),'usuario_id', 'nb_usuario'),
								//array('class'=>'clasecss','width'=>'100%','size'=>'5'),
								array(
									'size'=>'5',
		                            //'empty'=>'--Seleccione Usuario--',
		                            'ajax' => array(
				                             'type'=>'POST', //request type
				                             'url'=>CController::createUrl('//rol/AuthItemChild/cargarRoles'),//url to call.
											 //'data'=>'id:5',
				                             //'replace'=>'#'.CHtml::activeId($geoDireccion,'municipio_id'),//selector to update
		                            		 'success'=>'function(data){alert(data)}',
											)	
								)
							);

	?>
	</div>
 
 
	<div>
	<?php 
	
	$this->widget('application.extensions.optiontransferselect.Optiontransferselect',array(
	     'leftTitle'=>'Roles Asignados <br/>',
	     'rightTitle'=>'Roles Existentes <br/>',
	     'name'=>'Model[ids][]',
	     'list'=>array('1'=>'2'),
	     'doubleList'=>array('1'=>'2'),
	     'doubleName'=>'Model[ids2][]'
	     )
	     );
	
	

	
	
	?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->