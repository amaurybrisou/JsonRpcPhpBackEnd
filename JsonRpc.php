<?php

	define("DS", DIRECTORY_SEPARATOR);
	define("BASE_DIR", dirname(__FILE__));
	define('CONFIG_DIR',  BASE_DIR . "/config" . DS);

	require_once CONFIG_DIR . "bootstrap.php";

	use entity\EntityEvent,
		src\Example,
		src\JsonRPCServer;



	$app = new Example();
	jsonRPCServer::handle($app) or print 'no request';

?>