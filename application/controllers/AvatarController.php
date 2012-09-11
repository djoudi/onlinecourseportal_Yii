<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AvatarController extends OnlineCoursePortalController {

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
				array('filters.HttpsFilter'),
				'accessControl',
		);
	}
	
	public function accessRules() {
		return array(
				array('allow',
						'users' => array('@'),
				),
				array('deny',
						'users' => array('*'),
				),
		);
	}
	
	public function actionAdd() {
		
	}
	
	public function actionView($id) {
		$this->loadExtension('HTTP_Download');
		$avatar = Yii::app()->user->model->avatar;
		if($avatar !== null) {
			HTTP_Download::staticSend(array(
					'file'               => $avatar->getPath(),
					'contenttype'		 => $avatar->mime_type,
					'contentdisposition' => array(HTTP_DOWNLOAD_ATTACHMENT, $avatar->name),
			), false);
		} else {
			HTTP_Download::staticSend(array(
					'file'               => Avatar::getDefaultPath(),
					'contenttype'		 => Avatar::DEFAULT_MIME,
					'contentdisposition' => array(HTTP_DOWNLOAD_ATTACHMENT, Avatar::DEFAULT_NAME),
			), false);
		}
	}
	
}