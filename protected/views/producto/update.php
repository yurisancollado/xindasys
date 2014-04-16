<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	$model->detalle=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Ver Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Modificar: <?php echo $model->detalle; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
}?>