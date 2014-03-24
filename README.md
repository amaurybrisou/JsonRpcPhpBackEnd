JsonRpcPhpBackEnd  : Doctrin2 ORM standalone installation + Json-RPC 2.0
======

## Introduction :

JsonRpcPhpBackEnd include only one class, ContainerAware whose inject 

1. Doctrine EntityManager Object
2. Apache Log4php 2.3.0 Logger

into your Controllers. As far as you extends your database management class with *ContainerAware* (cf [Tutorial](#Tutorial))like that :
```php
	use Erol\ContainerAware;

	class ExampleController extends ContainerAware {
		function some_json_rpc_methods($params){
			
			/** your code **/

			return array( /** some fields you want to receive in your response **/ );
		}
	}
```

## Installation :

	git clone https://github.com/amaurybrisou/PhpBackEnd.git

## Configuration :

# Tutorial :
## Basic JSON-RPC method :

In order to test the example, use for example POSTMAN chrome extension to send some JSON to your Json-RPC 2.0 API.
```php
	{
	    "method": "AddExample",
	    "params": {
	      "name" :"Bonjour"
	    },
	    "jsonrpc": "2.0",
	    "id": 1
	}
```
or
```php
	{
		"method": "my_echo",
		"params": "Hello World !",
		"jsonrpc": "2.0",
		"id": 2
	}
```
### Note :

_If you use don't use Yaml to describe your entities, you can desactivate it in the file *vendor/composer/autoload_namespaces.php*

