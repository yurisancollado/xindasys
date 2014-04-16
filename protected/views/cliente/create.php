<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('admin')),
);
?>

<h1>Crear Cliente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>