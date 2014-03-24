<?php

require_once(dirname(__FILE__) . '/lib/apache-log4php-2.3.0/src/main/php/Logger.php');

defined("DS") || 
	define("DS", DIRECTORY_SEPARATOR);
defined("BASE_DIR") || 
	define("BASE_DIR", dirname(__FILE__) . "/../../");
defined("CONFIG_DIR") || 
	define('CONFIG_DIR',  BASE_DIR . "/config" . DS);


// Tell log4php to use our configuration file.
Logger::configure( CONFIG_DIR . 'logger-configuration_'. 
	strtolower(ENVIRONMENT) .'.xml');
// Fetch a logger, it will inherit settings from the root logger
$logger = Logger::getLogger('ErolLogger');

?>