<?php

namespace fw\core\base;

use fw\core\Db;
use fw\core\Validate;

/**
 * Description of Model
 *
 */
abstract class Model {
    
    public $pdo;
    protected $table;
    protected $pk = 'id';
    public $attributes = [];
    public $errors = [];
    public $rules = [];
    public $validate;

    public function __construct() {
        $this->pdo = Db::instance();
        $this->validate = new Validate();
    }

    public function query($sql){
        return $this->pdo->execute($sql);
    }

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
    
    public function findOne($id, $field = ''){
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }
    
    public function findBySql($sql, $params = []){
        return $this->pdo->query($sql, $params);
    }
    
    public function findLike($str, $field, $table = ''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}
