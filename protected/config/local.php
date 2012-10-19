<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * Main Configuration File
 * Describes all the configuration variables of Indiosis.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI 2012
 */

// Include helper functions
require_once( dirname(__FILE__) . '/../components/helpers.inc');

// Define home folder path
$homePath = dirname(__FILE__) . '/../..';

// Simple function to join paths
function _joinpath($dir1, $dir2) {
    return realpath($dir1 . DIRECTORY_SEPARATOR . $dir2);
}

return array(

    // Path to the protected folder
    'basePath'=>_joinpath($homePath, 'protected'),

    // Name of the application
    'name'=>'Indiosis',

    // Default controller to use
    'defaultController'=>'home',

    // Path to runtime folder
    'runtimePath' => _joinpath($homePath, 'runtime'),

    // User language
    'language'=>'en',

    // Message and views language
    'sourceLanguage'=>'en',

    // Application charset
    'charset'=>'utf-8',

    // Preloading 'log' component
    'preload'=>array('log'),

    // Autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*'
    ),

    //To be uncommented when auto-creation panel is needed.
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'primeroi',
            'generatorPaths'=>array(
                'application.gii',   // a path alias
            )
        ),
    ),

    'components'=>array(

        // Simplify URLs
        'urlManager'=>array(
            'showScriptName'=>false,
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            )
        ),

        // Setup user authentication rules
        'user'=>array(
            'allowAutoLogin'=>true,
            'loginUrl'=> '/indiosis/',
        ),

        // Setup the DB connexion
        'db'=>array(
                'connectionString' => 'mysql:host=127.0.0.1;dbname=indiosis',
                'emulatePrepare' => true,
                'username' => 'indiosis',
                'password' => 'roi',
                'charset' => 'utf8',
        ),

        // Redirect errors to Indiosis error page
        'errorHandler'=>array(
            // use 'home/error' action to display errors
            'errorAction'=>'home/error',
        ),

        // Enables logs
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                )
            )
        ),

        // Specify the asset folder path
        'assetManager'=>array(
            'basePath'=>_joinpath($homePath,'webroot/assets'),
            'baseUrl'=>'/indiosis/assets'
        )
    ),

    // Other parameters (accessible through Yii::app()->params['paramName'])
    'params'=>array(
        'indiosisEmail'=>'wwwindio@unil.ch',
        'notificationEmail'=>'wwwindio@unil.ch',
        'adminEmail'=>'fred@roi-online.org',
        'indiosisVersion' => 'beta',
        'indiosisVersionNumber' => '0.2',
        'ajaxSuccess' => 'OK',
        'ajaxFailure' => 'ERROR',
        'linkedinKey' => 'pj0erle37g0w',
        'linkedinSecret' => 'Q8tfJu8jekqAWTNE',
        'linkedinBackUrl' => 'http://localhost/indiosis/account/linkedinhandle',
        'countryList' => include( _joinpath(_joinpath($homePath,'protected'),'data').'/country-list.php')
    )
);