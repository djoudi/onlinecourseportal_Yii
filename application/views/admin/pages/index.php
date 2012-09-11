<h1><?php echo Yii::t('onlinecourseportal', 'Admin'); ?></h1>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Admin');
$this->breadcrumbs = array(
		Yii::t('onlinecourseportal', 'Admin'),
);
?>

<?php echo Yii::app()->translate->editLink(); ?>
<br />
<?php echo Yii::app()->translate->missingLink(); ?>
<br />
<?php echo CHtml::link('Lime Survey', Yii::app()->request->baseUrl . '/limeSurvey/admin'); ?>
<br />
<?php echo CHtml::link('phpBB', Yii::app()->request->baseUrl . '/phpBB'); ?>

</div>