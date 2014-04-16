<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	$model->numero=>array('admin','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),
	array('label'=>'Crear Pedido', 'url'=>array('create')),
	array('label'=>'<hr>'),
	array('label'=>'Ver Pedido', 'url'=>array('view', 'id'=>$model->id)),
	
);
?>

<h1>Modificar Pedido <?php echo $model->numero; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>