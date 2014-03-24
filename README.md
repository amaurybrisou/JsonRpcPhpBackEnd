JsonRpcPhpBackEnd  : Doctrin2 ORM standalone installation + Json-RPC 2.0
======

## Introduction :

JsonRpcPhpBackEnd include only one class, ContainerAware whose inject 

1. Doctrine EntityManager Object
2. Apache Log4php 2.3.0 Logger

into your Controllers. As far as you extends your database management class with the **Erol\ContainerAware** class. (cf [Tutorial](#tutorial-))

## Installation :

	git clone https://github.com/amaurybrisou/PhpBackEnd.git

## Configuration :

#### Bootstrap File :

The file *config/bootstrap.php* contains :

#####Add your specific Doctrine 2 configurations

#####Database parameters :
```php
	$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'cli_example',
    'password' => 'abc',
    'dbname'   => 'example',
);
```
*note that Doctrine doesn't create your database automatically, you must create it manualy*

#####"ENVIRONMENT" constant which is used in Logging injection to chose the configuration file (cf [Loggin](#logging-))

#####Namespaces registration : 

If you want to include other Directories such as *exception* for example, register this new namespace like that :
```php
$loader = new ClassLoader( 'exception', BASE_DIR);
$loader->register();
```

#####Argument :

Add your functions requiring arguments in the file *config/arguments-required.php*. Following this form : 

```php
$required_fields = array(
	"Your Method Name" => array(
			"Your Field Name " => "Your Error Code"
	)
);
	
```php
$required_fields = array(
	"AddExample" => array(
			"name" => -10
	)
);
```

#### Logging :

Logging is configured in *config/logger-configuration_**your ENVIRONMENT constant**.xml**

Check how to configure log4php on [Apache log4php Website](https://logging.apache.org/log4php/)

## Tutorial :

#### Basic JSON-RPC method :

```php
	function my_echo($params){
		return $params;
	}
```

#### Method with Arguments :


If you function requires arguments, you can make use of the **Erol\Argument** Class wich enables missing field checking in request. (cf [Arguments checking](#argument-)). Then invoque the static method : **check** on **Arguments** Class. like that :

```php
function AddExample($params)
{
	Arguments::check($params);
	return "Arguments are Correct !";
}
```


#### Fully functional example with Doctrine insertion :

```php
function AddExample($params)
{
	Arguments::check($params);
	$exemple = new EntityExample();
	$exemple->setName($params['name']);

	try {
		$this->em->persist($exemple);
		$this->em->flush();

	} catch(DBALException $e){
		throw JsonRpcException::raise($e/** , optional message **/);
	}

	return array("example_id" => $exemple->getExampleId());
}
```

In order to test the example, use for example POSTMAN chrome extension to send some JSON to your Json-RPC 2.0 API.

```json
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
```json
	{
		"method": "my_echo",
		"params": "Hello World !",
		"jsonrpc": "2.0",
		"id": 2
	}
```

You call is done on JsonRpc.php file at the root of the project. 
Notice that in this file is loaded the Request Handler Class for the **Erol\JsonRpcServer**.


###### Note :

_If you use don't use Yaml to describe your entities, you can desactivate it in the file *vendor/composer/autoload_namespaces.php*


Please Warn me if something isn't clear enough or missing.