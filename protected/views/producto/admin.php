
<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
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
?>

<h1>Administrar Productos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	'columns'=>array(
	
		'detalle',
		'descripcion',
		array(
	       'name'=>'binaryfile',
		   'type'=>'raw',
	       'value'=>'$data->getImagen(50)',
                ),
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
));  }?>
