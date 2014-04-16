<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Crear Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model));} ?>