<?php
/* @var $this FacturaController */
/* @var $dataProvider CActiveDataProvider */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas',
);

$this->menu=array(
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
);
?>

<h1>Facturas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
}?>
