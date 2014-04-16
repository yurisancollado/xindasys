<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model->nombre.' '.$model->apellido,
);

if($model->estado==1)
	$accionActivo=array('label'=>'Desactivar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('desactivar','id'=>$model->id),'confirm'=>'Esta seguro que desea desactivar el usuario?'));
else {
	$accionActivo=array('label'=>'Activar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('activar','id'=>$model->id),'confirm'=>'Esta seguro que desea activar el usuario?'));
}
$this->menu=array(
array('label'=>'Administrar Usuario', 'url'=>array('admin')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'<hr>'),
	array('label'=>'Modificar Usuario', 'url'=>array('update', 'id'=>$model->id)),
	$accionActivo,	
	
);
?>

<h1>Usuario: <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'cedula',
		'nombre',
		'apellido',		
		'username',
		'Estado',
		'TipoUsuario',
		
	),
)); 
}?>
