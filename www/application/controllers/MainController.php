<?php

namespace application\controllers;

use core\BaseController;

class MainController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        $this->view->generate('main', ['title' => 'Заголовок', 'content' => 'содержимое']);
    }
}