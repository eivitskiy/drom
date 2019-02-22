<?php

namespace core;

use Doctrine\ORM\ORMException;

abstract class BaseController
{
    public $view, $entityManager;

    /**
     * BaseController constructor.
     * @throws ORMException
     */
    public function __construct()
    {
        $this->view = new BaseView();

        try {
            $db = new DB();
            $this->entityManager = $db->entityManager;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    protected function response($data, $code = 200, $json = true)
    {
        $data = $json ? json_encode($data) : $data;
        header('Content-type: application/json');
        http_response_code($code);
        return print($data);
    }
}