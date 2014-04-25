<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Crear',
);
$cliente=Cliente::model()->findByPk($_GET['cliente']);
$this->bolmenu2=true;
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;

$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Pedido', 'url'=>array('pedido/admin')),	
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('cliente/update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$cliente->id)),
);
?>

<h1>Crear Pedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>