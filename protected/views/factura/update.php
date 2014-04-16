<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	$model->numero=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
	array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'<hr>'),
	array('label'=>'Ver Factura', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Modificar: <?php echo $model->numero; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model));
} ?>