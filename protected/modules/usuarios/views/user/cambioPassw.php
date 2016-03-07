<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	//$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Modificar Contraseña',
);

/*$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
);*/
?>
<div  align="center"  style="margin:0 auto 0 auto; width:890px; padding-bottom:10px;">
<h1 >Cambiar Contraseña del Usuario <?php echo $model->txt_login; ?></h1>
</div>
<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>
