<?php

// replace with file to your own project bootstrap
require_once ("bootstrap.php");
// replace with mechanism to retrieve EntityManager in your app
// $entityManager = GetEntityManager();

use Symfony\Component\Console\Helper\HelperSet,
    Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper,
    Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper,
    Doctrine\ORM\Tools\Console\ConsoleRunner;
require_once __DIR__ . '/bootstrap.php';
 
$helperSet = new HelperSet(array(
    'em' => new EntityManagerHelper($em),
    'conn' => new ConnectionHelper($em->getConnection())
));
ConsoleRunner::run($helperSet);