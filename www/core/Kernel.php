<?php

namespace core;

class Kernel
{
    public $defaultControllerName = 'MainController';
    public $defaultActionName = "index";

    /**
     * @throws \Exception
     */
    public function launch()
    {
        list($controllerName, $actionName, $params) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);
    }

    /**
     * @param $controllerName
     * @param $actionName
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName) . 'Controller';
        $controllerFile = APP_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            throw new \Exception('Controller Not Found');
        }
        $controllerClass = "\\application\\controllers\\{$controllerName}";
        if (!class_exists($controllerClass)) {
            throw new \Exception('Controller Class Not Found');
        }
        $controller = new $controllerClass;

        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)) {
            throw new \Exception('Method Not Found');
        }

        return $controller->$actionName($params);
    }
}