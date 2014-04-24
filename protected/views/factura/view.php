<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	$model->numero,
);

$menuAbono=	($model->estado==0) ? true : false ;
$this->bolmenu2=true;
$cliente=Cliente::model()->findByPk($_GET['id']);
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;

$this->menu=array(
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
	array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
);	

$this->menu2=array(
array('label'=>'<hr>'),
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$cliente->id)),	
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','id'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'Modificar Factura', 'url'=>array('update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Abonos', 'url'=>array('abono/listabonos', 'id'=>$cliente->id)),
	array('label'=>'Crear Abono', 'url'=>array('abono/create', 'id'=>$cliente->id,'visible' => $menuAbono )),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','id'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
);
?>

<h1>Factura: <?php echo $model->numero; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'numero',
		array(
       'name'=>'fecha',
       'value'=>Yii::app()->dateFormatter->format('dd-MM-yyyy',$model->fecha) ,  
     ),
		'clientes.NombreCompleto',
		'usuarios.NombreCompleto',
		'monto',
		'MontoCancelado',			
		'Estado',
	),
)); }
?>
