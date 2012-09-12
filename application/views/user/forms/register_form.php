<div class="form">
	<?php $form = $this->beginWidget(
			'CActiveForm',
			array(
					'id' => 'register-form',
					'enableAjaxValidation' => true,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
			));
	?>
	<p class="note">
		<?php echo Yii::t('onlinecourseportal', 'Fields with <span class="required">*</span> are required.'); ?>
	</p>
	<?php echo $form->errorSummary($models); ?>
	
	<div class="row">
		<?php echo $form->labelEx($models['user'], 'email'); ?>
		<?php echo $form->emailField($models['user'], 'email', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user'], 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user'], 'password_no_hash'); ?>
		<?php echo $form->passwordField($models['user'], 'password_no_hash', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user'], 'password_no_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user'], 'password_no_hash_repeat'); ?>
		<?php echo $form->passwordField($models['user'], 'password_no_hash_repeat', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user'], 'password_no_hash_repeat'); ?>
	</div>

	<div class="row">
		<label for="UserProfile_firstname" class="required">First Name <span class="required">*</span></label>
		<?php echo $form->textField($models['user_profile'], 'firstname', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user_profile'], 'firstname'); ?>
	</div>
	
	<div class="row">
		<label for="UserProfile_lastname" class="required">Last Name <span class="required">*</span></label>
		<?php echo $form->textField($models['user_profile'], 'lastname', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user_profile'], 'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user_profile'], 'city'); ?>
		<?php echo $form->textField($models['user_profile'], 'city', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user_profile'], 'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user_profile'], 'state_id'); ?>
		<?php echo $form->dropDownList($models['user_profile'], 'state_id', 
				CHtml::listData(
					States::model()->findAll(), 'id', 'name'),
					array('prompt' => 'Select a State')
					); 
		?>
		<?php echo $form->error($models['user_profile'], 'state_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user_profile'], 'zip_code'); ?>
		<?php echo $form->textField($models['user_profile'], 'zip_code', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user_profile'], 'zip_code'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($models['user_profile'], 'country_iso'); ?>
		<?php echo $form->dropDownList($models['user_profile'], 'country_iso', Yii::app()->localeManager->getTerritories()); 
		?>
		<?php echo $form->error($models['user_profile'], 'country_iso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['avatar'], 'image'); ?>
		<?php echo $form->fileField($models['avatar'], 'image'); ?>
		<?php echo $form->error($models['avatar'], 'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($models['user_profile_extended'], 'employment_status_id'); ?>
		<?php echo $form->dropDownList($models['user_profile_extended'], 'employment_status_id', 
				CHtml::listData(
					EmploymentStatus::model()->findAll(), 'id', 'name'),
					array('prompt' => 'Select your employment status')
					); 
		?>
		<?php echo $form->error($models['user_profile_extended'], 'employment_status_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($models['user_profile_extended'], 'age_group_id'); ?>
		<?php echo $form->dropDownList($models['user_profile_extended'], 'age_group_id', 
				CHtml::listData(
					AgeGroup::model()->findAll(), 'id', 'name'),
					array('prompt' => 'Select your age group')
					); 
		?>
		<?php echo $form->error($models['user_profile_extended'], 'age_group_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($models['user_profile_extended'], 'caregiver'); ?>
		<?php echo $form->radioButtonList($models['user_profile_extended'], 'caregiver', array(true => 'Yes', false => 'No')); ?>
		<?php echo $form->error($models['user_profile_extended'], 'caregiver'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($models['user_profile_extended'], 'caregiver_title'); ?>
		<?php echo $form->textField($models['user_profile_extended'], 'caregiver_title', array('class' => 'wide_200px')); ?>
		<?php echo $form->error($models['user_profile_extended'], 'caregiver_title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($models['user_profile_extended'], 'caring_at_home'); ?>
		<?php echo $form->radioButtonList($models['user_profile_extended'], 'caring_at_home', array(true => 'Yes', false => 'No')); ?>
		<?php echo $form->error($models['user_profile_extended'], 'caring_at_home'); ?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($models['captcha'], 'captcha');
		$this->widget('ext.recaptcha.EReCaptcha',
				array('model' => $models['captcha'], 
						'attribute' => 'captcha',
						'language' => Yii::app()->language)
				);
		echo $form->error($models['captcha'], 'captcha');
		?>
	</div>
				
	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t('onlinecourseportal', 'Submit')); ?>
	</div>

	<?php $this->endWidget();?>
</div>
<!-- form -->
