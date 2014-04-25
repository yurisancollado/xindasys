<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	$model->numero=>array('view','id'=>$model->id),
	'Modificar',
);
$this->bolmenu2=true;
$cliente=Cliente::model()->findByPk($model->clientes_id);
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;


$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),	
	array('label'=>'Administrar Factura', 'url'=>array('factura/admin')),
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$cliente->id)),	
	array('label'=>'<hr>'),
	array('label'=>'Ver Factura', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
);
?>

<h1>Modificar: <?php echo $model->numero; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model));
} ?>