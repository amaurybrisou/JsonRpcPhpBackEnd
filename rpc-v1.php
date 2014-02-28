<?php
	require_once __DIR__ . "/config/bootstrap.php";

	use entity\EntityEvent,
		object\Eventer,
		object\JsonRPCServer;

	$log = new KLogger ( $logPath , $logLevel);
	$eventer = new Eventer($em, $log);
	jsonRPCServer::handle($eventer) or print 'no request';

?>