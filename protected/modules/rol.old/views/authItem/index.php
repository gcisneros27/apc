<?php
$this->breadcrumbs=array(
	'Lista de Item',
);

$this->menu=array(
	array('label'=>'Crear Item', 'url'=>array('create')),
	array('label'=>'Administrar Item', 'url'=>array('admin')),
);
?>

<h1>Lista de Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
