<?php
/**
 * INDIOSIS
 * Application Bootstrap
 * This file is the only file accessible to the public.
 * 
 * @package     webroot
 * @author      Frédéric Andreae
 * @copyright   Copyright (C) 2011, ROI
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