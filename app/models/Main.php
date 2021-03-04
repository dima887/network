<?php

namespace app\models;

use fw\core\base\Model;

class Main extends Model
{

    public $table = 'citys';

    //проверка на пустоту в поле поиска
    public function checkSearsh($name)
    {
        $name = $this->validate->basic_check($name);
        $name = $this->validate->required($name, 'Введите имя', null);
        return $name;
    }

    //поиск историй по имени
    public function search($name, $start, $perpage)
    {
        $sql = "SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
    .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE u.name LIKE '$name%' ORDER BY `datatime` DESC LIMIT $start, $perpage;";
        return $sql;
    }

    //общее кол-во записей
    public function rowCount($id = '')
    {
        if ($id) {
            $story = $this->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = $id");
        }else {
            $story = $this->pdo->pdo->prepare("SELECT * FROM storys");
        }
        $story->execute();
        $total = $story->rowCount();
        return $total;
    }

    //кол-во историй пользователя
    public function rowCountNameStory($name)
    {
        $story = $this->pdo->pdo->prepare("SELECT * FROM storys s INNER JOIN users u ON s.iduser = u.id WHERE u.name LIKE '$name%';");
        $story->execute();
        $total = $story->rowCount();
        return $total;
    }

    //вывод историй
    public function sql($start, $perpage, $id = '')
    {
        if ($id) {
            $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = $id ORDER BY `datatime` DESC LIMIT $start, $perpage";
            return $sql;
        }else {
            $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id ORDER BY `datatime` DESC LIMIT $start, $perpage";
            return $sql;
        }
    }

    //отправка истории
    public function story($type, $storys, $user, $city, $file = '', $path = '', $media = 3)
    {
        $sql = "INSERT INTO `storys` (`idstorytype`, `story`, `iduser`, `idcity`, `idmedia`, `datatime`, `path`) VALUES (?, ?, ?, ?, ?, current_timestamp(), ?)";
        $story = $this->pdo->pdo->prepare($sql);
        $story->bindParam(1, $type);
        $story->bindParam(2, $storys);
        $story->bindParam(3, $user);
        $story->bindParam(4, $city);
        $story->bindParam(5, $media);
        $story->bindParam(6, $path);
        if (!empty($file)) {
            foreach ($file as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key2 == 'type') {
                        $item = stripos($value2, 'image');
                    }
                }
            }
            if ($item === false) {
                $media = 2;
            }else {
                $media = 1;
            }
        }
        $story->execute();
    }

    //проверка данных из формы истории и комментарии
    public function checkStory($data)
    {
        $data = $this->validate->basic_check($data);
        $data = $this->validate->required($data, 'Вы забыли рассказать историю!', 'story');
        $data = $this->validate->required($data, 'Вы забыли указать город', 'city');

        return $data;
    }

    //проверка файла
    public function checkFile($file)
    {
        $file = $this->validate->checkTypeFile($file);   //проверка на формат файла
        $file = $this->validate->checkErrorLoadFile($file); //проверка на наличие ошибок при загрузке файла

        return $file;
    }
}