<?php
/* @var $this AbonoController */
/* @var $model Abono */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Abonos'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Ver Abono', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Abono', 'url'=>array('admin')),
);
?>

<h1>Modificar: <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model));
}
 ?>