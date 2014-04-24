<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	'Crear',
);
$this->bolmenu2=true;
$cliente=Cliente::model()->findByPk($_GET['cliente']);
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;

$this->menu=array(
array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$cliente->id)),	
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','id'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
);
?>

<h1>Crear Factura a <?php echo $this->nombreCliente;?></h1>

<?php if(isset($_GET['cliente'])) $this->renderPartial('_form', array('model'=>$model));
	else $this->redirect(array('cliente/admin'));
}?>