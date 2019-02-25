<?php

namespace application\controllers;

use core\BaseController;

class MainController extends BaseController
{
    private $user;

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit();
        } else {
            $this->user = $this->entityManager
                ->getRepository('User')
                ->find($_SESSION['user_id']);
        }
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        $css = [
            '/node_modules/todomvc-common/base.css',
            '/node_modules/todomvc-app-css/index.css',
            '/css/app.css'
        ];
        $js = [
            'https://code.jquery.com/jquery-2.2.4.min.js',
            '/js/app.js',
            '/js/app.js',
            '/js/main.js'
        ];

        $todos = $this->user->getTodos()->toArray();

        $this->view->generate('main', [
            'css' => $css,
            'js' => $js,
            'todos' => $todos
        ]);
    }
}