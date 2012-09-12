<div class="small-masthead" style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/header-register.png);">
	<h1 class="bottom"><?php echo Yii::t('onlinecourseportal', 'Profile'); ?></h1>
</div>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Profile');
//$this->breadcrumbs = array( Yii::t('onlinecourseportal', 'Profile') );
?>

<?php echo $this->renderPartial('forms/profile_form', array('models' => $models)); ?>

</div>