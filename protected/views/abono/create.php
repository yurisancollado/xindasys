<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	'Crear',
);
$this->bolmenu2=true;
$factura=Factura::model()->findByPk($_GET['id']);
$cliente=Cliente::model()->findByPk($factura->clientes_id);
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;
$menuAbono=	($factura->estado==0) ? true : false ;
$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),	
	array('label'=>'Administrar Factura', 'url'=>array('factura/admin')),
	array('label'=>'Administrar Abono', 'url'=>array('abono/admin')),	
);
$this->menu2=array(	
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('cliente/update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'Ver Factura', 'url'=>array('factura/view','id'=>$factura->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Abonos', 'url'=>array('abono/listabonos', 'id'=>$factura->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
	
);
?>

<h1>Crear Abono a Factura  <?php echo $factura->numero?></h1>

<?php $this->renderPartial('_form', array('model'=>$model));
} ?>