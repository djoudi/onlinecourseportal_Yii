<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Registration Confirmed');
?>
<div id="single-column">
	<h2 class="flowers"><?php echo Yii::t('onlinecourseportal', 'Thank you for registering!'); ?></h2>
	<p class="header"><?php echo Yii::t('onlinecourseportal', 'Thank you for registering with us! You are now
		one-step closer to gaining access to the Online Course Portal. A
		confirmation email has been sent to the email address you provided on
		the previous page. Please click the link in that email to complete your
		account registration.'); ?></p>
	<p class="header">
		<?php echo Yii::t('onlinecourseportal', 'Please'); ?> <a href="<?php echo $this->createUrl('home/contact'); ?>"
			title="Support"><?php echo Yii::t('onlinecourseportal', 'email'); ?></a> <?php echo Yii::t('onlinecourseportal', 'us if you need assistance completing the
		registration process.'); ?>
	</p>
</div>