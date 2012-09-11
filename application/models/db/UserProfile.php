<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $city
 * @property string $zip_code
 * @property integer $state_id
 * @property string $country_iso
 * @property integer $employment_status_id
 * @property integer $age_group_id
 * @property integer $caregiver
 * @property string $caregiver_title
 * @property integer $caring_at_home
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Country $country
 * @property States $state
 * 
 */
class UserProfile extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_profile}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('user_id, 
            		firstname, 
            		lastname, 
            		state_id, 
            		country_iso',
            		'required'),
        	
            array('firstname, lastname, city', 'length', 'max' => 255),
        		
			array('zip_code', 'filter', 'filter' => array($this, 'cleanNonNumeric')),
			array('zip_code', 'numerical', 'integerOnly' => true),
            array('zip_code', 'length', 'max' => 10),
        		
        	array('state_id', 'exist', 'attributeName' => 'id', 'className' => 'States', 'allowEmpty' => false),
        	array('country_iso', 'exist', 'attributeName' => 'iso', 'className' => 'Country', 'allowEmpty' => false),
        	array('user_id', 'exist', 'attributeName' => 'id', 'className' => 'User', 'allowEmpty' => false),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        	'country' => array(self::BELONGS_TO, 'Country', 'country_isp'),
        	'state' => array(self::BELONGS_TO, 'State', 'state_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => Yii::t('onlinecourseportal','User ID'),
            'firstname' => Yii::t('onlinecourseportal','First Name'),
            'lastname' => Yii::t('onlinecourseportal','Last Name'),
            'city' => Yii::t('onlinecourseportal','City'),
            'zip_code' => Yii::t('onlinecourseportal','Zip Code'),
            'state_id' => Yii::t('onlinecourseportal','State'),
            'country_iso' => Yii::t('onlinecourseportal','Country'),
        	'country' => Yii::t('onlinecourseportal','Country'),
        	'state' => Yii::t('onlinecourseportal','State')
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('firstname', $this->firstname,true);
        $criteria->compare('lastname', $this->lastname,true);
        $criteria->compare('city', $this->city,true);
        $criteria->compare('zip_code', $this->zip_code,true);
        $criteria->compare('state_id', $this->state,true);
        $criteria->compare('country_iso', $this->country,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function cleanNonNumeric($value) {
    	return preg_replace('/\D/', '', trim($value));
    }
    
}

?>