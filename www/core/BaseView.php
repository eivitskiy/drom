<?php
/**
 * Created by PhpStorm.
 * User: eivitskiy
 * Date: 21.02.19
 * Time: 12:57
 */

namespace core;

class BaseView
{
    /**
     * @param $viewName
     * @param array $data
     * @throws \Exception
     */
    public function generate($viewName, array $data = [])
    {
        foreach($data as $key => $value) {
            $$key = $value;
        }

        $viewFile = APP_PATH . 'views' . DIRECTORY_SEPARATOR . $viewName . '.php';
        if (!file_exists($viewFile)) {
            throw new \Exception('View Not Found');
        }

        $viewTemplate = $viewFile;
        include APP_PATH . "views/layout.php";
    }
}