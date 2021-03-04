<?php

$db = require '../config/config_db.php';
$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
];
$pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);


$sql = "SELECT password FROM users WHERE id = 35;";
$hash = $pdo->prepare($sql);
//$hash->bindParam(1, $_SESSION['user']['id']);
$hash->execute();
$a = $hash->fetch();
var_dump($a);
foreach ($a as $value) {
    echo $value;
}


echo 123;