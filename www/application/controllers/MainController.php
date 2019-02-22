<?php

namespace application\controllers;

use core\BaseController;

class MainController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        return $this->view->generate('main', ['title' => 'Заголовок', 'content' => 'содержимое']);
    }
}