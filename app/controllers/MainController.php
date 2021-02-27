<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\core\Pagination;

class MainController extends AppController
{
    public function __construct($route) {
        parent::__construct($route);
        $this->layout = 'main';
        new \app\models\Main;
    }


    public function indexAction()
    {
        $model = new Main;
        if (!empty($_POST)) {
            $_POST = $model->checkStory($_POST);
            if (!$_FILES['file']['size'] == '') {
                $_FILES = $model->checkFile($_FILES);
                if (!$model->validate->error) {
                     //имя файла
                    $temp = explode("/", $_FILES['file']['type']);
                    (empty($_FILES['file']['name'])) ? $uploadName = NULL : $uploadName = base_convert(time(), 10,
                            36).'-' .base_convert(rand(0, 2000000000), 10, 36).".". $temp[1];
                    //путь к файлу
                    $uploadPath = '../public/images/'.$uploadName;
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath);
                    debug($_FILES);
                    $model->story($_POST['type'], $_POST['story'], $_SESSION['user']['id'], $_POST['city'], $_FILES,
                        $uploadPath);
                    redirect();
                }else {
                    $model->validate->getError();
                    redirect();
                }
            }else {
                if (!$model->validate->error) {
                    debug($_POST);
                    $model->story($_POST['type'], $_POST['story'], $_SESSION['user']['id'], $_POST['city']);
                    redirect();
                }else {
                    $model->validate->getError();
                    debug($_POST);
                    redirect();
                }
            }
        }

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $mainStory = $model->findBySql($sql); //все истории на главной странице
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'mainStory', 'pagination', 'total'));
    }


    public function brestAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 1");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 1  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $brest = $model->findBySql($sql); //истории из Бреста
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'brest', 'pagination', 'total'));

    }

    public function vitebskAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 2");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 2  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $vitebsk = $model->findBySql($sql); //истории из Витебска
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'vitebsk', 'pagination', 'total'));

    }

    public function gomelAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 3");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 3  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $gomel = $model->findBySql($sql); //истории из Гомеля
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'gomel', 'pagination', 'total'));

    }

    public function grodnoAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 4");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 4  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $grodno = $model->findBySql($sql); //истории из Гродно
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'grodno', 'pagination', 'total'));

    }

    public function minskAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 5");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 5  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $minsk = $model->findBySql($sql); //истории из Гродно
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'minsk', 'pagination', 'total'));

    }

    public function mogilevAction()
    {
        $model = new Main();

        $story = $model->pdo->pdo->prepare("SELECT * FROM storys WHERE idcity = 6");
        $story->execute();
        $total = $story->rowCount();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $sql ="SELECT `name`, `story`, `city`, `datatime`, `path`, `idmedia` FROM users u INNER JOIN storys s ON u
        .id = s.iduser INNER
        JOIN citys c ON s.idcity = c.id WHERE s.idcity = 6  ORDER BY `datatime` DESC LIMIT $start, $perpage";

        $mogilev = $model->findBySql($sql); //истории из Мргилева
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'mogilev', 'pagination', 'total'));

    }
    
}
