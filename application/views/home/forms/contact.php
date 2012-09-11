<p><?php echo Yii::t('onlinecourseportal', 'If you have business inquiries or other questions, please fill out
	the following form to contact us. Thank you.'); ?></p>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">
		<?php echo Yii::t('onlinecourseportal', 'Fields with <span class="required">*</span> are required.'); ?>
	</p>

	<?php echo $form->errorSummary($models); ?>

	<div class="row">
		<?php echo $form->labelEx($models['contactUs'],'name'); ?>
		<?php echo $form->textField($models['contactUs'],'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['contactUs'],'email'); ?>
		<?php echo $form->textField($models['contactUs'],'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['contactUs'],'subject'); ?>
		<?php echo $form->textField($models['contactUs'],'subject',array('size'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['contactUs'],'body'); ?>
		<?php echo $form->textArea($models['contactUs'],'body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($models['captcha'], 'captcha');
		$this->widget('ext.recaptcha.EReCaptcha',
				array('model' => $models['captcha'], 
						'attribute' => 'captcha',
						'language' => Yii::app()->language));
		echo $form->error($models['captcha'], 'captcha');
		?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t('onlinecourseportal', 'Submit')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->