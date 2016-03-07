<?php   echo SemanticForm::beginUiAdmin(
        'Visualización de Contrato',
        $menu=array(
                     	//array('name'=>'Listar Menus','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                        array('name'=>'Listar Contratos','url'=>array('/principal/Contrato/Admin','id'=>$model->id_punto_cuenta),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
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
  Contrato N° <?php echo $model->co_contrato;?>
</h2>
<table class="ui black table">
  <thead>
    <tr>
        <th style="text-align: center;">N° CONTRATO</th>
        <th style="text-align: center;">TIPO DE CONTRATO</th>
        <th style="text-align: center;">INSTITUCIÓN</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->co_contrato?></td>
      <td style="text-align: center;"><?php if(isset($model->idTpContrato->nb_tp_contrato))echo $model->idTpContrato->nb_tp_contrato;?></td>
      <td style="text-align: center;"><?php if(isset($model->idInstitucion->nb_tp_contrato))echo $model->idInstitucion->nb_institucion;?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
      <tr style="text-align: center;">
        <th>OBJETO</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: justify;"><?php echo $model->objeto;?></td>    
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
      <tr style="text-align: center;">
        <th>NOMBRE DE LA OBRA</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: justify;"><?php echo $model->nb_obra;?></td>    
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">ESTADO</th>
        <th style="text-align: center;">MUNICIPIO</th>
        <th style="text-align: center;">PARROQUIA</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php if(isset($model->idEstado->nombre)) echo $model->idEstado->nombre;?></td>
      <td style="text-align: center;"><?php if(isset($model->idMunicipio->nombre))echo $model->idMunicipio->nombre;?></td>
      <td style="text-align: center;"><?php if(isset($model->idParroquia->nombre))echo $model->idParroquia->nombre;?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">MONTO TOTAL</th>
        <th style="text-align: center;">AVANCE FINANCIERO</th>
        <th style="text-align: center;">AVANCE FÍSICO</th>       
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->monto_total;?></td>
      <td style="text-align: center;"><?php echo $model->avance_financiero;?></td>
      <td style="text-align: center;"><?php echo $model->avance_fisico;?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">FECHA DE SUSCRIPCIÓN</th>
        <th style="text-align: center;">FECHA DE CULMINACIÓN</th>
        <th style="text-align: center;">ESTATUS</th>       
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo implode("-",array_reverse(explode("-",$model->fecha_suscripcion)));?></td>
      <td style="text-align: center;"><?php echo implode("-",array_reverse(explode("-",$model->fecha_culminacion)));?></td>
      <td style="text-align: center;"><?php if(isset($model->idEstatus->nb_estatus_contrato))echo $model->idEstatus->nb_estatus_contrato;?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">NOMBRE DEL CONSTRUCTOR</th>
        <th style="text-align: center;">TELÉFONO DEL CONSTRUCTOR</th>
        <th style="text-align: center;">CORREO DEL CONSTRUCTOR</th>       
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->nb_constructor;?></td>
      <td style="text-align: center;"><?php echo $model->telf_constructor;?></td>
      <td style="text-align: center;"><?php echo $model->correo_constructor;?></td>
    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
    <tr>
        <th style="text-align: center;">NOMBRE DEL INSPECTOR</th>
        <th style="text-align: center;">TELÉFONO DEL INSPECTOR</th>
        <th style="text-align: center;">CORREO DEL INSPECTOR</th>       
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->nb_inspector;?></td>
      <td style="text-align: center;"><?php echo $model->telf_inspector;?></td>
      <td style="text-align: center;"><?php echo $model->correo_inspector;?></td>
    </tr>
  </tbody>
</table>
<?php
   echo SemanticForm::endUiAdmin(); 
?>