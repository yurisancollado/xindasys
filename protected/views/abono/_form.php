<?php
/* @var $this AbonoController */
/* @var $model Abono */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'abono-form',
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
$factura=Factura::model()->findByPk($_GET['id']);?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
	<?php 
		echo $form->hiddenField($model, 'factura_id',array('value'=>$_GET['id']));		
	?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo 'Numero de Factura:'; ?>
		<?php echo $factura->numero; ?>
	</div>
	<div class="row">
		<?php echo 'Monto de Factura:'; ?>
		<?php echo $factura->monto; ?>
	</div>
	<div class="row">
		<?php echo 'Monto de Cancelado:'; ?>
		<?php echo $factura->MontoCancelado; ?>
	</div>
	<div class="row">
		<?php echo 'Monto Por Cancelar:'; ?>
		<?php echo $factura->monto-$factura->MontoCancelado; ?>
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
	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->