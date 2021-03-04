<div class="container">
    <h3 class="text-secondary">Ваше имя: <span class="text-danger"><?=$_SESSION['user']['name']?></span></h3>
    <hr>
    <div class="row">
        <div class="col-12 col-md-4">

            <p class="text-center">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                    Изменить логин
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <form method="post" action="/user/profile">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите старый логин</label>
                        <input type="hidden" name="type" value="1">
                        <input type="text" name="loginOld" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите старый логин">
                        <label for="exampleInputEmail1">Введите новый логин</label>
                        <input type="text" name="loginNew" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите новый логин">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button type="submit" class="btn btn-dark">Изменить</button>
                </form>
                <br>
                <hr>
            </div>
        </div>
        <br>
        <div class="col-12 col-md-4">
            <p class="text-center">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExampleTwo"
                        aria-expanded="false" aria-controls="collapseExample">
                    Изменить пароль
                </button>
            </p>
            <div class="collapse" id="collapseExampleTwo">
                <form method="post" action="/user/profile">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите старый пароль</label>
                        <input type="hidden" name="type" value="2">
                        <input type="password" name="passwordOld" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите старый пароль">
                        <label for="exampleInputEmail1">Введите новый пароль</label>
                        <input type="password" name="passwordNew" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите новый пароль">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button type="submit" class="btn btn-dark">Изменить</button>
                </form>
                <br>
                <hr>
            </div>
        </div>
        <br>
        <div class="col-12 col-md-4">
            <p class="text-center">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExampleThree"
                        aria-expanded="false" aria-controls="collapseExample">
                    Изменить email
                </button>
            </p>
            <div class="collapse" id="collapseExampleThree">
                <form method="post" action="/user/profile">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите старый email</label>
                        <input type="hidden" name="type" value="3">
                        <input type="email" name="emailOld" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите старый email">
                        <label for="exampleInputEmail1">Введите новый email</label>
                        <input type="email" name="emailNew" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Введите новый email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button type="submit" class="btn btn-dark">Изменить</button>
                </form>
                <br>
                <hr>
            </div>
        </div>
    </div>
    <hr>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link text-secondary" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Истории</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
               aria-controls="profile" aria-selected="false">Комментарии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
               aria-controls="contact" aria-selected="false">Нравится</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="contact-tab" data-toggle="tab" href="#def" role="tab"
               aria-controls="def" aria-selected="false">Закрыть</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="def" role="tabpanel"
             aria-labelledby="contact-tab"><h1 class="text-secondary text-center">Story Network</h1></div>
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="my-4 text-secondary">Мои истории</h1>

                    <?php if (!empty($myStory)): ?>
                        <?php foreach ($myStory as $value): ?>
                            <div class="card mb-4">
                                <?php if ($value['idmedia'] == 2): ?>

                                    <video controls src="<?=$value['path'] ?>"></video>

                                <?php endif; ?>

                                <?php if ($value['idmedia'] == 1): ?>

                                    <img class="card-img-top" src="<?=$value['path'] ?>" alt="Card image cap">

                                <?php endif; ?>
                                <div class="card-body">
                                    <h2 class="card-title"><?=$value['name'] ?></h2>
                                    <p class="card-text"><?=$value['story'] ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <span class="float-left"><?=$value['city'] ?></span>
                                    <span class="float-right"><?=$value['datatime'] ?></span>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <h3>Вы не рассказали не одной истории...</h3>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Комментарии</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Нравится</div>
    </div>
</div>