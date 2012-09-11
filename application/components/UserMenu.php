<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet {

	public function init() {
		$this->title = CHtml::encode(Yii::app()->user->name);
		parent::init();
	}

	protected function renderContent() {
		$this->render('userMenu');
	}

}