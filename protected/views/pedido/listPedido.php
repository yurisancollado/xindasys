<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Administrar',
);
$cliente=Cliente::model()->findByPk($_GET['id']);
$this->menu=array(
	array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Crear Pedido', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pedido-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$cliente=Cliente::model()->findByPk($_GET['id']);
?>

<h1>Pedidos  <?php echo $cliente->nombreCompleto?></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pedido-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'numero',
		 array(		             
        'name'=>'fecha',
        'value'=>'date("d-m-Y", strtotime($data->fecha))',
    ),
		array(
		'name'=>'clientes_id',
		'header'=>'Cliente',
		'value'=>'$data->clientes->nombre." ".$data->clientes->apellido',
		'filter'=>Factura::getListCliente(),
		),
		array(
		'name'=>'usuarios_id',
		'header'=>'Vendedor',
		'value'=>'$data->usuarios->nombre." ".$data->usuarios->apellido',
		'filter'=>Factura::getListUsuario(),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
