<?php

/*
 *---------------------------------------------------------------
* SYSTEM FOLDER NAME
*---------------------------------------------------------------
*
* This variable must contain the name of your "Yii system" folder.
* Include the path if the folder is not in the same directory
* as this file.
*
*/
$system_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'framework';

/*
 *---------------------------------------------------------------
* APPLICATION FOLDER NAME
*---------------------------------------------------------------
*
* If you want this front controller to use a different "application"
* folder then the default one you can set its name here.
*
* NO TRAILING SLASH!
*
*/
$application_folder = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application';

/*
 * --------------------------------------------------------------------
* DEFAULT CONTROLLER
* --------------------------------------------------------------------
*
* Normally you will set your default controller in the routes.php file.
* You can, however, force a custom routing by hard-coding a
* specific controller class/function here.  For most applications, you
* WILL NOT set your routing here, but it's an option for those
* special instances where you might want to override the standard
* routing in a specific front controller that shares a common CI installation.
*
* IMPORTANT:  If you set the routing here, NO OTHER controller will be
* callable. In essence, this preference limits your application to ONE
* specific controller.  Leave the function name blank if you need
* to call functions dynamically via the URI.
*
* Un-comment the $routing array below to use this feature
*
*/
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';

// The controller class file name.  Example:  Mycontroller.php
// $routing['controller'] = '';

// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
*  CUSTOM CONFIG VALUES
* -------------------------------------------------------------------
*
* The $assign_to_config array below will be passed dynamically to the
* config class when initialized. This allows you to set custom config
* items or override any default config values found in the config.php file.
* This can be handy as it permits you to share one application between
* multiple front controller files, with each file containing different
* config values.
*
* Un-comment the $assign_to_config array below to use this feature
*
*/
// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
*  Resolve the system path for increased reliability
* ---------------------------------------------------------------
*/
if (realpath($system_path) !== FALSE) {
	$system_path = realpath($system_path) . DIRECTORY_SEPARATOR ;
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

// Is the system path correct?
if (!is_dir($system_path)) {
	exit('Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
*  Now that we know the path, set the main path constants
* -------------------------------------------------------------------
*/


// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

define('ROOT', dirname(__FILE__));

// The PHP file extension
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', $system_path);

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', basename(BASEPATH));

// The path to the "application" folder
if (is_dir($application_folder)) {
	define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);
} else {
	exit('Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF);
}

if (is_dir(APPPATH . 'config' . DIRECTORY_SEPARATOR)) {
	define('CONFIGPATH', APPPATH . 'config' . DIRECTORY_SEPARATOR);
} else {
	exit('Your application folder path does not appear to contain a configuration directory. Please create and configure one at: ' . APPPATH . 'config' . DIRECTORY_SEPARATOR);
}

if (file_exists(CONFIGPATH.'config' . EXT)) {
	$aSettings = include(CONFIGPATH.'config'.EXT);
} else {
	$aSettings = array();
}

if (isset($aSettings['config']['debug']['level'])) {
	define('YII_DEBUG', $aSettings['config']['debug']['level'] != 0);
	error_reporting($aSettings['config']['debug']['level']);
} else {
	define('YII_DEBUG', false);
	error_reporting(0);
}

if(isset($aSettings['config']['debug']['yiiTraceLevel']) && $aSettings['config']['debug']['yiiTraceLevel'] > 0) {
	define('YII_ENABLE_ERROR_HANDLER', true);
	define('YII_TRACE_LEVEL', $aSettings['config']['debug']['yiiTraceLevel']);
} else {
	define('YII_ENABLE_ERROR_HANDLER', false);
}
/*
 * --------------------------------------------------------------------
* LOAD THE BOOTSTRAP FILE
* --------------------------------------------------------------------
*
* And away we go...
*
*/
require_once BASEPATH . 'yii' . EXT;
require_once APPPATH . 'core'.DIRECTORY_SEPARATOR.'OnlineCoursePortalApplication' . EXT;

Yii::createApplication('OnlineCoursePortalApplication', CONFIGPATH.'config' . EXT)->run();

/* End of file index.php */
/* Location: ./index.php */