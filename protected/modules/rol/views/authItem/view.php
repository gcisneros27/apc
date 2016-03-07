
<div class="ui one column wide grid"  style="width: 600px">
  <div class="column"  style="margin-left: 10px">
    <div class="ui piled blue segment">
      <h2 class="ui header">
        <i class="icon inverted circular blue search"></i> Datos del Rol
      </h2>
	<div class="ui divider"></div>  

		<table class="ui basic table">

			<tr>
				<td>
					<strong>Nombre</strong>
				</td>
				<td>
					<?php echo $model->name; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Tipo</strong>
				</td>
				<td>
					<?php echo $model->tipoItemR($model->type); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Descripción</strong>
				</td>
				<td>
					<?php echo $model->description; ?>
				</td>
			</tr>	
			
		</table>


	</div>
  </div>
</div>



<style>
#fancybox-content {background: none repeat scroll 0 0 #e5e5e5;}
</style>


