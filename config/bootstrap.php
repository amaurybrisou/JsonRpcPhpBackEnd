<?php

// bootstrap.php
require_once "vendor/autoload.php";
//logging framework
require_once 'lib/KLogger.php';

use Doctrine\ORM\Tools\Setup,
    Doctrine\DBAL\Logging\EchoSQLLogger as Logger,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\ClassLoader;


$isDevMode = true;

//KLogger configurations 
$logLevel = KLogger::ERROR;
$logPath = "logs/eventer.log";

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'cli_eventer',
    'password' => 'abc',
    'dbname'   => 'eventer',
);

//autoloading
require_once __DIR__ . '/../vendor/autoload.php';
$loader = new ClassLoader('entity', __DIR__ . '/../');
$loader->register();
$loader = new ClassLoader('object', __DIR__ . '/../');
$loader->register();
$loader = new ClassLoader('repository', __DIR__ . '/../');
$loader->register();
$loader = new ClassLoader('exception', __DIR__ . '/../');
$loader->register();

//configuration
$config = new Configuration();
$cache = new Cache();
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__ . '/../.entityproxy');
$config->setProxyNamespace('.entityproxy');
$config->setAutoGenerateProxyClasses(true);

/*$logger = new Logger();
$config->setSQLLogger($logger);
$config->getSQLLogger();*/

//mapping (example uses annotations, could be any of XML/YAML or plain PHP)
AnnotationRegistry::registerFile(
	__DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
$driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    new Doctrine\Common\Annotations\AnnotationReader(),
    array(__DIR__ . '/../entity')
);
$config->setMetadataDriverImpl($driver);
$config->setMetadataCacheImpl($cache);
 
//getting the EntityManager
$em = EntityManager::create(
    $dbParams,
    $config
);