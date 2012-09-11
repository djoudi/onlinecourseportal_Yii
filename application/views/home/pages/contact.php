	<h1><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/image-contact.png" /><?php echo Yii::t('onlinecourseportal', 'Contact Us'); ?></h1>
	<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Contact Us');
$this->breadcrumbs = array(
		Yii::t('onlinecourseportal', 'Contact Us'),
);
?>

<?php echo $this->renderPartial('forms/contact', array('models' => $models)); ?>

</div>