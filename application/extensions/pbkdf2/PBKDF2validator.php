<?php

class PBKDF2Validator extends CValidator {
	
	/**
	 * @var boolean whether the attribute requires a base 64 encoded value.
	 * Defaults to false, meaning a value is required.
	 */
	public $allowEmpty = false;
	/**
	 * @var boolean whether attributes listed with this validator should be considered safe for massive assignment.
	 * For this validator it defaults to false.
	 */
	public $safe = false;

	protected function validateAttribute($object, $attribute) {
		if(!is_string($object->$attribute)) {
			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} must be a string.');
			$this->addError($object, $attribute, $message);
			return false;
		}
		if(empty($object->$attribute) && !$this->allowEmpty) {
			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} cannot be blank.');
			$this->addError($object, $attribute, $message);
			return false;
		}
		if(!preg_match('/^(?:[A-Za-z0-9+\/]{4}){10}(?:[A-Za-z0-9+\/]{3}=)$/', $object->$attribute)) {
			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} is not a base64 encoded string.');
			$this->addError($object, $attribute, $message);
			return false;
		}
		return true;
	}

}

?>