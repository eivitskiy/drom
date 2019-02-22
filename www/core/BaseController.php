<?php

namespace core;

class BaseController
{
    public $view, $entityManager;

    public function __construct()
    {
        $this->view = new BaseView();

        $db = new DB();
        $this->entityManager = $db->entityManager;
    }

    protected function response($data, $code = 200, $json = true)
    {
        $data = $json ? json_encode($data) : $data;
        header('Content-type: application/json');
        http_response_code($code);
        return print($data);
    }
}