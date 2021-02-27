<?php if(!empty($_SESSION['user'])): ?>

    <form method="post" action="/main/index" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlTextarea1"><h2>Поделитесь своей историей</h2></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                      name="story" placeholder="Напишите свою историю"></textarea>
            <input type="hidden" name="type" value="1">
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="inputState">Загрузите фото или видео</label>
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg> Загрузить
                </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="41943000">
                <input id="file-upload" type="file" name="file"/>
            </div>
            <div class="col-md-6">
                <label for="inputState">Выберите город</label>
                <select name="city" id="inputState" class="form-control">
                    <option selected value="">Выберите город</option>
                    <option value="1">Брест</option>
                    <option value="2">Витебск</option>
                    <option value="3">Гомель</option>
                    <option value="4">Гродно</option>
                    <option value="5">Минск</option>
                    <option value="6">Могилёв</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary send-margin">Поделиться</button>
    </form>

<?php else: ?>

    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Добро пожаловать на Story Network!</h4>
        <p>Что бы поделиться своей историей <a href="/user/login" class="alert-link">войдите</a> в свой
            аккаунт
            или <a href="/user/signup" class="alert-link">зарегистрируйте</a> новый!</p>
    </div>

<?php endif; ?>
