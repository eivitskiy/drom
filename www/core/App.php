<?php

namespace core;

class App
{
    public static $kernel, $router, $db;

    /**
     * @throws \Exception
     */
    public static function init()
    {
        self::$kernel = new Kernel();
        self::$router = new Router();
//        self::$db = new DB();

        try {
            self::$kernel->launch();
        } catch (\Exception $e) {
            //todo: exception to log file

            header("HTTP/1.0 404 Not Found");
            echo file_get_contents(APP_PATH . 'views/404.html');
            exit();
        }
    }
}