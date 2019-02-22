<?php

namespace application\controllers;


use core\BaseController;
use models\User;

class AuthController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function index($values = [], $errors = [])
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }

        $css = [
            'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
            'https://use.fontawesome.com/releases/v5.7.2/css/all.css'
        ];
        $js = [
            'https://code.jquery.com/jquery-3.3.1.slim.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
            '/js/auth.js'
        ];

        $this->view->generate('auth', [
            'css' => $css,
            'js' => $js,
            'values' => $values,
            'errors' => $errors
        ]);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function login()
    {
        $values = $errors = [];

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $post = [];
            foreach ($_POST as $k => $value) {
                $post[$k] = htmlspecialchars(trim($value));
            }

            $validation_errors = $this->validation($post);
            if($validation_errors) {
                $values['email'] = $post['email'];
                $errors = $validation_errors;
            } else {
                if ($user = (new User())->getByEmail($post['email'])) {
                    if (md5($post['password']) == $user->getPassword()) {
                        $_SESSION['user'] = $user;
                        header('Location: /');
                        exit();
                    } else {
                        $values['email'] = $post['email'];
                        $errors['password'] = 'Введён неверный пароль';
                    }
                } else {
                    $errors['email'] = 'Пользователь с таким e-mail не найден';
                }
            }
        }

        return $this->index($values, $errors);
    }

    /**
     * @throws \Exception
     */
    public function register()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }

        $values = $errors = [];

        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
            // если переданы эти параметры, значит отправили форму
            $post = [];
            foreach ($_POST as $k => $value) {
                $post[$k] = htmlspecialchars(trim($value));
            }
            $validation_errors = $this->validation($post, true);
            if($validation_errors) {
                $values['email'] = $post['email'];
                $errors = $validation_errors;
            } else {
                if ((new User())->getByEmail($post['email'])) {
                    $values['email'] = $post['email'];
                    $errors['email'] = 'Пользователь с таким email уже зарегистрирован';
                } else {
                    $user = new \User();
                    $user->setEmail($post['email']);
                    $user->setPassword(md5($post['password']));
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    $_SESSION['user'] = $user;
                    header('Location: /');
                    exit();
                }
            }

        }

        $css = [
            'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
            'https://use.fontawesome.com/releases/v5.7.2/css/all.css'
        ];
        $js = [
            'https://code.jquery.com/jquery-3.3.1.slim.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
            '/js/auth.js'
        ];

        $this->view->generate('register', [
            'css' => $css,
            'js' => $js,
            'values' => $values,
            'errors' => $errors
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /auth/login');
        exit();
    }

    private function validation($data, $password_confirmed = false)
    {
        $errors = [];

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Не валидный email';
        }

        if(!preg_match("/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data['password'])) {
            $errors['password'] = 'Не валидный пароль';
        }

        if($password_confirmed && $data['password'] !== $data['password_confirm']) {
            $errors['password_confirm'] = 'Пароли не совпадают';
        }

        return $errors;
    }
}