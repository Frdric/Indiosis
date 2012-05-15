<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * APPLICATION BOOTSTRAP
 * The only accessible file to the public, bootstraping the entire application.
 * 
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// Framework library + configuration file
$yii=dirname(__FILE__).'/../../yii_framework/framework/yii.php';
$config=dirname(__FILE__).'/../protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();