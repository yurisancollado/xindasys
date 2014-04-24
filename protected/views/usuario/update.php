<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model->nombre.' '.$model->apellido=>array('view','id'=>$model->id),
	'Modificar',
);
$this->menu=array(
array('label'=>'Administrar Usuario', 'url'=>array('admin')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
);
$this->bolmenu2=true;
$this->nombreCliente=$model->nombre.' '.$model->apellido;;
$this->menu2=array(
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Modificar: <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
}?>