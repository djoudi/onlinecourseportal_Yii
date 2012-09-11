<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css"
		href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css"
		media="screen, projection" />
	<link rel="stylesheet" type="text/css"
		href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css"
		media="print" />
	<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->

	<link rel="stylesheet" type="text/css"
		href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css"
		href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css"
		href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox.css" />

	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.tweet.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.cycle.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.quote.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.feed.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<div class="container" id="page">

		<div id="header">

			<div id="logo">
				<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" />
			</div>

			<div id="site-title"><?php echo Yii::app()->name; ?></div>
			
			<div id="language-menu"><?php $this->widget('application.components.widgets.LanguageSelector'); ?></div>
			
			<?php if(Yii::app()->user->isAdmin): ?>
				<div id="translate-button">
					<?php echo Yii::app()->translate->translateLink('Missing Translations on Page', 'button'); ?>	
				</div>
			<?php endif; ?>

			<div id="mainmenu">
				<?php 
				if(!isset($this->menu))
					$this->menu = array(
									array('label' => Yii::t('onlinecourseportal', 'Home'),
											'url' => Yii::app()->createAbsoluteUrl('home/index')),
									array('label' => Yii::t('onlinecourseportal', 'Contact Us'),
											'url' => Yii::app()->createAbsoluteUrl('home/contact')),
									array('label' => Yii::t('onlinecourseportal', 'Register'),
											'url' => Yii::app()->createAbsoluteUrl('user/register'),
											'visible' => Yii::app()->user->isGuest),
									array('label' => Yii::t('onlinecourseportal', 'Login'),
											'url' => Yii::app()->createAbsoluteUrl('user/login'),
											'visible' => Yii::app()->user->isGuest),
									array('label' => Yii::t('onlinecourseportal', 'Profile / Files'),
											'url' => Yii::app()->createAbsoluteUrl('user/profile'),
											'visible' => !Yii::app()->user->isGuest),
									array('label' => Yii::t('onlinecourseportal', 'Forum'),
											'url' => Yii::app()->createAbsoluteUrl('forum/index'),
											'visible' => !Yii::app()->user->isGuest),
									array('label' => Yii::t('onlinecourseportal', 'Courses'),
											'url' => Yii::app()->createAbsoluteUrl('course/index'),
											'visible' => !Yii::app()->user->isGuest),
									array('label' => Yii::t('onlinecourseportal', 'Admin'),
											'url' => Yii::app()->createAbsoluteUrl('admin/index'),
											'visible' => Yii::app()->user->isAdmin),
									array('label' => Yii::t('onlinecourseportal', 'Logout'),
											'url' => Yii::app()->createAbsoluteUrl('user/logout'),
											'visible' => !Yii::app()->user->isGuest)
							);
				?>
				<?php $this->widget('zii.widgets.CMenu', array('items' => $this->menu)); ?>
			</div>

		</div>
		<!-- header -->

		<div id="content">
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
			)); ?>
			<!-- breadcrumbs -->
			
			<?php if(Yii::app()->user->hasFlash('success')): ?>
			
					<div class="flash-success">
						<?php echo Yii::app()->user->getFlash('success'); ?>
					</div>
					
			<?php endif; ?>
					
			<?php if(Yii::app()->user->hasFlash('notice')): ?>
			
					<div class="flash-notice">
						<?php echo Yii::app()->user->getFlash('notice'); ?>
					</div>
					
			<?php endif; ?>
					
			<?php if(Yii::app()->user->hasFlash('error')): ?>
					
					<div class="flash-error">
						<?php echo Yii::app()->user->getFlash('error'); ?>
					</div>
					
			<?php endif; ?>

			<?php echo $content; ?>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>
	</div>
	<!-- page -->

	<div id="footer">
		<div class="container">

			<div class="logo"><a href="http://www.matherlifewaysinstituteonaging.com/" title="Mather LifeWays Institute on Aging"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo-footer.jpg" /></a></div>
			<div id="footer-icons" class="icons">
				<a class="twitter" href="http://twitter.com/aginginaction" rel="nofollow" target="_blank">Twitter</a>
				<a class="facebook" href="http://www.facebook.com/matherlifeways" rel="nofollow" target="_blank">Facebook</a>
				<a class="pinterest" href="#" rel="nofollow" target="_blank">Pinterest</a>
				<a class="youtube" href="http://www.youtube.com/matherlifeways" rel="nofollow" target="_blank">Youtube</a>
			</div>
			<div id="copyright">
				<ul>
				<li>P: <?php echo Yii::app()->params->phone; ?> | F: <?php echo Yii::app()->params->fax; ?></li>
				<li><?php echo Yii::app()->params->address; ?></li>
				<li><?php echo Yii::app()->params->copyrightInfo; ?></li>
				</ul>
			</div>

		</div>
	</div>
	<!-- footer -->

</body>
</html>
