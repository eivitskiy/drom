<?php

namespace models;

use core\BaseModel;

class User extends BaseModel
{
    protected $class = 'User', $alias = 'u';

    public function getByEmail($email)
    {
        $user = $this->entityManager->createQueryBuilder()
            ->select($this->alias)
            ->from($this->class, $this->alias)
            ->where("{$this->alias}.email = :email")
            ->setParameter('email', $email)
            ->getQuery();

        return $user->getOneOrNullResult();
    }
}