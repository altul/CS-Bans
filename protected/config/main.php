<?php
/**
 * Application configuration
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

/**
 * Класс-заглушка, чтобы нормально использовать переменную $config из старого AmxBans
 */
class conf
{
	public $db_host = null;
	public $db_user = null;
	public $db_pass = null;
	public $db_db = null;
	public $db_prefix = null;
	public $robo_login = null;
	public $robo_pass1 = null;
	public $robo_pass2 = null;
	public $robo_testing = FALSE;
	public $code = NULL;
}
$config = new conf;

// We connect a config of old AmxBans
require_once ROOTPATH . '/include/db.config.inc.php';

// Connect bootstrap
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

$dirs = scandir(dirname(__FILE__).'/../modules');

$modules = array();
foreach ($dirs as $name){
	if ($name[0] != '.') {
		$modules[$name] = array('class'=>'application.modules.' . $name . '.' . ucfirst($name) . 'Module');
	}
}

define('MODULES_MATCHES', implode('|', array_keys($modules)));

// Main application settings
return array(
	'basePath'=>ROOTPATH . DIRECTORY_SEPARATOR . 'protected',
	'name'=>'СS:Bans 1.3',
	'sourceLanguage' => 'en',
	'language'=>'en',

// Preloaded components
	'preload'=>array(
		'log',
		'DConfig',
		'Ip2Country',
		),
// Startup Models and Components
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.gameq.*',
		'application.components.gameq.protocols.*',
		'application.components.gameq.filters.*',
		'ext.editable.*'
	),
	
	'modules'=>array_replace($modules, array(
		
	)),

// Application components
	'components'=>array(
		// Bootstrap
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
		),
		// User component
		'user'=>array(
			// Cookie authentication
			'allowAutoLogin'=>true,
		),
		// Config (from table {{webconfig}})
		'config'=>array(
			'class' => 'DConfig'
		),
		'IpToCountry'=>array(
			'class' => 'Ip2Country'
		),
		// CNC
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix'=>'.html',
			'rules'=>array(
				'/'=>'site/index',
				
				'billing/unban/<id:\d+>' => 'billing/default/unban',
				'billing/<controller:\w+>/<action:\w+>/<id:\d+>' => 'billing/<controller>/<action>',
                'billing/<controller:\w+>/<action:\w+>' => 'billing/<controller>/<action>',
				'billing/<action:\w+>' => 'billing/default/<action>',
                'billing/<controller:\w+>' => 'billing/<controller>/buy',
				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'format'=>array(
			'booleanFormat'=>array('No', 'Yes'),
			'datetimeFormat'=>'d.m.Y H:i',
		),

		// DB connection
		'db'=>array(
			'connectionString' => 'mysql:host='.$config->db_host.';dbname='.$config->db_db,
			'emulatePrepare' => true,
			'username' => $config->db_user,
			'password' => $config->db_pass,
			'charset' => 'utf8',
			'tablePrefix'=>$config->db_prefix.'_',
			'autoConnect' => FALSE,
			'schemaCachingDuration' => 1000,
		),
		'cache'=>array(
			//'class'=>'system.caching.CDummyCache',
			'class'=>'system.caching.CFileCache',
		),
		// Error processing
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		// System log
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// Uncomment if you want the errors to be displayed on the pages
				//array(
				//	'class'=>'CWebLogRoute',
				//),
			),
		),
	),

	// Theme (themes are in themes)
	'theme'=>'default',

	'homeUrl' => array('/site/index'),

	// Additional parameters (called like this: Yii :: app () -> params ['adminEmail'])
	'params'=>array(
		'adminEmail'=>'webmaster@example.com',
		'dbname' => $config->db_db,
		'Version' => '1.3',
	),
);
