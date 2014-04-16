<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(!Yii::app()->user->isGuest){
	
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Crear Usuario', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Usuarios</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 'enablePagination'=>true,
	'columns'=>array(
		'cedula',
		'nombre',
		'apellido',
		'username',
		array(
		'name'=>'estado',
		'header'=>'Estado',
		'value'=>'$data->Estado',
		'filter'=>Usuario::getListaEstado(),
		),
		array(
		'name'=>'admin',
		'header'=>'Tipo de Usuario',
		'value'=>'$data->TipoUsuario',
		'filter'=>Usuario::getListaTipoUsuario(),
		),
		/*
		'estado',
		'created_at',
		'last_login',
		'admin',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); 
}?>
