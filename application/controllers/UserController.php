<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends OnlineCoursePortalController {

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
				array('filters.HttpsFilter'),
				'verifyKey + create',
				'accessControl + profile',
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
	
	public function filterVerifyKey($filterChain) {
		if(isset($_GET['key_id']) && isset($_GET['key'])) {
			$_GET['key'] = str_replace(array('-','_'), array('+','/'), $_GET['key']);
			$key = Key::model()->findByPk($_GET['key_id']);
			if($key !== null) {
				$this->loadExtension('pbkdf2');
				$hasher = new PBKDF2($_GET['key'], $key->salt);
				if($hasher->hashed === $key->value) {
					$filterChain->run();	
					return;
				}
			}
		}
		throw new CHttpException(401,'Not authorized.');
	}
	
	public function actionCreate() {
		$this->loadHelper('Json');
		$models = array(
					'user' => new User('pushedRegister'),
					'user_profile' => new UserProfile,
					'avatar' => new Avatar,
				);
		$models['user']->attributes = $_POST;
		$models['user_profile']->attributes = $_POST;
		$models['avatar']->attributes = $_POST;

		if($models['user']->validate()) {
			$transaction = Yii::app()->db->beginTransaction();
			try {
				if($models['user']->save(false)) {
					$models['user_profile']->user_id = $models['user']->id;
					$models['avatar']->user_id = $models['user']->id;
					if($models['user_profile']->save() &&
							$models['avatar']->validate(array('image')) &&
							($models['avatar']->image === null || $models['avatar']->save())) {
						$transaction->commit();
						$this->_sendResponse(200, array('confirmationUrl' => $models['user']->getActivationUrl()));
						Yii::app()->end();
					}
				}
			} catch(Exception $e) {
				if(!$models['avatar']->getIsNewRecord())
					$models['avatar']->delete();
				$transaction->rollback();
				throw $e;
			}
			if(!$models['avatar']->getIsNewRecord())
				$models['avatar']->delete();
			$transaction->rollback();
		}
		$errors = array();
		foreach($models as $model)
			if($model->hasErrors())
				$errors[] = $model->getErrors();
		$this->_sendResponse(400, $errors);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$user = new User('login');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User'])) {
			$user->attributes = $_POST['User'];
			// validate user input and redirect to the previous page if valid
			if($user->login(isset($_POST['remember_me']))) {
				Yii::app()->user->setFlash('success', 'Welcome ' . Yii::app()->user->name . '!');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('pages/login', array('model' => $user));
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister() {
		$models = array(
					'user' => new User('register'),
					'user_profile' => new UserProfile,
					'user_profile_extended' => new UserProfileExtended,
					'avatar' => new Avatar,
					'captcha' => new Captcha
				);
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
			echo CActiveForm::validate($models);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']) && 
				isset($_POST['UserProfile']) && 
				isset($_POST['Avatar']) && 
				isset($_POST['Captcha']) && 
				isset($_POST['UserProfileExtended'])) {
			$models['user']->attributes = $_POST['User'];
			$models['user_profile']->attributes = $_POST['UserProfile'];
			$models['user_profile_extended']->attributes = $_POST['UserProfileExtended'];
			$models['avatar']->attributes = $_POST['Avatar'];
			$models['captcha']->attributes = $_POST['Captcha'];
			if($models['captcha']->validate() && $models['user']->validate()) {
				$transaction = Yii::app()->db->beginTransaction();
				try {
					if($models['user']->save(false)) {
						$models['user_profile']->user_id = $models['user']->id;
						$models['user_profile_extended']->user_id = $models['user']->id;
						$models['avatar']->user_id = $models['user']->id;
						if($models['user_profile']->save() && 
								$models['user_profile_extended']->save() &&
								$models['avatar']->validate(array('image')) && 
								($models['avatar']->image === null || $models['avatar']->save())) {
							$transaction->commit();
							$message = new YiiMailMessage;
							$message->view = 'registrationConfirmation';
							$message->setBody(array('user' => $models['user']), 'text/html');
							$message->addTo($models['user']->email);
							$message->from = Yii::app()->params['noReplyEmail'];
							Yii::app()->mail->send($message);
							$this->render('registerConfSent');
							Yii::app()->end();
						}
					}
				} catch(Exception $e) {
					if(!$models['avatar']->getIsNewRecord())
						$models['avatar']->delete();
					$transaction->rollback();
					throw $e;
				}
				if(!$models['avatar']->getIsNewRecord())
					$models['avatar']->delete();
				$transaction->rollback();
			}
		}
		// display the register form
		$this->render('pages/register', array('models' => $models));
	}

	public function actionActivate($id, $session_key) {
		$user = User::model()->findByPk($id);
		$session_key = str_replace(array('-', '_'), array('+', '/'), $session_key);
		if($user->session_key === $session_key) {
			$user->userActivated = new UserActivated;
			$user->userActivated->user_id = $user->id;
			if($user->userActivated->save() && $user->login(false, false)) {
				$user->regenerateSessionKey();
				Yii::app()->user->setFlash('success', 'Your account has been activated. Welcome ' . Yii::app()->user->name . '!');
				$this->redirect(Yii::app()->homeUrl);
			}
		}
		$this->render('pages/activationFailure');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		Yii::app()->user->setFlash('success', 'You have been logged out.');
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionProfile() {
		$models = array(
				'user' => Yii::app()->user->model,
				'user_profile' => Yii::app()->user->model->userProfile === null ? 
										new UserProfile : Yii::app()->user->model->userProfile,
				'user_profile_extended' => Yii::app()->user->model->userProfileExtended === null ? 
												new UserProfileExtended : Yii::app()->user->model->userProfileExtended,
				'avatar' => Yii::app()->user->model->avatar === null ? 
								new Avatar : Yii::app()->user->model->avatar
			);
		$models['user_profile']->user_id = $models['user']->id;
		$models['user_profile_extended']->user_id = $models['user']->id;
		$models['avatar']->user_id = $models['user']->id;
		
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
			echo CActiveForm::validate($models);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']) && 
				isset($_POST['UserProfile']) && 
				isset($_POST['Avatar']) && 
				isset($_POST['UserProfileExtended'])) {
			$models['user']->attributes = $_POST['User'];
			$models['user_profile']->attributes = $_POST['UserProfile'];
			$models['user_profile_extended']->attributes = $_POST['UserProfileExtended'];
			$models['avatar']->attributes = $_POST['Avatar'];
			$transaction = Yii::app()->db->beginTransaction();
			try {
				if($models['user']->save() && 
						$models['user_profile']->save() && 
						$models['user_profile_extended']->save() &&
						$models['avatar']->validate(array('image')) && 
						($models['avatar']->image === null || $models['avatar']->save())) {
					$transaction->commit();
				}
			} catch(Exception $e) {
				if(!$models['avatar']->getIsNewRecord())
					$models['avatar']->delete();
				$transaction->rollback();
				throw $e;
			}
		}
		$this->render('pages/profile', array('models' => $models));
	}
	
}