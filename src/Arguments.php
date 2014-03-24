<?php

namespace src;
use src\ExampleException;

class Arguments {

	private static $required_fields = array(
		"AddExample" => array(
				"name"
			),
		"handle" => array(
			//"id",
			"method",
			"jsonrpc"
			)
		);


	

	public static function check($params, $caller = null){
		global $logger;

		$logger->debug('Checking arguments');
		if(is_null($caller)){
			$callers=debug_backtrace();
			$caller = $callers[1]['function'];
		}

		$logger->info('Method "'.$caller.'" arguments checking');


		foreach (self::$required_fields[$caller] as $value) {
			$logger->debug('Checking param '.$value);
			if(!array_key_exists($value, $params)){
				throw ExampleException::raise($value);
			}
			$logger->debug($value.' appear : OK');
		}

		$logger->info("All parameters required to call ".$caller." are presents");
		return true;
	}


}