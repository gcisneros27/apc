<?php

echo SemanticForm::beginUiView(' Importar Permiso', $opciones=array('ancho'=>'100%',
																		 'menu'=>array(
// 													                     array('name'=>'Listar Denuncias','url'=>array('/denuncias/tDenuncias/admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin' ,'publico'=>'true'),
// 													                     array('name'=>'Visualizar Denuncia','url'=>array('/denuncias/tDenuncias/view'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ,'publico'=>'true'),
																		)));?>

<h1 style="text-align:center;"><b>Generador de Archivo</b></h1>

    	<h2>Mensajes del Sistema</h2>
			<div class="flash-success" id="mensajes"></div>
			
			<div class="ui teal progress" data-percent="74" id="example1">
			    <div class="bar">
			      <div class="progress"></div>
			    </div>
			    <div class="label">Uploading Files</div>
			</div>
			<br><br>
			<h2>Archivo Consulta de Beneficio</h2>
				<div id = "ocultar" class="flash-success" >
					<div id="persona">Generando</div>
					<div id="archivos"></div>
				</div>
<script type="text/javascript">
	alert("wwwww");
	$('#example1').progress({
		  percent: 22
	});
</script>
<?php echo SemanticForm::endUiView(); ?>
				