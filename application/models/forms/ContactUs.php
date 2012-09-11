<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ContactUs class.
 * ContactUs is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactUs extends CFormModel {

	public $name;
	public $email;
	public $subject;
	public $body;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
				array('name, email, subject, body', 'required'),
				array('name', 'length', 'max' => 256),
				array('email', 'email'),
				array('subject', 'length', 'max' => 256),
				array('body', 'length', 'max' => 4096),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
				'name' => Yii::t('onlinecourseportal','Name'),
				'email' => Yii::t('onlinecourseportal','Email'),
				'subject' => Yii::t('onlinecourseportal','Subject'),
				'body' => Yii::t('onlinecourseportal','Body'),
		);
	}

}