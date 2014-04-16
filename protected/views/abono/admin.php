<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Crear Abono', 'url'=>array('factura/admin')),
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

<h1>Administrar Abonos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'abono-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	array(
		'name'=>'cliente',
		'header'=>'Cliente',
		'value'=>'$data->factura->clientes->nombre." ".$data->factura->clientes->apellido',
		'filter'=>Factura::getListUsuario(),
		),
		array(
		'header'=>'Factura',
		'value'=>'$data->factura->numero',
		),
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
