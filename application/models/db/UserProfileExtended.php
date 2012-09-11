<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "user_profile_extended".
 *
 * The followings are the available columns in table 'user_profile_extended':
 * @property integer $employment_status_id
 * @property integer $age_group_id
 * @property integer $caregiver
 * @property string $caregiver_title
 * @property integer $caring_at_home
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property AgeGroup $ageGroup
 * @property EmploymentStatus $employmentStatus
 * @property User $user
 */
class UserProfileExtended extends CActiveRecord {
	
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserProfileExtended the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_profile_extended}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('employment_status_id, 
            		age_group_id, 
            		caregiver, 
            		caregiver_title, 
            		caring_at_home, 
            		user_id', 
            		'required'),
            array('employment_status_id, 
            		age_group_id,
            		user_id', 
            		'numerical', 
            		'integerOnly' => true),
            array('caregiver_title', 'length', 'max' => 255),
        	array('caregiver, caring_at_home', 'boolean'),
        	array('user_id', 'unsafe'),
        	array('employment_status_id', 'exist', 'attributeName' => 'id', 'className' => 'EmploymentStatus'),
        	array('age_group_id', 'exist', 'attributeName' => 'id', 'className' => 'AgeGroup'),
        	array('user_id', 'exist', 'attributeName' => 'id', 'className' => 'User', 'allowEmpty' => false),
            array('employment_status_id, age_group_id, caregiver, caregiver_title, caring_at_home, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ageGroup' => array(self::BELONGS_TO, 'AgeGroup', 'age_group_id'),
            'employmentStatus' => array(self::BELONGS_TO, 'EmploymentStatus', 'employment_status_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'employment_status_id' => Yii::t('onlinecourseportal','Employment Status'),
            'age_group_id' => Yii::t('onlinecourseportal','Age Group'),
            'caregiver' => Yii::t('onlinecourseportal','Caregiver'),
            'caregiver_title' => Yii::t('onlinecourseportal','Caregiver Title'),
            'caring_at_home' => Yii::t('onlinecourseportal','Caring At Home'),
            'user_id' => Yii::t('onlinecourseportal','User ID'),
        	'ageGroup' => Yii::t('onlinecourseportal','Age Group'),
        	'employmentStatus' => Yii::t('onlinecourseportal','Employment Status'),
        	'user' => Yii::t('onlinecourseportal','User'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria=new CDbCriteria;

        $criteria->compare('employment_status_id',$this->employment_status_id);
        $criteria->compare('age_group_id',$this->age_group_id);
        $criteria->compare('caregiver',$this->caregiver);
        $criteria->compare('caregiver_title',$this->caregiver_title,true);
        $criteria->compare('caring_at_home',$this->caring_at_home);
        $criteria->compare('user_id',$this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}