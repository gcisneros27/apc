<h1 style="text-align:center">Recuperación de usuario exitosa</h1>
<div class="borderfomulario" style="border:#AD1818 2px solid; width:450px; margin: 0px auto; margin-bottom: 1.5em; padding-bottom: 7px; background: #F5F5F5;padding:10px 5px 5px 5px;text-align:center;">
<p>Estimado(a)	<b><?php echo $user->persona->tx_nombre1; ?> <?php echo $user->persona->tx_apellido1; ?></b>. </p>
<p>Tu nombre de usuario es <b><?php echo $user->tx_usuario; ?></b></p> 
<p>Puedes ingresar haciendo click <?php echo CHtml::link('Aquí',array('/usuario/usuario/login')); ?>.</p> 
</div>