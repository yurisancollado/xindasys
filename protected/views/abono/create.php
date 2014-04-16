<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Abono', 'url'=>array('admin')),
);
$factura=Factura::model()->findByPk($_GET['id']);
?>

<h1>Crear Abono a Factura  <?php echo $factura->numero?></h1>

<?php $this->renderPartial('_form', array('model'=>$model));
} ?>