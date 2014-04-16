<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model));

} ?>