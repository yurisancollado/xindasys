<?php
/* @var $this ProductoController */
/* @var $data Producto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('binaryfile')); ?>:</b>
	<?php echo CHtml::encode($data->binaryfile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileName')); ?>:</b>
	<?php echo CHtml::encode($data->fileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileType')); ?>:</b>
	<?php echo CHtml::encode($data->fileType); ?>
	<br />


</div>