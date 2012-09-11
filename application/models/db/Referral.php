<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the model class for table "referral".
 *
 * The followings are the available columns in table 'referral':
 * @property integer $id
 * @property integer $referrer
 * @property integer $referee
 *
 * The followings are the available model relations:
 * @property User $referee0
 * @property User $referrer0
 */
class Referral extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Referral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{referral}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, referrer, referee', 'required'),
			array('id, referrer, referee', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, referrer, referee', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'referee0' => array(self::BELONGS_TO, 'User', 'referee'),
			'referrer0' => array(self::BELONGS_TO, 'User', 'referrer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('onlinecourseportal','ID'),
			'referrer' => Yii::t('onlinecourseportal','Referrer'),
			'referee' => Yii::t('onlinecourseportal','Referee'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('referrer',$this->referrer);
		$criteria->compare('referee',$this->referee);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}