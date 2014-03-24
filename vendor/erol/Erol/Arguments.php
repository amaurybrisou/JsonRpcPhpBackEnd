<?php

namespace Erol;
use Erol\JsonRpcException;

class Arguments {

	public static function check($params, $caller = null){
		global $required_fields;
		global $logger;

		$logger->debug('Checking arguments');
		if(is_null($caller)){
			$callers=debug_backtrace();
			$caller = $callers[1]['function'];
		}

		$logger->info('Method "'.$caller.'" arguments checking');


		foreach ($required_fields[$caller] as $key =>$value) {
			$logger->debug('Checking param '.$key);

			if(!array_key_exists($key, $params)){
				throw JsonRpcException::raise($key, $value);
			}
			$logger->debug($key.' appear : OK');
		}

		$logger->info("All parameters required to call ".$caller." are presents");
		return true;
	}


}