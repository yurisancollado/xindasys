<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	$model->nombre.' '.$model->apellido,
);
if($model->estado==1)
	$accionActivo=array('label'=>'Desactivar Cliente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('desactivar','id'=>$model->id),'confirm'=>'Esta seguro que desea desactivar el usuario?'));
else {
	$accionActivo=array('label'=>'Activar Cliente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('activar','id'=>$model->id),'confirm'=>'Esta seguro que desea activar el usuario?'));
}
$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('admin')),
	array('label'=>'Crear Cliente', 'url'=>array('create')),
	array('label'=>'<hr>'),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$model->id)),
	$accionActivo,	
	array('label'=>'<hr>'),
	array('label'=>'Listar Factura', 'url'=>array('factura/listafactura','id'=>$model->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$model->id)),
	
);
?>

<h1>Cliente: <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cedula',
		'nombre',
		'apellido',
		'telefono',
		'direccion',
		'rif',
		'Estado',		
		'TotalFactura',
		'MontoFacturado',
		'Deuda'
	),
)); ?>
