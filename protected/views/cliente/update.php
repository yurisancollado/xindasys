<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	$model->nombre.' '.$model->apellido=>array('view','id'=>$model->id),
	'Modificar',
);
$this->menu=array(

	array('label'=>'Administrar Cliente', 'url'=>array('admin')),
	array('label'=>'Crear Cliente', 'url'=>array('create')),		
);
$this->bolmenu2=true;
$this->nombreCliente=$model->nombre.' '.$model->apellido;;
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$model->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$model->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$model->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$model->id)),
);
?>

<h1>Modificar: <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>