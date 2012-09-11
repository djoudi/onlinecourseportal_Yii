<div class="form">
	<?php $form = $this->beginWidget(
			'CActiveForm',
			array(
					'id' => 'upload-file-form',
					'enableAjaxValidation' => true,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
			));
	?>

		<div class="row">
			<?php echo $form->labelEx($uploadFile, 'file'); ?>
			<?php echo $form->fileField($uploadFile, 'file'); ?>
			<?php echo $form->error($uploadFile, 'file'); ?>
		</div>
					
		<div class="row submit">
			<?php echo CHtml::submitButton(Yii::t('onlinecourseportal', 'Upload')); ?>
		</div>

	<?php $this->endWidget();?>

</div>
