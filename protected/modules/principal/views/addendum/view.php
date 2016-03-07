<?php
/* @var $this AddendumController */
/* @var $model Addendum */
?>
<?php   echo SemanticForm::beginUiAdmin(
        'Visualización de Contrato',
        $menu=array(
                     	//array('name'=>'Listar Menus','url'=>array('/administracion/MMenus/Admin'),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
                       array('name'=>'Listar Addenda','url'=>array('/principal/Addendum/Admin','id'=>$model->id_contrato),'htmlOptions'=>array('class'=>'item'),'accion'=>'admin'),
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
  Addendum N° <?php echo $model->nu_addendum;?>
</h2>
<table class="ui black table">
  <thead>
    <tr>
        <th style="text-align: center;">FECHA DEL ADDENDUM</th>
        <th style="text-align: center;">MONTO DEL ADDENDUM</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;"><?php echo $model->fecha_addendum?></td>
      <td style="text-align: center;"><?php echo $model->monto_addendum;?></td>

    </tr>
  </tbody>
</table>
<table class="ui table">
  <thead>
      <tr style="text-align: center;">
        <th style="text-align: center;">ESTATUS DEL ADDENDUM</th>
        <th style="text-align: center;">PUNTO DE CUENTA</th>
    </tr>
  </thead>
  <tbody>
    <tr>
       <td style="text-align: center;"><?php echo $model->idEstatusAddendum->nb_estatus_addendum?></td>
      <td style="text-align: center;"><?php echo $model->idPuntoCuenta->co_punto_cuenta;?></td>  
    </tr>
  </tbody>
</table>
<?php
   echo SemanticForm::endUiAdmin(); 
?>