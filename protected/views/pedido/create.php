<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),
);
?>

<h1>Crear Pedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>