<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Validate;

class User extends Model
{
    public $table = 'users';
    public $validate;
    public $id;

    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validate();
    }

    //проверка данных при регистрации
    public function signup($data)
    {
        $data = $this->validate->basic_check($data);  //удаление пробелов и html символов
        $data = $this->validate->required($data, null, null); //проверка на пустоту всех полей
        $data = $this->validate->minLength($data, 'login', 2);  //логин минимум 2 символа
        $data = $this->validate->minLength($data, 'password', 6); //пароль минимум 6 символов
        $data = $this->validate->maxLength($data, null, 30); //макс. 30 символов для каждого поля
        $data = $this->validate->checkEmail($data);  //проверка на корректность email
        $data = $this->validate->checkUnique($data);  //проверка на совпадения login

        return $data;
    }

    //регистрация нового пользователя
    public function saveUser($login, $password, $name, $email)
    {
        $sql = "INSERT INTO users (login, password, name, email) VALUES (?, ?, ?, ?)";
        $save = $this->pdo->pdo->prepare($sql);
        $save->bindParam(1, $login);
        $save->bindParam(2, $password);
        $save->bindParam(3, $name);
        $save->bindParam(4, $email);
        $save->execute();
        $id = $this->pdo->pdo->lastInsertId();
        $this->id = ['id'=>$id];

    }

    //авторизация пользователя
    public function login($login, $password){
        $login = $this->validate->login($login, $password);
        return $login;
    }
}