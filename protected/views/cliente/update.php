<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	$model->nombre.' '.$model->apellido=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Crear Cliente', 'url'=>array('create')),
	array('label'=>'Ver Cliente', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Cliente', 'url'=>array('admin')),
);
?>

<h1>Modificar: <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>