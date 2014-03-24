<?php


use Doctrine\ORM\Tools\Setup,
    Doctrine\DBAL\Logging\EchoSQLLogger as Logger,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\ClassLoader;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'cli_example',
    'password' => 'abc',
    'dbname'   => 'example',
);

defined("ENVIRONMENT") || define('ENVIRONMENT',   "DEVELOPMENT");

//autoloading
require_once ( dirname(__FILE__) . '/../vendor/autoload.php');
// register namespaces
$loader = new ClassLoader( 'entity', BASE_DIR);
$loader->register();
$loader = new ClassLoader( 'src', BASE_DIR);
$loader->register();
$loader = new ClassLoader( 'repository', BASE_DIR);
$loader->register();

//configuration
$config = new Configuration();
$cache = new Cache();
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__ . '/../.entityproxy');
$config->setProxyNamespace('.entityproxy');
$config->setAutoGenerateProxyClasses(true);

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
