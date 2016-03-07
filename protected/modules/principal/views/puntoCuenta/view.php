<?php   echo SemanticForm::beginUiAdmin(
        'Visualización de Punto de Cuenta',
        $menu=array(
                     	//array('name'=>'Listar Menus','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                        array('name'=>'Listar Puntos Cuenta','url'=>array('/principal/PuntoCuenta/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
//                     array('name'=>'Registrar Operaci&oacute;n','url'=>array('/rol/AuthItem/CreateOperacion'),'htmlOptions'=>array('class'=>'item') ,'accion'=>'create'),
//                     array('name'=>'Registrar Tmenu','url'=>array('/rol/AuthItem/CreateTmenu'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Registrar Rol','url'=>array('/rol/AuthItem/Create'),'htmlOptions'=>array('class'=>'item'),'accion'=>'create' ),
//                     array('name'=>'Visualizar Modulos','url'=>array('/rol/AuthItem/AdministrarModulos'),'htmlOptions'=>array('class'=>'item'),'accion'=>'view' ),
					),
        'red'
        
        );

?>

<h2 class="ui center aligned icon header">
  <i class="circular file text icon"></i>
  Punto de Cuenta N° <?php echo $model->co_punto_cuenta;?>
</h2>
<table class="ui black table">
  <thead>
    <tr>
        <th style="text-align: center;">N° PUNTO DE CUENTA</th>
        <th style="text-align: center;">PUNTO DE CUENTA PRESIDENCIAL</th>
        <th style="text-align: center;">N° PUNTO DE CUENTA PRESIDENCIAL</th>
        <th style="text-align: center;">FECHA DE APROBACIÓN</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->co_punto_cuenta?></td>
      <td style="text-align: center;"><?php if($model->presidencial)echo 'SI';else echo 'NO';?></td>
      <td style="text-align: center;"><?php if(isset($model->idPuntoPadre->co_punto_cuenta))echo $model->idPuntoPadre->co_punto_cuenta;?></td>
      <td style="text-align: center;"><?php echo implode("-",array_reverse(explode("-",$model->fecha_aprobacion)));?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
      <tr style="text-align: center;">
        <th>ASUNTO</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: justify;"><?php echo $model->asunto;?></td>    
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
      <tr style="text-align: center;">
        <th>DESCRIPCIÓN</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: justify;"><?php echo $model->descripcion;?></td>    
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">MONTO (BS)</th>
        <th style="text-align: center;">MONTO DISPONIBLE (BS)</th>
        <th style="text-align: center;">MONTO (DIVISAS)</th>
        <th style="text-align: center;">MONTO DISPONIBLE (DIVISAS)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->monto_bs?></td>
      <td style="text-align: center;"><?php echo $model->monto_disp_bs?></td>
      <td style="text-align: center;"><?php echo $model->monto_dv?></td>
      <td style="text-align: center;"><?php echo $model->monto_disp_dv?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">MONEDA</th>
        <th style="text-align: center;">TIPO DE RECURSO</th>
        <th style="text-align: center;">PRESENTADO POR</th>
        <th style="text-align: center;">APROBADO POR</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->idTpMoneda->nb_moneda;?></td>
      <td style="text-align: center;"><?php echo $model->idTpRecurso->nb_tp_recurso;?></td>
      <td style="text-align: center;"><?php echo $model->presentado;?></td>
      <td style="text-align: center;"><?php echo $model->idFuncionario->nb_funcionario;?></td>
    </tr>
  </tbody>
</table>
<?php
   echo SemanticForm::endUiAdmin(); 
?>