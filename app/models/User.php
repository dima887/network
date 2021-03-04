<?php

namespace app\models;

use fw\core\base\Model;

class User extends Model
{
    public $table = 'users';
    public $id;

    //мои истории
    public function myStory($id)
    {
        $sql = $myStory = "SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE u.id = $id ORDER BY `datatime` DESC;";
        return $sql;
    }


    //проверка данных при регистрации
    public function signup($data)
    {
        $data = $this->validate->basic_check($data);  //удаление пробелов и html символов
        $data = $this->validate->required($data, null, null); //проверка на пустоту всех полей
        $data = $this->validate->minLength($data, 'login', 2,'Логин должен состоять минимум из 2 символов');
        $data = $this->validate->minLength($data, 'password', 6, 'Пароль должен состоять минимум из 6 символов');
        $data = $this->validate->minLength($data, 'name', 2, 'Имя должно состоять минимум из 2 символов');
        $data = $this->validate->maxLength($data, null, 30); //макс. 30 символов для каждого поля
        $data = $this->validate->checkEmail($data, 'email');  //проверка на корректность email
        $data = $this->validate->checkUnique($data, 'login');  //проверка на совпадения login

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

    //изменить логин
    public function newLogin($data, $loginOld, $loginNew)
    {
        $loginOld = $this->validate->basic_check($loginOld);
        $loginNew = $this->validate->basic_check($loginNew);
        $loginOld = $this->validate->required($loginOld, 'Вы не ввели старый логин', null);
        $loginNew = $this->validate->required($loginNew, 'Вы не ввели новый логин', null);
        $data = $this->validate->minLength($data, 'loginNew', 2, 'Логин должен состоять минимум из 2 символов');
        $this->validate->maxLength($data, 'loginNew', 30, 'Максимальная длина поля 30 символов');
        $this->validate->checkUnique($data, 'loginNew');

        if (!$this->validate->error) {
            if ($loginOld == $_SESSION['user']['login']) {
                $sql = "UPDATE users u SET u.login = ? WHERE u.login = ?;";
                $save = $this->pdo->pdo->prepare($sql);
                $save->bindParam(1, $loginNew);
                $save->bindParam(2, $loginOld);
                $save->execute();
                $_SESSION['user']['login'] = $loginNew;
            }else {
                array_push($this->validate->error, 'Вы ввели неверный логин');
            }
        }
    }

    //изменить пароль
    public function newPassword($data, $passOld, $passNew)
    {
        $passOld = $this->validate->basic_check($passOld);
        $passNew = $this->validate->basic_check($passNew);
        $passOld = $this->validate->required($passOld, 'Вы не ввели старый пароль', null);
        $passNew = $this->validate->required($passNew, 'Вы не ввели новый пароль', null);
        $this->validate->minLength($data, 'passwordNew', 6, 'Пароль должен состоять минимум из 6 символов'); //пароль минимум 6 символов
        $this->validate->maxLength($data, 'passwordNew', 30, 'Максимальная длина поля 30 символов');

        $sql = "SELECT password FROM users WHERE id = ?;";
        $hash = $this->pdo->pdo->prepare($sql);
        $hash->bindParam(1, $_SESSION['user']['id']);
        $hash->execute();
        $hash = $hash->fetch();
        foreach ($hash as $value) {
            if (password_verify($passOld, $value)) {
                if (!$this->validate->error) {
                    $passNew = password_hash($passNew, PASSWORD_DEFAULT);
                    $sql2 = "UPDATE users u SET u.password = ? WHERE u.password = ?;";
                    $save = $this->pdo->pdo->prepare($sql2);
                    $save->bindParam(1, $passNew);
                    $save->bindParam(2, $value);
                    $save->execute();
                }
            }else {
                array_push($this->validate->error, 'Вы ввели неверный пароль!');
            }
        }
    }

    //изменить email
    public function newEmail($data, $emailOld, $emailNew)
    {
        $emailOld = $this->validate->basic_check($emailOld);
        $emailNew = $this->validate->basic_check($emailNew);
        $emailOld = $this->validate->required($emailOld, 'Вы не ввели старый email', null);
        $emailNew = $this->validate->required($emailNew, 'Вы не ввели новый email', null);
        $this->validate->maxLength($data, 'emailNew', 30, 'Максимальная длина поля 30 символов');
        $this->validate->checkEmail($data, 'emailNew');

        if (!$this->validate->error) {
            if ($emailOld == $_SESSION['user']['email']) {
                $sql = "UPDATE users u SET u.email = ? WHERE u.email = ?;";
                $save = $this->pdo->pdo->prepare($sql);
                $save->bindParam(1, $emailNew);
                $save->bindParam(2, $emailOld);
                $save->execute();
                $_SESSION['user']['email'] = $emailNew;
            }else {
                array_push($this->validate->error, 'Вы ввели неверный email');
            }
        }
    }
}