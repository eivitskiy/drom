<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array("src"), $isDevMode);

$connection = [
    'dbname' => 'drom_db',
    'user' => 'drom_user',
    'password' => 'drom_password',
    'host' => 'db',
    'driver' => 'pdo_mysql'
];

$entityManager = EntityManager::create($connection, $config);