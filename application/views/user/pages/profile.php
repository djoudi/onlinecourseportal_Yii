<h1><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/image-register.png" /><?php echo Yii::t('onlinecourseportal', 'Profile'); ?></h1>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Profile');
$this->breadcrumbs = array(
		Yii::t('onlinecourseportal', 'Profile'),
);
?>

<?php echo $this->renderPartial('forms/profile_form', array('models' => $models)); ?>

</div>