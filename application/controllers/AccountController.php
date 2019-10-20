<?php

namespace application\controllers;

use application\core\Controller;


class AccountController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        //$this->view->layout = 'account';
    }

    //register

    public function registerAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['email', 'login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            elseif ($this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'this email is used');
            }
            elseif ($this->model->checkLoginExists($_POST['login'])) {
                $this->view->message('error', 'this login is used');
            }
            $this->model->register($_POST);

            $this->view->message('success', 'registration completed, confirm email');
        }
        $this->view->render('Register');
    }

    public function confirmAction() {
        $this->route['token'] = str_replace('/' .$this->route['controller']. '/' .$this->route['action'] . '/', '', $_SERVER['REQUEST_URI']);
        if (!$this->model->checkTokenExists($this->route['token'])) {
            $this->view->redirect('account/login');
        }
        $this->model->activate($this->route['token']);

        $this->view->render('Registration is complete');

    }

    //login

    public function loginAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            elseif (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                $this->view->message('error', 'login or password is not correct');
            }
            elseif (!$this->model->checkStatus('login', $_POST['login'])) {
                $this->view->message('error', 'login or password is not correct');
            }
            $this->model->login($_POST['login']);
            $this->view->redirect('photo/gallery/1');
        }

        $this->view->render('Sign in');
    }


    //profile

    public function profileAction() {

        if (!empty($_POST)) {

            if (!$this->model->validate(['email', 'login'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $user_id = $this->model->checkEmailExists($_POST['email']);
            if ($user_id and $user_id != $_SESSION['account']['user_id']) {
                $this->view->message('error', 'this email is used');
            }
            $user_id = $this->model->checkLoginExists($_POST['login']);
            if ($user_id and $user_id != $_SESSION['account']['user_id']) {
                $this->view->message('error', 'this login is used');
            }
            if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->save($_POST);

        }
        $this->view->render('Profile');
    }

    public function logoutAction() {
        if (isset($_SESSION['account'])) {
            unset($_SESSION['account']);
        }
        $this->view->redirect('account/login');
    }

    //recovery password

    public function recoveryAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['email'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            elseif (!$this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'email not found');
            }
            elseif (!$this->model->checkStatus('email', $_POST['email'])) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->recovery($_POST);

            $this->view->message('success', 'request for password recovery sent by email');
        }
        $this->view->render('Recovery password');
    }

    public function resetAction() {
        $this->route['token'] = str_replace('/' .$this->route['controller']. '/' .$this->route['action'] . '/', '', $_SERVER['REQUEST_URI']);
        if (!$this->model->checkTokenExists($this->route['token'])) {
            $this->view->redirect('account/login ');
        }
        $password = $this->model->reset($this->route['token']);
        $vars = [
          'password' => $password,
        ];

        $this->view->render('password change', $vars);
    }

}
