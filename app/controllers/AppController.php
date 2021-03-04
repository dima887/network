<?php

namespace app\controllers;

use app\models\User;

class AppController extends \fw\core\base\Controller{

    protected $meta = [];
    
    protected function __construct($route) {
        parent::__construct($route);
        $this->layout = 'main';
    }
    
    protected function setMeta($title = '', $desc = '', $keywords = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}