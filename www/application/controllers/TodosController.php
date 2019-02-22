<?php

namespace application\controllers;


use core\BaseController;

class TodosController extends BaseController
{
    private $user;

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        } else {
            $this->user = $_SESSION['user'];
        }
    }

    public function create()
    {
        $data = [
            'id' => 0,
            'task' => 'Task_' . time()
        ];

        header('Content-Type: application/json');
        return json_encode($data);
    }

    public function update()
    {
        $data = [
            'id' => 0,
            'task' => 'NewTask_' . time()
        ];

        header('Content-Type: application/json');
        return json_encode($data);
    }

    public function delete()
    {
        header('Content-Type: application/json');
        return json_encode(['status' => true]);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function changeAllStatus()
    {
        $post = [];
        foreach ($_POST as $k => $value) {
            $post[$k] = htmlspecialchars(trim($value));
        }

        header('Content-Type: application/json');
        return json_encode(['status' => true]);
    }
}