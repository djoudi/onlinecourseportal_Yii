<<<<<<< HEAD
<?php if ( ! defined('BASEPATH')) die('No direct script access allowed');
/*
 * LimeSurvey (tm)
 * Copyright (C) 2011 The LimeSurvey Project Team / Carsten Schmitz
 * All rights reserved.
 * License: GNU/GPL License v2 or later, see LICENSE.php
 * LimeSurvey is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 *
 *
 */

class Label extends CActiveRecord
{
    /**
     * Used for some statistical queries
     * @var int
     */
    public $maxsortorder;

	/**
	 * Returns the table's name
	 *
	 * @access public
	 * @return string
	 */
	public function tableName()
	{
		return '{{labels}}';
	}

	/**
	 * Returns the table's primary key
	 *
	 * @access public
	 * @return string
	 */
	public function primaryKey()
	{
		return 'lid';
	}

	/**
	 * Returns the static model of Settings table
	 *
	 * @static
	 * @access public
     * @param string $class
	 * @return CActiveRecord
	 */
	public static function model($class = __CLASS__)
	{
		return parent::model($class);
	}

	function getAllRecords($condition=FALSE)
	{
		if ($condition != FALSE)
        {
		    foreach ($condition as $item => $value)
			{
				$criteria->addCondition($item.'="'.$value.'"');
			}
        }

		$data = $this->findAll($criteria);

        return $data;
	}

    function getLabelCodeInfo($lid)
    {
		return Yii::app()->db->createCommand()->select('code, title, sortorder, language, assessment_value')->order('language, sortorder, code')->where('lid=:lid')->from(tableName())->bindParam(":lid", $lid, PDO::PARAM_INT)->query()->readAll();
    }

	function insertRecords($data)
    {
        $lbls = new self;
		foreach ($data as $k => $v)
			$lbls->$k = $v;
		$lbls->save();
    }

}
=======
<?php if ( ! defined('BASEPATH')) die('No direct script access allowed');
/*
 * LimeSurvey (tm)
 * Copyright (C) 2011 The LimeSurvey Project Team / Carsten Schmitz
 * All rights reserved.
 * License: GNU/GPL License v2 or later, see LICENSE.php
 * LimeSurvey is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 *
 *
 */

class Label extends CActiveRecord
{
    /**
     * Used for some statistical queries
     * @var int
     */
    public $maxsortorder;

	/**
	 * Returns the table's name
	 *
	 * @access public
	 * @return string
	 */
	public function tableName()
	{
		return '{{labels}}';
	}

	/**
	 * Returns the table's primary key
	 *
	 * @access public
	 * @return string
	 */
	public function primaryKey()
	{
		return 'lid';
	}

	/**
	 * Returns the static model of Settings table
	 *
	 * @static
	 * @access public
     * @param string $class
	 * @return CActiveRecord
	 */
	public static function model($class = __CLASS__)
	{
		return parent::model($class);
	}

	function getAllRecords($condition=FALSE)
	{
		if ($condition != FALSE)
        {
		    foreach ($condition as $item => $value)
			{
				$criteria->addCondition($item.'="'.$value.'"');
			}
        }

		$data = $this->findAll($criteria);

        return $data;
	}

    function getLabelCodeInfo($lid)
    {
		return Yii::app()->db->createCommand()->select('code, title, sortorder, language, assessment_value')->order('language, sortorder, code')->where('lid=:lid')->from(tableName())->bindParam(":lid", $lid, PDO::PARAM_INT)->query()->readAll();
    }

	function insertRecords($data)
    {
        $lbls = new self;
		foreach ($data as $k => $v)
			$lbls->$k = $v;
		$lbls->save();
    }

}
>>>>>>> refs/remotes/origin/master
