<?php

namespace core;

class BaseController
{
    public $view;

    public function __construct()
    {
        $this->view = new BaseView();
    }

    protected function response($data, $code = 200, $json = true)
    {
        $data = $json ? json_encode($data) : $data;
        header('Content-type: application/json');
        http_response_code($code);
        return print($data);
    }
}