<?php
/* @var $this AbonoController */
/* @var $dataProvider CActiveDataProvider */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos',
);

$this->menu=array(
	array('label'=>'Administrar Abono', 'url'=>array('admin')),
);
?>

<h1>Abonos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
}?>
