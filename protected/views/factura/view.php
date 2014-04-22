<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	$model->numero,
);

$menuAbono=	($model->estado==0) ? true : false ;

$this->menu=array(
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
	array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'<hr>'),
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$model->id)),
	array('label'=>'<hr>'),
	array('label'=>'Modificar Factura', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Abonos', 'url'=>array('abono/listabonos', 'id'=>$model->id)),
	array('label'=>'Crear Abono', 'url'=>array('abono/create', 'id'=>$model->id,'visible' => $menuAbono )),
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
