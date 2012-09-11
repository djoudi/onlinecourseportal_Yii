<h1><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/image-register.png" /><?php echo Yii::t('onlinecourseportal', 'Register'); ?></h1>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Register');
$this->breadcrumbs = array(
		Yii::t('onlinecourseportal', 'Register'),
);
?>

<?php echo $this->renderPartial('forms/register_form', array('models' => $models)); ?>
</div>