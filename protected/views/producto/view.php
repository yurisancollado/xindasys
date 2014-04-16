<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	$model->detalle,
);

$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Modificar Producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Producto: <?php echo $model->detalle; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'detalle',
		'descripcion',
		array(
	       'name'=>'Imagen',
		   'type'=>'raw',
	       'value'=>html_entity_decode(CHtml::image(Yii::app()->controller->createUrl('producto/loadImage', array('id'=>$model->id))
																				,'alt'
																				,array('width'=>200)
																				)),
                ),
	),
));
#echo CHtml::image(Yii::app()->controller->createUrl('producto/loadImage', array('id'=>$model->id)));
} ?>
