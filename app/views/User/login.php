<div class="row background-authorization">
    <div class="col-lg">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-4">
                <div id="form-authorization">
                    <div class="card my-4" id="_form">
                        <h5 class="card-header text-center bg-primary text-white">Авторизация</h5>
                        <div class="card-body">
                            <form method="post" action="/user/login">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Login</label>
                                    <input type="text" name="login" class="form-control" id="exampleInputLogin2"
                                           aria-describedby="emailHelp" placeholder="Введите ваш логин"
                                           value="<?=isset
                                           ($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login'] : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                           id="exampleInputPassword2" placeholder="Введите ваш пароль">
                                </div>
                                <button type="submit" class="btn btn-primary">Войти</button>
                            </form>
                        </div>
                        <a id="registration" class="btn btn-danger float-right" href="signup">Регистрация</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>