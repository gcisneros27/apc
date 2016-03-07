<?php
/* @var $this PuntoCuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Punto Cuentas',
);

$this->menu=array(
	array('label'=>'Create PuntoCuenta', 'url'=>array('create')),
	array('label'=>'Manage PuntoCuenta', 'url'=>array('admin')),
);
?>

<h1>Punto Cuentas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
