<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Modificar Abono', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Abono', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Abono', 'url'=>array('admin')),
);
?>

<h1>Abono: <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		
		array(
       'name'=>'fecha',
       'value'=>Yii::app()->dateFormatter->format('dd-MM-yyyy',$model->fecha) ,  
     ),
		'factura_id',
		'usuarios_id',
		'monto',
	),
));
} ?>
