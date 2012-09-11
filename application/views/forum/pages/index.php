<h1><?php echo Yii::t('onlinecourseportal', 'Forum'); ?></h1>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Forum');
$this->breadcrumbs = array(
		Yii::t('onlinecourseportal', 'Forum'),
);
?>

<iframe src="<?php echo Yii::app()->request->baseUrl; ?>/phpBB" height="700" width="100%">
</div>