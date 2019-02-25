<?php

namespace application\controllers;


use core\BaseController;

class TodosController extends BaseController
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
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        $post = [];
        foreach ($_POST as $k => $value) {
            $post[$k] = htmlspecialchars(trim($value));
        }

        $todo = new \Todo();
        $todo->setUser($this->user);
        $todo->setTask($post['task']);
        $todo->setDone(false);

        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        $data = [
            'id' => $todo->getId(),
            'task' => $todo->getTask()
        ];

        header('Content-Type: application/json');
        return json_encode($data);
    }

    /**
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $post = [];
        foreach ($_POST as $k => $value) {
            if($k == 'done') {
                $post[$k] = ($value === 'true' ? true : false);
            } else {
                $post[$k] = htmlspecialchars(trim($value));
            }
        }

        $todo = $this->entityManager->getRepository('Todo')->find($post['id']);
        if(isset($post['task'])) { $todo->setTask($post['task']);}
        if(isset($post['done'])) { $todo->setDone($post['done']);}

        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        $data = [
            'id' => $todo->getId(),
            'task' => $todo->getTask(),
            'done' => $todo->getDone()
        ];

        header('Content-Type: application/json');
        return json_encode($data);
    }

    /**
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $post = [];
        foreach ($_POST as $k => $value) {
            $post[$k] = htmlspecialchars(trim($value));
        }

        $todo = $this->entityManager->getRepository('Todo')->find($post['id']);

        $this->entityManager->remove($todo);
        $this->entityManager->flush();

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
        $status = $_POST['status'] === 'true' ? true : false;

        $todos = $this->user->getTodos();

        foreach($todos as $todo) {
            $todo->setDone($status);
            $this->entityManager->persist($todo);
            $this->entityManager->flush();
        }

        header('Content-Type: application/json');
        return json_encode(['status' => true]);
    }
}