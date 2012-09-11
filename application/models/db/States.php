<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "states".
 *
 * The followings are the available columns in table 'states':
 * @property integer $id
 * @property string $name
 * @property string $abbrev
 * 
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 */
class States extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return States the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{states}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name, abbrev', 'required'),
            array('name', 'length', 'max' => 40),
            array('abbrev', 'length', 'is' => 2),
            array('id, name, abbrev', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        		'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'state_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('onlinecourseportal','ID'),
            'name' => Yii::t('onlinecourseportal','Name'),
            'abbrev' => Yii::t('onlinecourseportal','Abbreviation'),
        	'userProfiles' => Yii::t('onlinecourseportal','User Profiles'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('abbrev', $this->abbrev, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
?>