<?php
/* @var $this PedidoController */
/* @var $model Pedido */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pedido-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		)
));
if(isset($_GET['cliente'])){
	$cliente=Cliente::model()->findByPk($_GET['cliente']);
	$id_cliente=$_GET['cliente'];
}
else{
	$cliente=Cliente::model()->findByPk($model->clientes_id);
	$id_cliente=$model->clientes_id;
}?> 

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'clientes_id'); ?>
		<?php echo $form->hiddenField($model, 'clientes_id',array('value'=>$id_cliente)); ?>
		<?php echo "<input type='text' disabled='disabled' value='".$cliente->nombre." ".$cliente->apellido."'/>"; ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero'); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				'model'=>$model,
				'attribute'=>'fecha',
				'language'=>'es',
				'options'=>array(
					'dateFormat'=>'yy-mm-dd',
					'constrainInput'=>'false',
					'duration'=>'fast',
					'showAnim'=>'slide',
				),
			)
		);?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Siguiente' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->