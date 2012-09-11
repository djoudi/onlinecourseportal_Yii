<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class OnlineCoursePortalController extends CController {
	
	public $viewActionClass = 'ViewAction';
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = null;
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	
	/**
	 * Basic initialiser to the base controller class
	 *
	 * @access public
	 * @param string $id
	 * @param CWebModule $module
	 * @return void
	 */
	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
        Yii::app()->session->init();
		$this->_init();
	}
	
	/**
	 * Creates the action instance based on the action map.
	 * This method will check to see if the action ID appears in the given
	 * action map. If so, the corresponding configuration will be used to
	 * create the action instance.
	 * @param array $actionMap the action map
	 * @param string $actionID the action ID that has its prefix stripped off
	 * @param string $requestActionID the originally requested action ID
	 * @param array $config the action configuration that should be applied on top of the configuration specified in the map
	 * @return CAction the action instance, null if the action does not exist.
	 */
	protected function createActionFromMap($actionMap, $actionID, $requestActionID, $config = array()) {
		$action = parent::createActionFromMap($actionMap, $actionID, $requestActionID, $config);
		if($action === null) {
			$action = Yii::createComponent($this->viewActionClass, $this, $actionID);
		}
		return $action;
	}

	/**
	 * Loads a helper
	 *
	 * @access public
	 * @param string $helper
	 * @return void
	 */
	public function loadHelper($helper) {
		Yii::app()->loadHelper($helper);
	}

    /**
    * Loads an extension
    *
    * @access public
    * @param string $extension
    * @param string $className
    * @return void
    */
    public function loadExtension($extension, $className = '*') {
        Yii::import("ext.$extension.$className", true);
    }
    
    /**
     * Helper function for building CDbCriteria
     *
     * @param string $attribute
     * @param array $values
     * @param string $symbol
     * @param string $operator
     * @access protected
     * @return CDbCriteria
     */
    protected function _criteriaBuilder($attribute, $values, $symbol = '=', $operator = 'AND') {
    	$criteria = new CDbCriteria;
    	if(is_array($values)) {
    		$condition = array();
    		foreach($values as $value)
    			if(is_array($value))
    			$condition[] = "$attribute $symbol {$value[$attribute]}";
    		else
    			$condition[] = "$attribute $symbol $value";
    		$criteria->addCondition($condition, $operator);
    	} else {
    		$criteria->addCondition("$attribute $symbol $values", $operator);
    	}
    	return $criteria;
    }

	protected function _init() {
<<<<<<< HEAD

=======
		// Check for most necessary requirements
		// Now check for PHP & db version
		// Do not localize/translate this!

   		if (ini_get('max_execution_time') < 1200) 
   			@set_time_limit(1200); // Maximum execution time - works only if safe_mode is off

		// Deal with server systems having not set a default time zone
		if(function_exists('date_default_timezone_set') and function_exists('date_default_timezone_get'))
			@date_default_timezone_set(@date_default_timezone_get());

		//SET LOCAL TIME
		$timeadjust = Yii::app()->getConfig('timeadjust');
		if (substr($timeadjust, 0, 1) != '-' && substr($timeadjust, 0, 1) != '+') {
			$timeadjust = "+$timeadjust";
		}
		if (strpos($timeadjust, 'hours') === false && strpos($timeadjust, 'minutes') === false && strpos($timeadjust, 'days') === false) {
			Yii::app()->setConfig('timeadjust', "$timeadjust hours");
		}
>>>>>>> refs/remotes/origin/master

	}
}
