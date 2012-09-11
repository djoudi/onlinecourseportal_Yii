<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'login-form',
			'enableAjaxValidation' => true,
)); ?>

	<p class="note">
		<?php echo Yii::t('onlinecourseportal', 'Fields with <span class="required">*</span> are required.'); ?>
	</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_no_hash'); ?>
		<?php echo $form->passwordField($model,'password_no_hash'); ?>
		<?php echo $form->error($model,'password_no_hash'); ?>
	</div>

	<div class="row remember_me">
		<?php echo CHtml::checkBox('remember_me'); ?>
		<?php echo CHtml::label(Yii::t('onlinecourseportal', 'Remember me next time.'),'remember_me'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t('onlinecourseportal', 'Login')); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
<!-- form -->
