<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Administrar',
);
$this->bolmenu2=false;
$this->menu=array(
	array('label'=>'Crear Pedido', 'url'=>array('cliente/admin')),
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
?>

<h1>Administrar Pedidos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pedido-grid',
	'dataProvider'=>$model->search(),
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
