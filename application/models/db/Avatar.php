<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is the model class for table "avatar".
 *
 * The followings are the available columns in table 'avatar':
 * @property integer $id
 * @property string $mime_type
 * @property integer $size
 * @property string $name
 */
class Avatar extends CActiveRecord {

	const DEFAULT_MIME = 'image/png';
	const DEFAULT_NAME = 'default.png';
	const AVATARS_PATH_ALIAS = 'uploads.avatars';
	const MAX_WIDTH = 128;
	const MAX_HEIGHT = 128;
	const MAX_FILE_SIZE = 1048576;
	const ALLOWED_TYPES = 'jpeg, jpe, jpg, gif, png';

	public $image = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function init() {
		Yii::app()->loadHelper('SimpleImage');
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{avatar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
				array('image', 'checkFileMakeSimpleImage'),
				array('user_id, mime_type, size, name', 'required'),
				array('user_id, mime_type, size, name', 'unsafe'),
				array('size', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => self::MAX_FILE_SIZE),
				array('user_id', 'exist', 'attributeName' => 'id', 'className' => 'User', 'allowEmpty' => false),
				array('mime_type', 'length', 'max' => 10),
				array('name', 'length', 'is' => 40),
				array('name', 'match', 'pattern' => '/[\da-fA-F]{1,4}/'),
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
	
	public static function getDefaultPath() {
		return Yii::getPathOfAlias(self::AVATARS_PATH_ALIAS) . DIRECTORY_SEPARATOR . self::DEFAULT_NAME;
	}
	
	public function getPath() {
		if($this->getIsNewRecord())
			return self::getDefaultPath();
		return Yii::getPathOfAlias(self::AVATARS_PATH_ALIAS) . DIRECTORY_SEPARATOR . $this->name;
	}
	
	public function getSimpleImage() {
		if($this->image === null)
			$this->image = file_exists($this->getPath()) ? new SimpleImage($this->getPath()) : null;
			
		return $this->image;
	}

	/**
	 * @return array customized attribute labels (name => label)
	 */
	public function attributeLabels() {
		return array(
				'user_id' => Yii::t('onlinecourseportal','User ID'),
				'mime_type' => Yii::t('onlinecourseportal','MIME Type'),
				'size' => Yii::t('onlinecourseportal','Size'),
				'name' => Yii::t('onlinecourseportal','Name'),
				'image' => Yii::t('onlinecourseportal','Avatar'),
				'user' => Yii::t('onlinecourseportal','User'),
		);
	}
	
	public function checkFileMakeSimpleImage($attribute, $params) {
		if(!$this->$attribute instanceof SimpleImage) {
			Yii::import('CFileValidator', true);
			$this->$attribute = CUploadedFile::getInstance($this, $attribute);
			if($this->$attribute !== null) {
				$validator = new CFileValidator();
				$validator->attributes = array($attribute);
				$validator->allowEmpty = false;
				$validator->maxFiles = 1;
				$validator->maxSize = self::MAX_FILE_SIZE;
				$validator->types = self::ALLOWED_TYPES;
				$validator->tooLarge = 'The image is too large. 1MB maximum.';
				$validator->tooMany = 'Only 1 image may be uploaded at a time';
				$validator->wrongType = 'File type is not allowed. jpeg, gif, or png type image only.';
				$validator->validate($this, $attribute);
					
				if(!$this->hasErrors() && $this->$attribute !== null) {
					$this->mime_type = $this->$attribute->getType();
					$this->size = $this->$attribute->getSize();
					$this->$attribute = new SimpleImage($this->$attribute->getTempName());
					if($this->$attribute->getWidth() > self::MAX_WIDTH) {
						if($this->$attribute->getHeight() > self::MAX_HEIGHT)
							$this->$attribute->resize(self::MAX_WIDTH, self::MAX_HEIGHT);
						else
							$this->$attribute->resizeToWidth(self::MAX_WIDTH);
					} else if($this->$attribute->getHeight() > self::MAX_HEIGHT)
						$this->$attribute->resizeToHeight(self::MAX_HEIGHT);
			
					do {
						$this->name = sha1(uniqid('', true));
					} while(self::model()->exists('name = :name', array(':name' => $this->name)));
				}
			}
		}
	}

	protected function afterSave() {
		if(!file_exists($this->getPath()) || $this->image instanceof SimpleImage)
			$this->image->save($this->getPath());
		parent::afterSave();
	}

	protected function afterDelete() {
		if(file_exists($this->getPath()))
			unlink($this->getPath());
		parent::afterDelete();
	}

}