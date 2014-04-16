<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	$model->numero,
);

$this->menu=array(
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),
	array('label'=>'Crear Pedido', 'url'=>array('create')),
	array('label'=>'<hr>'),
	array('label'=>'Modificar Pedido', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Pedido', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<h1>Pedido: <?php echo $model->numero; ?></h1>

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
		
	),
)); ?>
