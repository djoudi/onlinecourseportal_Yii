<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminController extends OnlineCoursePortalController {
	
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
						'expression' => '$user->isAdmin',
				),
				array('deny',
						'users' => array('*'),
				),
		);
	}

}