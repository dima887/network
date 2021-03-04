<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\core\Pagination;

class MainController extends AppController
{
    public $nameStory = [];
    public function __construct($route) {
        parent::__construct($route);
        $this->layout = 'main';
    }


    public function indexAction()
    {
        $model = new Main;
        $arr = [];
        if (!empty($_POST) and $_POST['type'] == 1) {
            $_POST = $model->checkStory($_POST);
            if (!$_FILES['file']['size'] == '') {
                $_FILES = $model->checkFile($_FILES);
                if (!$model->validate->error) {
                    //имя файла
                    $temp = explode("/", $_FILES['file']['type']);
                    (empty($_FILES['file']['name'])) ? $uploadName = NULL : $uploadName = base_convert(time(), 10,
                            36) . '-' . base_convert(rand(0, 2000000000), 10, 36) . "." . $temp[1];
                    //путь к файлу
                    $uploadPath = '../public/images/' . $uploadName;
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath);
                    $model->story($_POST['type'], $_POST['story'], $_SESSION['user']['id'], $_POST['city'], $_FILES,
                        $uploadPath);
                    redirect();
                } else {
                    $model->validate->getError();
                    redirect();
                }
            } else {
                if (!$model->validate->error) {
                    $model->story($_POST['type'], $_POST['story'], $_SESSION['user']['id'], $_POST['city']);
                    redirect();
                } else {
                    $model->validate->getError();
                    redirect();
                }
            }
        }else if (!empty($_POST) and $_POST['type'] == 2) {
            $_POST = $model->checkSearsh($_POST);
            if (!$model->validate->error) {
                $totalName = $model->rowCountNameStory($_POST['search']);
                $perpage = 5;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $paginationName = new Pagination($page, $perpage, $totalName);
                $start = $paginationName->getStart();
                $arr = $model->findBySql($model->search($_POST['search'], $start, $perpage));
            } else {
                $model->validate->getError();
                redirect();
            }
        }


        $total = $model->rowCount();
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $mainStory = $model->findBySql($model->sql($start, $perpage));
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title','mainStory', 'pagination', 'total', 'arr'));
    }

    public function brestAction()
    {
        $model = new Main();

        $total = $model->rowCount(1);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $brest = $model->findBySql($model->sql($start, $perpage, 1));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Брест', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'brest', 'pagination', 'total'));
    }

    public function vitebskAction()
    {
        $model = new Main();

        $total = $model->rowCount(2);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $vitebsk = $model->findBySql($model->sql($start, $perpage,2));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Витебск', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'vitebsk', 'pagination', 'total'));
    }

    public function gomelAction()
    {
        $model = new Main();

        $total = $model->rowCount(3);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $gomel = $model->findBySql($model->sql($start, $perpage, 3));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Гомель', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'gomel', 'pagination', 'total'));
    }

    public function grodnoAction()
    {
        $model = new Main();

        $total = $model->rowCount(4);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $grodno = $model->findBySql($model->sql($start, $perpage, 4));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Гродно', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'grodno', 'pagination', 'total'));
    }

    public function minskAction()
    {
        $model = new Main();

        $total = $model->rowCount(5);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $minsk = $model->findBySql($model->sql($start, $perpage, 5));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Минск', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'minsk', 'pagination', 'total'));
    }

    public function mogilevAction()
    {
        $model = new Main();

        $total = $model->rowCount(6);
        $perpage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $mogilev = $model->findBySql($model->sql($start, $perpage, 6));

        $title = 'PAGE TITLE';
        View::setMeta('Главная страница: Могилев', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'mogilev', 'pagination', 'total'));
    }
}