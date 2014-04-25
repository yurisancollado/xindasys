<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	$model->numero=>array('admin','id'=>$model->id),
	'Modificar',
);
$cliente=Cliente::model()->findByPk($model->clientes_id);
if($cliente==NULL)
$cliente=Cliente::model()->findByPk($_GET['cliente']);
$this->bolmenu2=true;
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;
$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),		
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$model->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$model->id)),
);
?>

<h1>Modificar Pedido <?php echo $model->numero; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>