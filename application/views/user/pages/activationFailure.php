<?php
$this->pageTitle = Yii::app()->name .' - '.Yii::t('onlinecourseportal', 'Activation Failed');
?>
<p class="header"><?php echo Yii::t('onlinecourseportal', 'Oops! An error ocurred while trying to activate your
	acount.'); ?></p>
<p class="header">
	<?php echo Yii::t('onlinecourseportal', 'Please'); ?> <a href="<?php echo $this->createUrl('home/contact'); ?>"
		title="Support"><?php echo Yii::t('onlinecourseportal', 'email'); ?></a> <?php echo Yii::t('onlinecourseportal', 'us if you need assistance completing the
	registration process.'); ?>
</p>
