<?php

namespace src;
use src\ExampleException;


class JsonRPCServer {
	/**
	 * This function handle a request binding it to a given object
	 *
	 * @param object $object
	 * @return boolean
	 */
	public static function handle($object_class) {
		global $logger;
		// checks if a JSON-RCP request has been received
		if (
			$_SERVER['REQUEST_METHOD'] != 'POST' || 
			empty($_SERVER['CONTENT_TYPE']) ||
			$_SERVER['CONTENT_TYPE'] != 'application/json'
			) {
			$logger->fatal("Not a JSON-RPC Request");
			// This is not a JSON-RPC request
			return false;
		}
				
		$logger->debug("Parsing Json Request");
		// reads the input data
		$request = json_decode(file_get_contents('php://input'),true);
		
		// executes the task on local object
		try {
			if(is_null($request)){
				$request['id'] = 'unkown';
				$logger->fatal("Json Parse Error");
				throw ExampleException::raise(ExampleException::PARSE_ERROR, "parsing error");
			} 
			/*if(empty($request['id'])){
				$request['id'] = 'unkown';
			}*/

			$logger->info("Json Parsing : OK");

			Arguments::check($request);

			$logger->debug("Calling method ".$request['method']);

			$object = new $object_class($logger);
			$result = @call_user_func_array(
					array($object,$request['method']),array($request['params']));
				 
			
			if(!empty($request['id'])){
				$response = array (
								'jsonrpc' => "2.0",
								'id' => $request['id'],
								'result' => $result);	
			}
			
		} catch (ExampleException $e) {
			$logger->error("ErrorCode : ".$e->getCode() . ' : ' .$e->getMessage());
			$response = array (
								'jsonrpc' => "2.0",
								'id' => $request['id'],
								'error' => $e->toArray()
								);
		}
		
		// output the response
		if (!empty($request['id'])) { // notifications don't want response
			$logger->info("Sending Response Back");
			header('content-type: text/javascript');
			echo json_encode($response);
		} else {
			$logger->info("No Id Sent : No Sending Response");
		}
		

		
		// finish
		return true;
	}
}
?>
