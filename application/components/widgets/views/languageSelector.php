<div id="language-select">
<?php 
	// Render options as dropDownList
	echo CHtml::form();
	foreach($languages as $key => $lang) {
		echo CHtml::hiddenField($key, $this->getOwner()->createUrl('', array('language' => $key)));
	}
	echo CHtml::dropDownList('language', $currentLang, $languages,
			array(
					'submit' => '',
			)
	);
	echo CHtml::endForm();
?>
</div>