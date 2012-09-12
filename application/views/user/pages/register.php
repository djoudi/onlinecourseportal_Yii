<div class="small-masthead" style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/header-register.png);">
	<h1 class="bottom"><?php echo Yii::t('onlinecourseportal', 'Register'); ?></h1>
</div>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Register');
//$this->breadcrumbs = array( Yii::t('onlinecourseportal', 'Register') );
?>

<?php echo $this->renderPartial('forms/register_form', array('models' => $models)); ?>
</div>