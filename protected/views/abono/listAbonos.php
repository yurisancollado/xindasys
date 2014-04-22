<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
	array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'<hr>'),
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$model->id)),
	array('label'=>'<hr>'),
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
$factura=Factura::model()->findByPk($_GET['id']);
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
