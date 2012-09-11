<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "key".
 *
 * The followings are the available columns in table 'key':
 * @property integer $id
 * @property string $value
 * @property string $salt
 */
class Key extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Key the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{key}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('value, salt', 'required'),
        	array('value', 'ext.pbkdf2.PBKDF2validator'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('onlinecourseportal','ID'),
            'value' => Yii::t('onlinecourseportal','Value'),
            'salt' => Yii::t('onlinecourseportal','Salt'),
        );
    }

}