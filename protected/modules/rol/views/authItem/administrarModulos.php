<div class="ui one column grid">
  <div class="column">
    <div class="ui piled teal segment">
      <h2 class="ui header center aligned color_titulo">
        <i class="icon inverted circular teal setting"></i> Administrador de Modulos
      </h2>
		<div class="ui section divider"></div>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'administrar-modulos-form',
	'enableAjaxValidation'=>false,
));
?>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php 

Yii::app()->clientScript->registerScript('suno','	
	
	function buscarData(){
		var modulo=$("#AuthItem_modulos2 option:selected").text();

		var modulo_value=$("#AuthItem_modulos2 option:selected").attr("value");
		
		
		
		if(modulo_value==""){
			$("#bVerReglas").css("display","none");
			$(\'#acciones\').html("");
			return;
		}
		
		$("#bVerReglas").css("display","block");
		c="'.CController::createUrl('/rol/authItem/BuscarAcciones').'"
		$.ajax({
			url: c,
			cache: false,
			type: "POST",
			data: ({modulo : modulo}),
			beforeSend: function() {$(\'#acciones\').html(\'Cargando...\')}, 
			success: function(data) {
				if(data==\'\')data="No se encontraron nuevas acciones del modulo "+modulo;
				$(\'#acciones\').html(data);
			}
		});		
	}
',CClientScript::POS_HEAD);

?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="background:#F3F3F3;">
		<div class="span12" style="padding-left:60px">

			<div class="row">
			<?php echo $form->labelEx($model,'modulos2'); ?>
			<?php 
			
			$mod=Yii::app()->metadata->getModules();
			$mod2=array();
			foreach ($mod as $i => $value) {
				if ($mod[$i]=='.svn')
		    		unset($mod[$i]);
		    	else {
		    		$mod2[$value]=$value;
		    	}
			}
			
			echo $form->dropDownList($model,'modulos2',			
					$mod2,
					array('empty'=>'--SELECCIONE--','onChange'=>'buscarData();')); ?>
			<?php echo $form->error($model,'modulos2'); ?>
			</div>

	
	
			<div id="bVerReglas" style="display: none">
				<?php 	echo CHtml::button('Ver Reglas', array('class'=>'btn btn-danger','submit' => array('/rol/authItem/VerReglas')));	?>	
			</div>
			<div class="row buttons" style="text-align:center;">
				<?php //echo CHtml::submitButton('Mostrar rules',array('submit' => CController::createUrl('viewPermisos'),"id"=>"module")); ?>
			</div>			
		
			<div id="acciones" style="min-height:100px">
				
			</div>

		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
  </div>
</div>