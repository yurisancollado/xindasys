<?php
/* @var $this ProductoController */
/* @var $dataProvider CActiveDataProvider */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos',
);

$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Productos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));} ?>
