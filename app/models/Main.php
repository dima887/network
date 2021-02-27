<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Pagination;
use fw\core\Validate;

class Main extends Model{
    
    public $table = 'citys';
    public $validate;

    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validate();
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
        $file = $this->validate->checkTypeFile($file);
        $file = $this->validate->checkErrorLoadFile($file);

        return $file;
    }

}
