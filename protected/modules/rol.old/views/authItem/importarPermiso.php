<?php
/* @var $this RMenusAuthitemController */
/* @var $model RMenusAuthitem */
/* @var $form CActiveForm */
?>

<?php   echo SemanticForm::beginOnlyView(
        $titulo='Exportar Permiso',null,$opciones=array(
         'classTitulo'=>'icon inverted circular flagBlue browser',
        'menu' => array(
        			 array('name'=>'Listar Rol','url'=>array('/rol/authItem/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
                     array('name'=>'Registrar Tarea','url'=>array('/rol/AuthItem/CreateTarea'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create','publico'=>'true' ),
                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ,'publico'=>'true'),
                     array('name'=>'Importar Permiso','url'=>array('/rol/AuthItem/ImportarPermiso'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
        			 array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
        		)
        	)
        );

?>
<div class="ui form">
<?php $form=$this->beginWidget('SemanticForm', array(
	'id'=>'authitem-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'blockuis','enctype'=>'multipart/form-data'),
)); ?>
<div id="loescrito"></div>

 <?php echo $form->beginUiForm('Cargando...');	?>	
 

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

 	<?php echo $form->beginUiForm('Cargando...');	?>

    <div class="one field">
      <div style="display:inline;font-weight:bold;margin-right:10px;">Cargar Permisos des un Archivo</div>
		<?php echo $form->fileField($model,'txt'); ?>
		<?php echo $form->error($model,'txt'); ?>
    </div>

	<?php echo $form->saveResetButton()?>
<?php echo $form->endUiForm()	?>
<?php $this->endWidget(); ?>
<?php SemanticForm::endOnlyView(); ?>

</div><!-- form -->
