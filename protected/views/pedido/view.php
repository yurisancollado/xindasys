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

