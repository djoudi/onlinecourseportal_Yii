<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property string $iso
 * @property string $name
 * @property string $printable_name
 * @property string $iso3
 * @property integer $numcode
 * 
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 */
class Country extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{country}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('iso, name, printable_name', 'required'),
            array('numcode', 'numerical', 'integerOnly' => true),
            array('iso', 'length', 'is' => 2),
            array('name, printable_name', 'length', 'max' => 80),
            array('iso3', 'length', 'is' => 3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('iso, name, printable_name, iso3, numcode', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        		'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'country_iso'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'iso' => Yii::t('onlinecourseportal','ISO'),
            'name' => Yii::t('onlinecourseportal','Name'),
            'printable_name' => Yii::t('onlinecourseportal','Printable Name'),
            'iso3' => Yii::t('onlinecourseportal','ISO-3'),
            'numcode' => Yii::t('onlinecourseportal','Number Code'),
        	'userProfiles' => Yii::t('onlinecourseportal','User Profiles'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria = new CDbCriteria;

        $criteria->compare('iso', $this->iso,true);
        $criteria->compare('name', $this->name,true);
        $criteria->compare('printable_name', $this->printable_name, true);
        $criteria->compare('iso3', $this->iso3, true);
        $criteria->compare('numcode', $this->numcode);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
?>