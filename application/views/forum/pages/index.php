<div class="small-masthead" style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/header-forum.png);">
	<h1 class="bottom"><?php echo Yii::t('onlinecourseportal', 'Forum'); ?></h1>
</div>
<div id="single-column">
<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Forum');
//$this->breadcrumbs = array( Yii::t('onlinecourseportal', 'Forum') );
?>

<iframe src="<?php echo Yii::app()->request->baseUrl; ?>/phpBB" height="700" width="100%">
</div>