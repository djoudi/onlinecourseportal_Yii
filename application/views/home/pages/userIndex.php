<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'User');
?>
	<div class="small-masthead" style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/home.png);">
		<h1 class="bottom"><?php echo Yii::t('onlinecourseportal', 'Welcome!'); ?></h1>
	</div>
	<div id="sidebar">
		
		<div class="box-sidebar three">
			<h3><?php echo Yii::t('onlinecourseportal', 'Stats on Caregivers'); ?></h3>
			<div style="height: 90px;">
				<ul class="quotes">
					<li><?php echo Yii::t('onlinecourseportal', '<span>1/4</span> of US households – has a family caregiver providing some form of care or service to a relative or friend, age 50+'); ?></li>
					<li><?php echo Yii::t('onlinecourseportal', '<span>2/3</span> of these family caregivers are also working.'); ?></li>
					<li><?php echo Yii::t('onlinecourseportal', '<span>50%</span> of employed caregivers work full-time/'); ?></li>
				</ul>
			</div>
		</div>

		<div class="box-sidebar four">
			<h3><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/twitter-bird.png" /><a href="http://twitter.com/aginginaction" target="_blank">@aginginaction</a></h3>
			<div id="feedburner"></div>
			<div class="clear"></div>
		</div>

	</div>
	<div class="column-wide">

		<h2 class="flowers"><?php echo Yii::t('onlinecourseportal', 'Mather LifeWays Institute on Aging'); ?></h2>
		<p><?php echo Yii::t('onlinecourseportal', 'Through research-based programs and innovative techniques, Mather LifeWays Institute on Aging is 
		committed to advancing the field of geriatric care. Cutting-edge research lays the foundation for our solid solutions to senior care challenges, 
		including recruitment, mentorship, training, and retention.'); ?></p>
		
		<p><?php echo Yii::t('onlinecourseportal', 'Used by individuals and entire organizations, our nationally recognized, 
		award-winning programs include training modules, online courses, toolkits, and learning modules designed to make learning fun and easy. 
		Our programs have been shown to result in measurable improvements in the quality of care provided and workforce retention.'); ?></p>
		
			<h2 class="flowers"><?php echo Yii::t('onlinecourseportal', 'Employers and Employees'); ?></h2>
		<p><?php echo Yii::t('onlinecourseportal', 'We are uniquely positioned to provide corporations with innovative programs and products, all 
		thoughtfully developed and tested under applied research conditions with well-respected companies and senior living organizations. With staff 
		expertise across a number of fields including gerontology, psychology, sociology, nursing, and cultural anthropology, we bring together 
		multiple perspectives to address a wide range of issues that affect the aging population.'); ?></p>
		
		<p><?php echo Yii::t('onlinecourseportal', 'We deliver online learning and web-based modalities using the latest technologies to efficiently and cost-effectively empower professionals. 
		Digital toolkits provide one-stop training resources for human resource managers and trainers who wish to incorporate key topics for working 
		caregivers into current training programs. In addition, we’re well-positioned to help conduct pilot studies that measure the impact on both 
		working caregivers and the bottom line for interested corporations.'); ?></p>

		<h2 class="flowers top-pad"><?php echo Yii::t('onlinecourseportal', 'The Sandwich Generation - by Media Storm'); ?></h2>
			<p><?php echo Yii::t('onlinecourseportal', 'Filmmaker-photographer couple Julie Winokur and Ed Kashi were busy pursuing their careers 
			and raising two children when Winokurs 83-year-old father, Herbie, became too infirm to care for himself. At that moment they joined 
			some twenty million other Americans who make up the sandwich generation, those who find themselves responsible for the care of both 
			their children and their aging parents.'); ?></p>
			
			<p><?php echo Yii::t('onlinecourseportal', 'Authors of the book Aging in America: The Years Ahead, which chronicles the countrys 
			fastest-growing segment of the population, Winokur and Kashi decided to tell their own story as they took on the care of Winokurs 
			father. In The Sandwich Generation, they have created an honest, intimate account of their own shifting — and challenging — 
			responsibilities, as well as some of their unexpected joys.'); ?></p>
		
		<div class="box-grey">
			<video id="TheSandwichGeneration" controls width="540" height="360">
				<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/THE_SANDWICH_GENERATION.mp4" type='video/mp4' >
				<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/THE_SANDWICH_GENERATION.ogv" type='video/ogg; codecs="theora, vorbis"'/>
				<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/THE_SANDWICH_GENERATION.webm" type='video/webm' >
				<p>Video is not visible, most likely your browser does not support HTML5 or flash video</p>
			</video>
			
			<script type="text/javascript">
			  jwplayer("TheSandwichGeneration").setup({
				image: "<?php echo Yii::app()->theme->baseUrl; ?>/videos/THE_SANDWICH_GENERATION.jpg",
			    modes: [
			        { type: 'html5' },
			        { type: 'flash', src: '<?php echo Yii::app()->theme->baseUrl; ?>/js/player.swf' },
			        { type: 'download'}
			    ],
				width: 540,
				height: 360,
				stretching: "fill",
			  });
			</script>
		</div>

	</div>
</div>