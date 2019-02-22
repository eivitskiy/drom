<?php

namespace core;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DB
{
    public $entityManager;

    /**
     * DB constructor.
     * @throws ORMException
     */
    public function __construct()
    {
        $config = Setup::createAnnotationMetadataConfiguration(array("src"), true);

        $connection = [
            'dbname' => 'drom_db',
            'user' => 'drom_user',
            'password' => 'drom_password',
            'host' => 'db',
            'driver' => 'pdo_mysql'
        ];

        try {
            $this->entityManager = EntityManager::create($connection, $config);
        } catch (ORMException $e) {
            throw $e;
        }
    }
}