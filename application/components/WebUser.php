<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebUser extends CWebUser {

	private $_model;
	
	public function getModel($id = null) {
		if($id === null)
			$id = $this->getId();
		if($this->_model === null && $id !== null)
			$this->_model = User::model()->findByPk($id);
		return $this->_model;
	}
	
	public function getIsAdmin() {
		return $this->getModel() !== null && $this->getModel()->group->name === 'admin';
	}

	protected function beforeLogin($id, $states, $fromCookie) {
		$user = $this->getModel($id);
		if($user !== null) {
			if($fromCookie) {
				if(isset($states['sk']) && $user->session_key === $states['sk'])
					return parent::beforeLogin($id, $states, $fromCookie);
			} else {
				return parent::beforeLogin($id, $states, $fromCookie);
			}
		}
		return false;
	}

	protected function beforeLogout() {
		$user = $this->getModel($this->getId());
		if($user !== null)
			$user->regenerateSessionKey();
		return parent::beforeLogout();
	}

}
?>