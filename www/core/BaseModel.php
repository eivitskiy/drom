<?php

namespace core;


use Doctrine\ORM\ORMException;

abstract class BaseModel
{
    public $entityManager;

    /**
     * BaseModel constructor.
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct()
    {
        try {
            $db = new DB();
            $this->entityManager = $db->entityManager;
        } catch (ORMException $e) {
            throw $e;
        }
    }
}