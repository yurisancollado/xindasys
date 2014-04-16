
<?php
/* @var $this ProductoController */
/* @var $model Producto */
if(!Yii::app()->user->isGuest){
$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Crear Pedido', 'url'=>array('pedido/create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$pedido=Pedido::model()->findByPk($_GET['id']);

?>

<h1>Agregar Productos al pedido <?php echo $pedido->numero; ?> </h1>
 
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	'columns'=>array(

	 array(
            'id'=>'autoId',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '50',      
               
        ),
		'detalle',
		'descripcion',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
));  }?>
<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('menu-grid');
}
</script>
<?php echo CHtml::ajaxSubmitButton('Agregar',array('pedido/ajaxupdate','act'=>'doAdd'), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Eliminar',array('pedido/ajaxupdate','act'=>'doDelete'), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Eliminar Todos',array('pedido/ajaxupdate','act'=>'doDeleteAll'), array('success'=>'reloadGrid')); ?>
<?php $this->endWidget(); ?>
