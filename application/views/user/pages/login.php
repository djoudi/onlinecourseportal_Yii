<h1><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/image-login.png" /><?php echo Yii::t('onlinecourseportal', 'Login'); ?></h1>
<div id="single-column">
	<?php
	$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Login');
	$this->breadcrumbs = array(
			Yii::t('onlinecourseportal', 'Login'),
	);
	?>


	<p><?php echo Yii::t('onlinecourseportal', 'Please fill out the following form with your login credentials:'); ?></p>
	<p>
		<?php echo Yii::t('onlinecourseportal', 'If you have not yet registered with us please click'); ?>
		<?php echo CHtml::link(Yii::t('onlinecourseportal', 'here'), $this->createUrl('register')); ?>
	</p>

	<?php echo $this->renderPartial('forms/login_form', array('model' => $model)); ?>
</div>