<?php
/* @var $this PedidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pedidos',
);

$this->menu=array(
	array('label'=>'Crear Pedido', 'url'=>array('create')),
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),
);
?>

<h1>Pedidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
