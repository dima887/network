<div class="row background-registration">
    <div class="col-lg">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-4">
                <div id="form-registration">
                    <div class="card my-4" id="_form1">
                        <h5 class="card-header text-center bg-danger text-white">Регистрация</h5>
                        <div class="card-body">
                            <form method="post" action="/user/signup">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Login</label>
                                    <input type="text" name="login" class="form-control" id="exampleInputLogin2"
                                           aria-describedby="emailHelp" placeholder="Придумайте уникальный логин"
                                           value="<?=isset
                                    ($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login'] : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                           id="exampleInputPassword2" placeholder="Придумайте уникальный пароль">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputLogin2"
                                           aria-describedby="emailHelp" placeholder="Введите ваше имя" value="<?=isset
                                    ($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" name="email" class="form-control"
                                           id="exampleInputPassword2" placeholder="Введите ваш Email" value="<?=isset
                                    ($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '';?>">
                                </div>
                                <button type="submit" class="btn btn-danger">Создать аккаунт</button>
                            </form>
                            <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']);?>
                        </div>
                        <a id="authorization" type="submit" class="btn btn-primary" href="login">Авторизация</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>