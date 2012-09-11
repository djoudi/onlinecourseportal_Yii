<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Implements global registry and config
*/
class OnlineCoursePortalApplication extends CWebApplication {
	
    protected $config = array();
    protected $registry = array();

    /**
    * Initiates the application
    *
    * @access public
    * @param array $config
    * @return void
    */
    public function __construct($config = null) {
        parent::__construct($config);
    }
    
    protected function preinit() {
    	Yii::setPathOfAlias('modules', APPPATH . 'modules');
    	Yii::setPathOfAlias('helpers', APPPATH . 'helpers');
    	Yii::setPathOfAlias('filters', APPPATH . 'filters');
    	Yii::setPathOfAlias('uploads', APPPATH . 'uploads');
    	parent::preinit();
    }
    
    protected function init() {
<<<<<<< HEAD
    	// Check for most necessary requirements
    	// Now check for PHP & db version
    	// Do not localize/translate this!
    	
    	if (ini_get('max_execution_time') < 1200)
    		@set_time_limit(1200); // Maximum execution time - works only if safe_mode is off
    	
    	// Deal with server systems having not set a default time zone
    	if(function_exists('date_default_timezone_set') and function_exists('date_default_timezone_get'))
    		@date_default_timezone_set(@date_default_timezone_get());
    	
    	//SET LOCAL TIME
    	$timeadjust = $this->getConfig('timeadjust');
    	if (substr($timeadjust, 0, 1) != '-' && substr($timeadjust, 0, 1) != '+') {
    		$timeadjust = "+$timeadjust";
    	}
    	if (strpos($timeadjust, 'hours') === false && strpos($timeadjust, 'minutes') === false && strpos($timeadjust, 'days') === false) {
    		$this->setConfig('timeadjust', "$timeadjust hours");
    	}
    }
    
    /**
     * Creates the controller and performs the specified action.
     * @param string $route the route of the current request. See {@link createController} for more details.
     * @throws CHttpException if the controller could not be created.
     */
    public function runController($route)
    {
    	// Configure language settings
    	
    	// If there is a post-request, redirect the application to the provided url of the selected language
    	if(isset($_POST['language'])) {
    		Yii::app()->getRequest()->redirect($this->createUrl($route, array('language' => $_POST['language'])));
    	}
    	
    	$language = Yii::app()->sourceLanguage;
    	// Set the application language if provided by GET, session or cookie
    	if(isset($_GET['language'])) {
    		$language = $_GET['language'];
    		unset($_GET['language']);
    		Yii::app()->user->setState('language', $language);
    		$cookie = new CHttpCookie('language', $language);
    		$cookie->expire = time() + (60 * 60 * 24 * 365 * 2); // (2 year)
    		Yii::app()->request->cookies['language'] = $cookie;
    	} else if (Yii::app()->user->hasState('language')) {
    		$language = Yii::app()->user->getState('language');
    		if(!isset(Yii::app()->request->cookies['language'])) {
    			$cookie = new CHttpCookie('language', $language);
    			$cookie->expire = time() + (60 * 60 * 24 * 365 * 2); // (2 year)
    			Yii::app()->request->cookies['language'] = $cookie;
    		}
    	} else if(isset(Yii::app()->request->cookies['language'])) {
    		$language = Yii::app()->request->cookies['language']->value;
    		if(!Yii::app()->user->hasState('language')) {
    			Yii::app()->user->setState('language', $language);
    		}
    	} else {
    		Yii::app()->getRequest()->redirect($this->createUrl('', array('language' => Yii::app()->getRequest()->getPreferredLanguage())));
    	}

    	$acceptedLanguages = Yii::app()->localeManager->getLanguages();
    	if(!isset($acceptedLanguages[$language])) {
    		Yii::app()->user->setState('language', Yii::app()->sourceLanguage);
    		$cookie = new CHttpCookie('language', Yii::app()->sourceLanguage);
    		$cookie->expire = time() + (60 * 60 * 24 * 365 * 2); // (2 year)
    		Yii::app()->request->cookies['language'] = $cookie;
    		Yii::app()->getRequest()->redirect($this->createUrl('', array('language' => Yii::app()->sourceLanguage)));
    	}
    	
    	Yii::app()->language = $language;
    	Yii::app()->translate->acceptedLanguages = $acceptedLanguages;
    	setLocale(LC_ALL, $language . '.UTF-8');
    	$this->name = Yii::t('onlinecourseportal', $this->name);
		parent::runController($route);
=======
    	Yii::app()->translate->acceptedLanguages = Yii::app()->localeManager->getLanguages();
    	$this->name = Yii::t('onlinecourseportal', $this->name);
    	parent::init();
>>>>>>> refs/remotes/origin/master
    }

    /**
    * Loads a helper
    *
    * @access public
    * @param string $helper
    * @return void
    */
    public function loadHelper($helper) {
        Yii::import("helpers.$helper", true);
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
    * Sets a configuration variable into the registry
    *
    * @access public
    * @param string $name
    * @param mixed $value
    * @return void
    */
    public function setConfig($name, $value) {
        $this->config[$name] = $value;
    }

    /**
    * Loads a config from a file
    *
    * @access public
    * @param string $file
    * @return void
    */
    public function loadConfig($file) {
        $config = require_once(CONFIGPATH . $file . EXT);
        if(is_array($config)) {
            foreach ($config as $k => $v)
                $this->setConfig($k, $v);
        }
    }

    /**
    * Returns a config variable from the registry
    *
    * @access public
    * @param string $name
    * @return mixed
    */
    public function getConfig($name) {
        return isset($this->config[$name]) ? $this->config[$name] : false;
    }

    /**
    * Sets a configuration variable into the registry
    *
    * @access public
    * @param string $name
    * @param mixed $value
    * @return void
    */
    public function setRegistry($name, $value) {
        $this->registry[$name] = $value;
    }

    /**
    * Returns a config variable from the registry
    *
    * @access public
    * @param string $name
    * @return mixed
    */
    public function getRegistry($name) {
        return isset($this->registry[$name]) ? $this->registry[$name] : false;
    }
}
