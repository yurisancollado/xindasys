<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'General',			
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
			'encodeLabel'=>false,
		));
		$this->endWidget();
	?>
	
	<?php
	if($this->bolmenu2){
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>$this->nombreCliente,			
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu2,
			'htmlOptions'=>array('class'=>'operations'),
			'encodeLabel'=>false,
		));
		$this->endWidget();
	}
	?>
	
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>