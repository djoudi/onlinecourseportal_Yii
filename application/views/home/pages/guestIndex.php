<?php
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('onlinecourseportal', 'Guest');
?>
<div class="home-image">
	<h1><?php echo Yii::t('onlinecourseportal',  'Web-based Training for Caregivers'); ?></h1>
</div>
<div id="sidebar">

	<div class="box-sidebar zero">
		<a href="<?php echo $this->createUrl('user/register'); ?>"><?php echo Yii::t('onlinecourseportal',  'Register'); ?></a>
		<a href="<?php echo $this->createUrl('home/contact'); ?>"
			class="teal"><?php echo Yii::t('onlinecourseportal',  'Request Information'); ?></a>
	</div>

	<div class="box-sidebar one">
		<h3><?php echo Yii::t('onlinecourseportal',  'Stats on Caregivers'); ?></h3>
		<div>
			<img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/two-thirds.png"
				style="margin-bottom: 8px;" /><br /><?php echo Yii::t('onlinecourseportal',  '2/3 of working caregivers
			report conflicts between work and caregiving that result in increased
			absenteeism, workday interruptions, reduced hours, and workload
			shifting to other employees.'); ?>
		</div>
	</div>

	<div class="box-sidebar two">
		<h3><?php echo Yii::t('onlinecourseportal',  'Recent Research'); ?></h3>
		<div style="text-align: center">
			<img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/metlife.jpg" />
		</div>
		<p>
			<?php echo Yii::t('onlinecourseportal',  '<strong>Double Jeopardy for Baby Boomers Caring for Their Parents</strong><br />
			Nearly 10 million adult children over the age of 50 care for their
			aging parents. These family caregivers are themselves aging as well
			as providing care at a time when they also need to be planning and
			saving for their own retirement. The study is an updated, national
			look at adult children who work and care for their parents and the
			impact of caregiving on their earnings and lifetime wealth.'); ?>
		</p>
		<p>
			<a
				href="http://www.metlife.com/assets/cao/mmi/publications/studies/2010/mmi-working-caregivers-employers-health-care-costs.pdf"
				class="pdf"><?php echo Yii::t('onlinecourseportal',  'Read "The MetLife Study of Working Caregivers and
				Employer Health Care Costs"'); ?></a>
		</p>
	</div>

	<div class="box-sidebar three">
		<h3><?php echo Yii::t('onlinecourseportal',  'Whitepapers'); ?></h3>
		<p>
			<a
				href="http://www.matherlifewaysinstituteonaging.com/wp-content/uploads/2012/03/eLearning-Maturing-Technology.pdf"
				class="pdf"><?php echo Yii::t('onlinecourseportal',  'e-Learning: Maturing Technology Brings Balance &amp;
				Possibilities to Nursing Education'); ?></a> <a
				href="http://www.matherlifewaysinstituteonaging.com/wp-content/uploads/2012/03/How-eLearning-Can-Reduce-Expenses-and-Improve-Staff-Performance.pdf"
				class="pdf"><?php echo Yii::t('onlinecourseportal',  'The Bottom Line: How e-Learning Can Reduce Expenses and
				Improve Staff Performance'); ?></a>
		</p>
	</div>

	<div class="box-sidebar four">
		<h3>
			<img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/twitter-bird.png" /><a
				href="http://twitter.com/aginginaction" target="_blank">@aginginaction</a>
		</h3>
		<div id="twitter"></div>
		<div class="clear"></div>
	</div>

	<div class="box-sidebar three">
		<h3><?php echo Yii::t('onlinecourseportal',  'Our Clients'); ?></h3>
		<div id="customers">
			<a href="http://www.ibm.com"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/ibm.png"
				alt="IBM" /> </a> <a href="http://www.ti.com/"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/ti.png"
				alt="Texas Instrument" /> </a> <a href="http://www.merck.com"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/merck.png"
				alt="Merck Pharmaceuticals" /> </a> <a
				href="http://www.exxonmobil.com"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/exxon.png"
				alt="Merck Pharmaceuticals" /> </a> <a
				href="http://www.deloitte.com"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/deloitte.png"
				alt="Deloitte" /> </a> <a href="http://matherlifeways.com/"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/images/customers/mather.png"
				alt="Mather Lifeways" /> </a>
		</div>
	</div>

</div>

<div class="column-wide">
	<h2 class="flowers" style="font-family:" SourceSansPro", Arial, sans-serif;"><?php echo Yii::t('onlinecourseportal',  'Mather
		LifeWays Institute on Aging'); ?></h2>
	<p><?php echo Yii::t('onlinecourseportal',  'Through research-based programs and innovative techniques, Mather
		LifeWays Institute on Aging is committed to advancing the field of
		geriatric care. Cutting-edge research lays the foundation for our
		solid solutions to senior care challenges, including recruitment,
		mentorship, training, and retention.'); ?></p>
	<p><?php echo Yii::t('onlinecourseportal',  'Used by individuals and entire organizations, our nationally
		recognized, award-winning programs include training modules, online
		courses, toolkits, and learning modules designed to make learning fun
		and easy. Our programs have been shown to result in measurable
		improvements in the quality of care provided and workforce retention.'); ?></p>

	<h4><?php echo Yii::t('onlinecourseportal',  'Web-based Courses for Caregivers'); ?></h4>
	<p style="padding-bottom: 25px;"><?php echo Yii::t('onlinecourseportal',  'We deliver online learning and
		web-based modalities using the latest technologies to efficiently and
		cost-effectively empower professionals. In addition, we’re
		well-positioned to help conduct pilot studies that measure the impact
		on both working caregivers and the bottom line for interested
		corporations.'); ?></p>

	<h2 class="flowers top-pad"><?php echo Yii::t('onlinecourseportal',  'Caregivers Enrolled in the Course'); ?></h2>
	<div class="box-grey">
		<video id="MatherCareGivers" controls width="540" height="305">
			<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/MatherCareGivers.mp4" type='video/mp4' >
			<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/MatherCareGivers.ogv" type='video/ogg; codecs="theora, vorbis"'/>
			<source src="<?php echo Yii::app()->theme->baseUrl; ?>/videos/MatherCareGivers.webm" type='video/webm' >
			<p>Video is not visible, most likely your browser does not support HTML5 or flash video</p>
		</video>
		
		<script type="text/javascript">
		  jwplayer("MatherCareGivers").setup({
			image: "<?php echo Yii::app()->theme->baseUrl; ?>/videos/MatherCareGivers.jpg",
		    modes: [
		        { type: 'html5' },
		        { type: 'flash', src: '<?php echo Yii::app()->theme->baseUrl; ?>/js/player.swf' },
		        { type: 'download'}
		    ],
			width: 540,
			height: 305,
			stretching: "fill",
		  });
		</script>
	</div>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	      google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Task', 'Hours per Day'],
	          ['Online Course Delivery', 25],
	          ['Targeted Collaboration', 50],
	          ['Institution Wide Content Management', 25]
	        ]);

	        var options = {
	          colors: ["#f47b20", "#008c99", "#aaaaaa"],
	          legend: { position: "none" },
			  chartArea: {left:20, top:20, width:"90%", height:"90%" },
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
	        chart.draw(data, options);
	      }
	    </script>

	<h2 class="flowers top-pad"><?php echo Yii::t('onlinecourseportal',  'Pedagogy'); ?></h2>
	<p><?php echo Yii::t('onlinecourseportal',  'Effective online instruction depends on learning experiences
		appropriately designed and facilitated by knowledgeable facilitators.
		Because learners have different learning styles or a combination of
		styles, our web-based training has been design using activities that
		address their modes of learning in order to provide significant
		experiences for each course user. Mouse-over the chart below to see
		our areas of focus.'); ?></p>
	<div id="pie-chart" style="height: 350px;"></div>

	<iframe src="<?php echo Yii::app()->request->baseUrl; ?>/limeSurvey/index.php/survey/index/sid/844119" height="425" width="100%">
	</iframe>

	<p>
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/limeSurvey/index.php/survey/index/sid/842365"
			class="fancybox extLink button"><?php echo Yii::t('onlinecourseportal',  'HR/Employer Survey'); ?></a> 
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/limeSurvey/index.php/survey/index/sid/419973"
			class="fancybox extLink button"><?php echo Yii::t('onlinecourseportal',  'Caregiver Survey'); ?></a>
	</p>

</div>

<div id="bottom-logos">

	<h4><?php echo Yii::t('onlinecourseportal',  'Partners'); ?></h4>
	<a href="http://www.rushu.rush.edu" id="rush">Rush University (Chicago)</a>
	<a href="http://www.alz.org/" id="aa" target="_blank">Alzheimer's
		Asssociation</a> <a href="https://github.com/" id="git"
		target="_blank">GitHub</a> <a href="http://www.yiiframework.com/"
		id="yii" target="_blank">Yii Framework</a> <a href="http://wfd.com/"
		id="wfd" target="_blank">WFD</a> <a
		href="http://www.discoursellc.com/" id="discourse" target="_blank">Discourse,
		LLC.</a> <a href="http://gladerfilmworks.com/" id="glader"
		target="_blank">Glader Filmworks</a> <a
		href="http://www.mediastorm.com/" id="mediastorm" target="_blank">Discourse,
		LLC.</a>
	<div class="clear"></div>

</div>