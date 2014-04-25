
<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	'Agregar Producto',
);
$cliente=Cliente::model()->findByPk($_GET['cliente']);
$this->bolmenu2=true;
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;
$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Pedido', 'url'=>array('admin')),	
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
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
	$('#producto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$pedido=Pedido::model()->findByPk($_GET['id']);

?>

<h1>Agregar Productos al pedido <?php echo $pedido->numero; ?> </h1>
 
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	'columns'=>array(
	 array(
            'id'=>'autoId',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '50',  
            'checked' => '($data->check == "1")'                   
        ),
	array(
	       'name'=>'binaryfile',
		   'type'=>'raw',
	       'value'=>'$data->getImagen(50)',
                ),
	
		'detalle',
		'descripcion',
		array(
            'name'=>'check',
            'header'=>'Agregado',
            'filter'=>array('1'=>'Yes','0'=>'No'),
            'value'=>'($data->check=="1")?("Yes"):("No")'
        ),
		
		
	),
));  }?>
<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('producto-grid');
}
</script>
<?php echo CHtml::ajaxSubmitButton('Agregar',array('ajaxupdate','act'=>'doAdd','id'=>$_GET['id']), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Eliminar',array('ajaxupdate','act'=>'doDelete','id'=>$_GET['id']), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Eliminar Todos',array('ajaxupdate','act'=>'doDeleteAll','id'=>$_GET['id']), array('success'=>'reloadGrid')); ?>
<?php 
if(isset($_GET['cliente']))
	echo CHtml::button('Terminar',array('submit' => array('pedido/listapedido','cliente'=>$_GET['cliente']))); 
else
	echo CHtml::button('Terminar',array('submit' => array('pedido/admin'))); ?>
	
<?php $this->endWidget(); ?>
