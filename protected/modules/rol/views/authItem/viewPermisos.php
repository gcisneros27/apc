<div class="ui one column grid">
  <div class="column">
    <div class="ui piled teal segment">
      <h2 class="ui header center aligned color_titulo">
        <i class="icon inverted circular teal setting"></i> Rules de Módulo "<?php echo $modulo; ?>"
      </h2>
		<div class="ui section divider"></div>




		<div class="span12" style="padding-left:60px">
			<div id="reglas" style="padding-top:50px;padding-bottom:50px">
			<?php 
			
					$controlador="";
					foreach ($rules as $rule){
						if ($controlador!=$rule['controlador']){
							echo "<br/><br/><br/>Controlador: ".$rule['controlador']."<br/><br/>";
							$controlador=$rule['controlador'];
						}
						$accion = explode("/",$rule['name']);
						echo "array('allow','actions' => array('".$accion[2]."'),	'roles' => array('".$rule['name']."')),<br/>";
					}
			?>
			</div>
			<input type="hidden" id="moduloo" />
		</div>
</div>
  </div>
</div>