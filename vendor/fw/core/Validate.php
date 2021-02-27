<?php


namespace fw\core;

class Validate
{
    public $error = [];
    private $pdo;
    public $fileTypes  = ['jpg'=>'image/jpeg', 'png'=>'image/png', 'gif'=>'image/gif','mp4'=>'video/mp4', 'avi'=>'video/avi', 'mov'=>'video/mov', 'mkv'=>'video/mkv', 'flv'=>'video/flv', 'wmv'=>'video/wmv', NULL];
    public $file_error_upload = [0=>'ошибки не произошло, файл загружен успешно',
        1=>'загружаемый файл превышает размер, установленный директивой upload_max_filesize в файле настроек php.ini',
        2=>'Максимальный размер файла 40 мегабайт!',
        3=>'файл был загружен частично',
        4=>'файл загружен не был'];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    //проверка на формат файла
    public function checkTypeFile($type)
    {
        foreach ($type as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if (!$value2 == '') {
                    if ($key2 == 'type') {
                        if (!array_search($value2, $this->fileTypes)) {
                            array_push($this->error, 'Данный тип файла не подходит! Формат должен соответствовать Фото: jpg, png, gif. Видео: mp4, avi, mov, mkv, flv, wmv');
                        }
                    }
                }
            }
        }
        return $type;
    }

    //проверка на наличие ошибок при загрузке файла
    public function checkErrorLoadFile($file)
    {
        foreach ($file as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == 'error') {
                    if ($value2 !== 0 and $value2 !== 4) {
                        array_push($this->error, $this->file_error_upload[$value2]);
                    }
                }
            }
        }
        return $file;
    }


    //ошибки из формы авторизации или регистрации
    public function getError()
    {
        $this->error = array_unique($this->error);
        $error = '<ul>';
        foreach ($this->error as $err) {
            $error .= "<li>$err</li>";
        }
        $error .= '</ul>';
        $_SESSION['error'] = $error;
    }

    //проверка на уникальность логина
    public function checkUnique($data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'login') {
                $sql = "SELECT * FROM users WHERE login = ?";
                $query = $this->pdo->pdo->prepare($sql);
                $query->bindParam(1, $value);
                $query->execute();
                $user = $query->fetchAll();
                if ($user) {
                    array_push($this->error, 'Этот логин уже занят!');
                }
            }
        }
        return $data;
    }

    //проверка при авторизации
    public function login($login, $password)
    {
        $login = htmlspecialchars(trim($login));
        $password = htmlspecialchars(trim($password));
        $sql = "SELECT * FROM users WHERE login = ?";
        $input = $this->pdo->pdo->prepare($sql);
        $input->bindParam(1, $login);
        $input->execute();
        $user = $input->fetchAll();

        if ($user) {
            foreach ($user as $k => $v) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == 'password') {
                        if (!password_verify($password, $v2)) {
                            array_push($this->error, 'Логин или пароль введены неверно!');
                        }else {
                                $_SESSION['user'] = $v;
                                unset($_SESSION['user']['password']);
                        }
                    }
                }
            }
        }else {
            array_push($this->error, 'Логин или пароль введены неверно!');
        }
        return true;
    }

    //базовая проверка
    public function basic_check($data)
    {
        if (is_array($data)) {
            $arr = array_keys($data);
            $arr2 = [];
            foreach ($data as $key => $datum) {
                $datum = array_push($arr2, htmlspecialchars(trim($datum)));
            }
            $data = array_combine($arr, $arr2);
        }else {
            $data = htmlspecialchars(trim($data));
        }
        return $data;
    }

    //проверка на пустоту полей из формы
    public function required($data, $str = '', ...$types)
    {
        if (is_array($data)) {
            if ($types[0] !== null) {
                foreach ($data as $key => $datum) {
                    foreach ($types as $key2 => $type) {
                        if ($key == $type) {
                            if (mb_strlen($datum) == 0) {
                                if ($str == null) {
                                    array_push($this->error, 'Поле ' . ucfirst($key) . ' не заполнено!');
                                }else {
                                    array_push($this->error, $str);
                                }
                            }
                        }
                    }
                }
            }else {
                foreach ($data as $key => $datum) {
                    if (mb_strlen($datum) == 0) {
                        if ($str == null) {
                            array_push($this->error, 'Поле ' . ucfirst($key) . ' не заполнено!');
                        }else {
                            array_push($this->error, $str);
                        }
                    }
                }
            }
        }else {
            if (mb_strlen($data) == 0) array_push($this->error, $str);
        }
        return $data;
    }

    //проверка на минимальную длину строки
    public function minLength($data, $type, $int)
    {
        if ($type !== null) {
            foreach ($data as $key => $datum) {
                if ($key == $type) {
                    if (mb_strlen($datum) < $int) {
                        array_push($this->error, 'Поле '. ucfirst($key).  ' должно содержать минимум '. $int. ' символов!');
                    }
                }
            }
            return $data;
        }else {
            foreach ($data as $key => $datum) {
                if (mb_strlen($datum) < $int) {
                    array_push($this->error, 'Поле '. ucfirst($key).  ' должно содержать минимум '. $int. ' символов!');
                }
            }
            return $data;
        }
    }

    //проверка на максимальную длину строки
    public function maxLength($data, $type, $int)
    {
        if ($type !== null) {
            foreach ($data as $key => $datum) {
                if ($key == $type) {
                    if (mb_strlen($datum) > $int) {
                        array_push($this->error, 'Поле '. ucfirst($key).  ' должно содержать максимум '. $int. ' символов!');
                    }
                }
            }
            return $data;
        }else {
            foreach ($data as $key => $datum) {
                if (mb_strlen($datum) > $int) {
                    array_push($this->error, 'Поле '. ucfirst($key). ' должно содержать максимум '. $int. ' символов!');
                }
            }
            return $data;
        }
    }

    //проверка email
    public function checkEmail($data)
    {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($this->error,'Email адрес указан не корректно!');
        }
        return $data;
    }
}


