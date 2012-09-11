<?php
class LanguageSelector extends CWidget {
	
    public function run() {
        $currentLang = Yii::app()->language;
        $this->render('application.components.widgets.views.languageSelector', 
        		array('currentLang' => $currentLang, 'languages' => Yii::app()->translate->acceptedLanguages));
    }
    
}
?>