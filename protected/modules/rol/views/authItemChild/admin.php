
<?php
$this->breadcrumbs=array(
	'Auth Item Children'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Create AuthItemChild', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('auth-item-child-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administracion de Elementos de Autorizacion</h1>



<?php 
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auth-item-child-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'parent',
		'child',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
*/
?>

<div>
<?php 

$this->widget('application.extensions.optiontransferselect.Optiontransferselect',array(
     'leftTitle'=>'Roles Asignados <br/>',
     'rightTitle'=>'Roles Existentes <br/>',
     'name'=>'Model[ids][]',
     'list'=>array('1'=>'2'),
     'doubleList'=>array('1'=>'2'),
     'doubleName'=>'Model[ids2][]'));
     

?>
</div>
