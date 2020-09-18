<?php

namespace App\Controller;

use App\Core\Config;
use App\Core\View;
use App\Core\Session;
use App\Model\User;
use App\Model\User\UserRepository;
use App\Model\User\UserResource;

class UserController extends AbstractController
{
    public function loginAction()
    {
        return $this->view->render('login');
    }

    public function registerAction()
    {
        return $this->view->render('register');
    }

    public function registerSubmitAction(): void
    {
        if (!$this->isPost()) {
            // only POST requests are allowed
            header('Location: /');
            return;
        }

        if (!isset($_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
            // set error message
            header('Location: /user/register');
            return;
        }

        if ($_POST['password'] !== $_POST['confirm_password']) {
            // set error message
            header('Location: /user/register');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if ($user->getId()) {
            // user already exists
            header('Location: /user/register');
            return;
        }

        User::insert([
            'firstname' => $_POST['first_name'] ?? null,
            'lastname' => $_POST['last_name'] ?? null,
            'email' => $_POST['email'],
            'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: /');
    }

    public function loginSubmitAction(): void
    {
        // only POST requests are allowed
        if (!$this->isPost()) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['email'], $_POST['password'])) {
            // set error message
            header('Location: /user/login');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if (!$user->getId() || !password_verify($_POST['password'], $user->getPassword())) {
            // set error message
            header('Location: /user/login');
            return;
        }

        // todo session and logout
        header('Location: /');
    }
}
