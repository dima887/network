<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php \fw\core\base\View::getMeta() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!--    <link href="../../public/css/style.css" rel="stylesheet">-->
    <link href="../../public/css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php

if (!empty($_SESSION['user'])) {
    $this->getPart(APP. '/views/inc/headerOn.php');
}else {
    $this->getPart(APP. '/views/inc/headerOff.php');
}

?>
<br><br><br>
<?php //debug($_SESSION); ?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="container">
        <div class="alert alert-danger">
            <?=$_SESSION['error']; unset($_SESSION['error'])?>
        </div>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="container">
        <div class="alert alert-success">
            <?=$_SESSION['success']; unset($_SESSION['success'])?>
        </div>
    </div>
<?php endif; ?>

<?php //debug($_SESSION); ?>

<div id="story-network" class="container Site-content">

    <div class="content-network">
        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    <?php $this->getPart(APP. '/views/inc/formStory.php'); ?>

                    <?=$content;?>

                </div>

                <div class="col-md-4">

                    <?php $this->getPart(APP. '/views/inc/sidebar.php'); ?>

                </div>

            </div>

        </div>
    </div>
</div>

<?php $this->getPart(APP. '/views/inc/footer.php') ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<?php
foreach($scripts as $script){
    echo $script;
}
?>
</body>
</html>