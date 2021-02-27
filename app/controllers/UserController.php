<?php

namespace app\controllers;

use app\models\User;
use fw\core\base\View;

class UserController extends AppController
{
    public function __construct($route) {
        parent::__construct($route);
        if (!empty($_SESSION['user'])) {
            $this->layout = 'default';
        }else {
            $this->layout = 'default_off';
        }
        new \app\models\Main;
    }

    //регистрация
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $_POST = $user->signup($_POST);
            if (!$user->validate->error) {
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user->saveUser($_POST['login'], $_POST['password'], $_POST['name'], $_POST['email']);
                $_SESSION['success'] = 'Вы успешно зарегистрированы';
                $_SESSION['user'] = $_POST;
                $_SESSION['user'] += $user->id;
                unset($_SESSION['user']['password']);
                redirect('/');
            } else {
                $user->validate->getError();
                $_SESSION['form_data'] = $_POST;
                redirect();
            }
        }
            View::setMeta('Регистрация');
    }
    //авторизация
    public function loginAction(){
        if (!empty($_POST)) {
            $user = new User();
            $user->login($_POST['login'], $_POST['password']);
            if(!$user->validate->error){
                $_SESSION['success'] = 'Вы успешно авторизованы';
                redirect('/');
            }else{
                $user->validate->getError();
                redirect();
            }
        }
        View::setMeta('Вход');
    }
    //выход
    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect('/user/login');
    }

    //личный кабинет
    public function profilAction()
    {

    }
}