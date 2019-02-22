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
        $css = [
            '/node_modules/todomvc-common/base.css',
            '/node_modules/todomvc-app-css/index.css',
            '/css/app.css'
        ];
        $js = [
            'https://code.jquery.com/jquery-2.2.4.min.js',
//            '/node_modules/todomvc-common/base.js',
//            '/node_modules/jquery/dist/jquery.js',
//            '/node_modules/underscore/underscore.js',
//            '/node_modules/backbone/backbone.js',
//            '/node_modules/backbone.localstorage/backbone.localStorage.js',
//            '/js/models/todo.js',
//            '/js/collections/todos.js',
//            '/js/views/todo-view.js',
//            '/js/views/app-view.js',
//            '/js/routers/router.js',
            '/js/app.js',
            '/js/app.js',
            '/js/main.js'
        ];

        $this->view->generate('main', [
            'title' => 'Заголовок',
            'content' => 'содержимое',
            'css' => $css,
            'js' => $js
        ]);
    }
}