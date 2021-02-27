<?php

namespace app\controllers;

use app\models\User;

class AppController extends \fw\core\base\Controller{
    
    public $menu;
    public $meta = [];
    
    public function __construct($route) {
        parent::__construct($route);
        $this->layout = 'main';
        new \app\models\Main;
    }
    
    protected function setMeta($title = '', $desc = '', $keywords = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}