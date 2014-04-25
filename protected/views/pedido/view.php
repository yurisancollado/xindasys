<style>
tr:nth-child(odd) {
    background-color: #E5F1F4;
}
tr:nth-child(even) {
    background-color: #F8F8F8;
}

.img-producto{text-align:center;}

</style>

<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	$model->numero,
);
$cliente=Cliente::model()->findByPk($model->clientes_id);
$this->bolmenu2=true;
$this->nombreCliente=$cliente->nombre.' '.$cliente->apellido;
$this->menu=array(
	array('label'=>'Administrar Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Pedido', 'url'=>array('pedido/admin')),	
);
$this->menu2=array(
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
	array('label'=>'Modificar Cliente', 'url'=>array('cliente/update', 'id'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Facturas', 'url'=>array('factura/listafactura','cliente'=>$cliente->id)),
	array('label'=>'Crear Factura', 'url'=>array('factura/create','cliente'=>$cliente->id)),
	array('label'=>'<hr>'),
	array('label'=>'Listar Pedidos', 'url'=>array('pedido/listapedido','cliente'=>$cliente->id)),
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create','cliente'=>$cliente->id)),
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
<br/><br/><br/><br/>
<h2>Productos Asociados</h2>
<table class="detail-view" id="productos">
	<tbody>
		<?php
		foreach($model->productos as $producto){?>
			<tr>
				<td class="img-producto"><?php echo $producto->getImagen(50);?></td>
				<td style="vertical-align:middle"><?php echo "<b>Nombre: </b>".$producto->detalle."<br/><b>Descripcion: </b>".$producto->descripcion;?></td>
			</tr>	
		<?php }?>
	</tbody>
</table>

