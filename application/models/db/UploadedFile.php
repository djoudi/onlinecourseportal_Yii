<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "uploaded_file".
 *
 * The followings are the available columns in table 'uploaded_file':
 * @property integer $id
 * @property integer $user_id
 * @property string $created
 * @property integer $size
 * @property string $mime_type
 * @property string $local_name
 * @property string $name
 * @property file $file
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UploadedFile extends CActiveRecord {
	
	const FILES_PATH_ALIAS = 'uploads.files';
	const MAX_FILE_SIZE = 17179869184;

	public $file = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{uploaded_file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
				array('user_id, created, name, size, mime_type', 'required'),
				array('file', 'required', 'on' => 'insert'),
				array('file', 'checkFileMakeLocal', 'on' => 'insert'),
				array('size', 'numerical', 'integerOnly' => true),
				array('name, mime_type', 'length', 'max' => 255),
				array('local_name', 'length', 'is' => 40),
				array('local_name', 'match', 'pattern' => '/[\da-fA-F]{1,4}/'),
				array('local_name', 'unique'),
				array('user_id, local_name, size, name', 'unsafe'),
				array('user_id', 'exist', 'attributeName' => 'id', 'className' => 'User', 'allowEmpty' => false),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
				'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name => label)
	 */
	public function attributeLabels() {
		return array(
				'id' => Yii::t('onlinecourseportal','ID'),
				'user_id' => Yii::t('onlinecourseportal','User ID'),
				'created' => Yii::t('onlinecourseportal','Created'),
				'name' => Yii::t('onlinecourseportal','Name'),
				'size' => Yii::t('onlinecourseportal','Size'),
				'mime_type' => Yii::t('onlinecourseportal','MIME Type'),
				'local_name' => Yii::t('onlinecourseportal','Local Name'),
				'user' => Yii::t('onlinecourseportal','User')
		);
	}
	
	public function getPath() {
		return Yii::getPathOfAlias(self::FILES_PATH_ALIAS) . DIRECTORY_SEPARATOR . $this->local_name;
	}
	
	public function checkFileMakeLocal($attribute, $params) {
		Yii::import('CFileValidator', true);
		$this->$attribute = CUploadedFile::getInstance($this, $attribute);
		if($this->$attribute !== null) {
			$validator = new CFileValidator();
			$validator->attributes = array($attribute);
			$validator->allowEmpty = false;
			$validator->maxFiles = 1;
			$validator->maxSize = self::MAX_FILE_SIZE;
			$validator->tooLarge = 'The file is too large. 16MB maximum.';
			$validator->tooMany = 'Only 1 file may be uploaded at a time';
			$validator->validate($this, $attribute);
				
			if(!$this->hasErrors() && $this->$attribute !== null) {
				$this->mime_type = $this->$attribute->getType();
				$this->size = $this->$attribute->getSize();
				$this->name = $this->$attribute->getName();
					
				do {
					$this->local_name = sha1(uniqid('', true));
				} while(self::model()->exists('local_name = :local_name', array(':local_name' => $this->local_name)));
			}
		} else {
			$this->addError($attribute, 'Not a valid uploaded file');
		}
	}
	
	protected function afterSave() {
		if(!file_exists($this->getPath()) && $file !== null)
			$this->file->saveAs($this->getPath());
		parent::afterSave();
	}
	
	protected function afterDelete() {
		if(file_exists($this->getPath()))
			unlink($this->getPath());
		parent::afterDelete();
	}

}