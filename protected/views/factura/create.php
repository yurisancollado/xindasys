<?php
/* @var $this FacturaController */
/* @var $model Factura */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	'Crear',
);
$cliente=Cliente::model()->findByPk($_GET['cliente']);
$this->menu=array(
array('label'=>'Administrador Cliente', 'url'=>array('cliente/admin')),
	array('label'=>'Administrar Factura', 'url'=>array('admin')),
	array('label'=>'<hr>'),
	array('label'=>'Ver Cliente', 'url'=>array('cliente/view', 'id'=>$cliente->id)),
);
?>

<h1>Crear Factura</h1>

<?php if(isset($_GET['cliente'])) $this->renderPartial('_form', array('model'=>$model));
	else $this->redirect(array('cliente/admin'));
}?>