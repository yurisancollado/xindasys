<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	'Administrar',
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
	array('label'=>'Crear Abono', 'url'=>array('abono/create', 'id'=>$factura->id,'visible' => $menuAbono )),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#abono-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Abonos de Factura:<?php echo $factura->numero?> </h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'abono-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(			
		 array(		             
        'name'=>'fecha',
        'value'=>'date("d-m-Y", strtotime($data->fecha))',
    ),	 
		'monto',
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
)); 
}?>
