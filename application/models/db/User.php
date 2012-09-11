<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $password
 * @property string $salt
 * @property integer $group_id
 * @property string $email
 * @property string $session_key
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Avatar $avatar
 * @property Referral[] $referrals
 * @property Referral[] $referees
 * @property UploadedFile[] $uploadedFiles
 * @property Group $group
 * @property UserActivated $userActivated
 * @property UserProfile $userProfile
 */

class User extends CActiveRecord implements IUserIdentity {


	
	const ERROR_NONE = 0;
	const ERROR_EMAIL_INVALID = 1;
	const ERROR_PASSWORD_INVALID = 2;
	const ERROR_NOT_ACTIVATED = 3;
	const ERROR_UNKNOWN_IDENTITY = 100;
	
	/**
	 * @var integer the authentication error code. If there is an error, the error code will be non-zero.
	 * Defaults to 100, meaning unknown identity. Calling {@link authenticate} will change this value.
	 */
	public $errorCode = self::ERROR_UNKNOWN_IDENTITY;

	private $_state = array();
	private $_pbkdf2Hasher;
	
	public $password_no_hash = null;
	public $password_no_hash_repeat = null;

	public function init() {
		Yii::import('ext.pbkdf2.PBKDF2');
		if($this->isNewRecord) {
			$this->salt = $this->getHasher()->generateIV();
			$this->session_key = $this->getHasher()->generateIV(false);
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table username
	 */
	public function tableName() {
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('password, salt, session_key, group_id', 'unsafe'),
			array('email, salt, session_key', 'required'),
			array('salt, session_key', 'ext.pbkdf2.PBKDF2validator'),
				
			array('password_no_hash', 'required', 'on' => 'pushedRegister, register, login'),
			array('password_no_hash', 'type', 'allowEmpty' => false, 'on' => 'pushedRegister, register, login'),
				
			array('password_no_hash_repeat', 'required', 'on' => 'register'),
			array('password_no_hash_repeat', 'type', 'allowEmpty' => false, 'on' => 'register'),
			array('password_no_hash_repeat',
					'compare',
					'compareAttribute' => 'password_no_hash',
					'strict' => true,
					'message' => 'Passwords do not match.', 
					'on' => 'register'),
				
			array('password_no_hash', 'hash', 'on' => 'pushedRegister, register'),
				
			array('email', 'length', 'max' => 255),
			array('email', 'email'),
			array('email', 'unique', 'except' => 'login'),
			array('email', 'loadUserAttributesFromEmail', 'on' => 'login'),

			array('password', 'required', 'except' => 'login'),
			array('password', 'ext.pbkdf2.PBKDF2validator', 'except' => 'login'),

			array('group_id', 'determineGroup', 'on' => 'pushedRegister, register'), 
			array('group_id', 'exist', 'attributeName' => 'id', 'className' => 'Group', 'allowEmpty' => false),
			array('group_id', 'required'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'avatar' => array(self::HAS_ONE, 'Avatar', 'user_id'),
            'referees' => array(self::HAS_MANY, 'Referral', 'referee'),
            'referrals' => array(self::HAS_MANY, 'Referral', 'referrer'),
            'uploadedFiles' => array(self::HAS_MANY, 'UploadedFile', 'user_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'userActivated' => array(self::HAS_ONE, 'UserActivated', 'user_id'),
			'userProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
			'userProfileExtended' => array(self::HAS_ONE, 'UserProfileExtended', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
            'id' => Yii::t('onlinecourseportal','ID'),
            'password' => Yii::t('onlinecourseportal','Password'),
            'salt' => Yii::t('onlinecourseportal','Salt'),
            'group_id' => Yii::t('onlinecourseportal','Group ID'),
            'email' => Yii::t('onlinecourseportal','Email'),
            'session_key' => Yii::t('onlinecourseportal','Session Key'),
            'created' => Yii::t('onlinecourseportal','Created'),
			'referees' => Yii::t('onlinecourseportal','Referees'),
			'referrals' => Yii::t('onlinecourseportal','Referrals'),
			'uploadedFiles' => Yii::t('onlinecourseportal','Uploaded Files'),
			'userActivated' => Yii::t('onlinecourseportal','User Activated'),
			'userProfile' => Yii::t('onlinecourseportal','User Profile'),
			'group' => Yii::t('onlinecourseportal','Group'),
			'password_no_hash' => Yii::t('onlinecourseportal','Password'),
			'password_no_hash_repeat' => Yii::t('onlinecourseportal','Repeat Password'),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
	
		$criteria = new CDbCriteria;
	
        $criteria->compare('id', $this->id);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('group_id',$this->group_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('session_key', $this->session_key, true);
        $criteria->compare('created', $this->created, true);
	
		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		));
	}

	/**
	 * Authenticates this user.
	 */
	public function authenticate() {
		if($this->validate()) {
			$record = $this->find('email = :email', array(':email' => $this->email));
			if($record === null)
				$this->errorCode = self::ERROR_EMAIL_INVALID;
			else if($record->password !== $this->password)
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			else if($record->userActivated === null || $record->userActivated->getIsNewRecord())
				$this->errorCode = self::ERROR_NOT_ACTIVATED;
			else
				$this->errorCode = self::ERROR_NONE;
		} else {
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		}
		return $this->errorCode === self::ERROR_NONE;
	}
	
	public function login($remember_me = false, $run_validation = true) {
		if(!$run_validation || $this->validate()) {
			if($remember_me)
				$this->setState('sk', $this->session_key);
			if(Yii::app()->user->login($this, $remember_me ? 3600 * 24 * 7 : 0)) {
				if($this->scenario === 'login')
					$this->setScenario('update');
				return true;
			}
		}
		return false;
	}
	
	public function determineGroup($attribute, $params) {
		$this->group_id = EmployerDomain::model()->exists('name = :name', array(':name' => array_pop(explode('@', $this->email)))) ?
													   Group::model()->find('name = :name', array(':name' => 'employee_user'))->id :
													   Group::model()->find('name = :name', array(':name' => 'paid_user'))->id;
	}
	
	public function loadUserAttributesFromEmail($attribute, $params) {
		$record = $this->find('email = :email', array(':email' => $this->$attribute));
		if($record !== null) {
			$this->getHasher()->iv = $record->salt;
			$this->getHasher()->string = $this->password_no_hash;
		}
		if($record === null || $record->password !== $this->getHasher()->hashed)
			$this->addError('User', 'Incorrect email or password.');
		else if($record->userActivated === null || $record->userActivated->getIsNewRecord())
			$this->addError('User', 'The email and password you have entered are correct, but your account has not yet been activated.');
		else {
			$this->setPrimaryKey($record->getPrimaryKey());
			$this->setIsNewRecord(false);
			$this->refresh();
		}
	}
	
	public function hash($attribute, $params) {
		$this->getHasher()->string = $this->$attribute;
		$this->password = $this->getHasher()->hashed;
	}
	
	/**
	 * Regenerates the session key for this user and saves to database.
	 * @return boolean whether the session key was successfully updated for this user.
	 */
	public function regenerateSessionKey() {
		$this->session_key = $this->getHasher()->generateIV(false);
		return $this->save(true, array('session_key'));
	}
	
	public function getHasher() {
		if($this->_pbkdf2Hasher === null)
			$this->_pbkdf2Hasher = new PBKDF2;
		return $this->_pbkdf2Hasher;
	}
	
	public function getActivationUrl() {
		return Yii::app()->createAbsoluteUrl('user/activate/' . urlencode($this->id) . '/' . str_replace(array('+','/'), array('-','_'), $this->session_key));
	}

	/**
	 * Returns a value that uniquely represents the identity.
	 * @return mixed a value that uniquely represents the identity (e.g. primary key value).
	 * The default implementation simply returns {@link name}.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the display name for the identity (e.g. username).
	 * @return string the display name for the identity.
	 * The default implementation simply returns empty string.
	 */
	public function getName() {
		return $this->email;
	}

	/**
	 * Returns the identity states that should be persisted.
	 * This method is required by {@link IUserIdentity}.
	 * @return array the identity states that should be persisted.
	 */
	public function getPersistentStates() {
		return $this->_state;
	}

	/**
	 * Sets an array of presistent states.
	 *
	 * @param array $states the identity states that should be persisted.
	 */
	public function setPersistentStates($states) {
		$this->_state = $states;
	}

	/**
	 * Returns a value indicating whether the identity is authenticated.
	 * This method is required by {@link IUserIdentity}.
	 * @return whether the authentication is successful.
	 */
	public function getIsAuthenticated() {
		return $this->errorCode === self::ERROR_NONE;
	}

	/**
	 * Gets the persisted state by the specified name.
	 * @param string $name the name of the state
	 * @param mixed $defaultValue the default value to be returned if the named state does not exist
	 * @return mixed the value of the named state
	 */
	public function getState($name, $defaultValue = null) {
		return isset($this->_state[$name]) ? $this->_state[$name] : $defaultValue;
	}

	/**
	 * Sets the named state with a given value.
	 * @param string $name the name of the state
	 * @param mixed $value the value of the named state
	 */
	public function setState($name, $value) {
		$this->_state[$name] = $value;
	}

	/**
	 * Removes the specified state.
	 * @param string $name the name of the state
	 */
	public function clearState($name) {
		unset($this->_state[$name]);
	}
}