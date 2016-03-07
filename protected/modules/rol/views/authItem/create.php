
<div class="ui one column grid">
  <div class="column">
    <div class="ui piled teal segment">
      <h2 class="ui header center aligned color_titulo">
        <i class="icon inverted circular teal setting"></i> Crear Rol
      </h2>
		<div class="ui section divider"></div>
		<div class="container" >
		<?php
		    echo SemanticForm::mensajesFlash();
		?>
		</div>     
	 
<?php echo $this->renderPartial('_form', array('model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,		 	'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,'getPost'=>$getPost,
)); ?>

</div>
  </div>
</div>

