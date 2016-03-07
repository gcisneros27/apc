<div class="ui one column wide grid"  style="width: auto">
  <div class="column"  style="margin-left: 10px">
    <div class="ui piled blue segment">
      <h2 class="ui header">
        <i class="icon inverted circular blue search"></i> Datos de la Tarea
      </h2>
	<div class="ui divider"></div>  

		<table class="ui basic table">
			<tr>
				<td>
					<b>Nombre</b>
				</td>
				<td>
					<?php echo $model->name; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Descripci&oacute;n</b>
				</td>
				<td>
					<?php echo $model->description; ?>
				</td>
			</tr>
			<?php if(count($tareasChild)>0):?>
			<tr>
				<td>
					<b>Tareas Asociados</b>
				</td>
				<td>
					<ul>
						<?php foreach($tareasChild as $operacion) {
							echo "<li>".$operacion['child']."</li>";
						}?>
					</ul>
				</td>
			</tr>
			<?php endif;?>
			<?php if(count($operacionesChild)>0):?>
			<tr>
				<td>
					<b>Operaciones Asociados</b>
				</td>
				<td>
					<ul>
						<?php foreach($operacionesChild as $operacion) {
							echo "<li>".$operacion['child']."</li>";
						}?>
					</ul>
				</td>
			</tr>
			<?php endif;?>
		</table>
	</div>
  </div>
</div>



<style>
#fancybox-content {background: none repeat scroll 0 0 #e5e5e5;}
</style>

