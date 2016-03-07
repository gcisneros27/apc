
<div class="ui one column wide grid"  style="width: 600px">
  <div class="column"  style="margin-left: 10px">
    <div class="ui piled blue segment">
      <h2 class="ui header">
        <i class="icon inverted circular blue search"></i> Datos de Usuario
      </h2>
	<div class="ui divider"></div>  

		<table class="ui basic table">
		  <tbody>
		<tr>
				<td>
					<strong>Usuario</strong>
				</td>
				<td>
					<?php echo $model->tx_usuario; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Perfil</strong>
				</td>
				<td>
					<?php echo ($roll=AuthAssignment::model()->find("userid=:userid",array(":userid"=>(string)$model->id_usuario)))?$roll->itemname:"" ?>
				</td>
			</tr>
		
			<tr>
				<td>
					<strong>Cedula</strong>
				</td>
				<td>
					<?php echo $model->persona->cedula; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Nombres</strong>
				</td>
				<td>
					<?php echo $model->persona->nombre1." ".(($model->persona->nombre2)?$model->persona->nombre2:""); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Apellidos</strong>
				</td>
				<td>
					<?php echo $model->persona->apellido1." ".(($model->persona->apellido2)?$model->persona->apellido2:""); ?>
				</td>
			</tr>
		
			<tr>
				<td>
					<strong>Correo</strong>
				</td>
				<td>
					<?php echo $model->persona->correo; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Teléfono</strong>
				</td>
				<td>
					<?php echo $model->persona->telefono; ?>
				</td>
			</tr>
		  </tbody>
		</table>

	</div>
  </div>
</div>



<style>
#fancybox-content {background: none repeat scroll 0 0 #e5e5e5;}
</style>
