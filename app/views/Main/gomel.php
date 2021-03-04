<h1 class="my-4">Истории из Гомеля</h1>

<?php if (!empty($gomel)): ?>
    <?php foreach ($gomel as $value): ?>
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
<div class="d-flex justify-content-center">
    <nav aria-label="...">
        <p>Историй: <?=count($gomel);?> из <?=$total;?></p>
        <ul class="pagination pagination-sm">
            <?php if($pagination->countPages > 1): ?>
                <?=$pagination;?>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php else: ?>
    <h3>Историй пока нет...</h3>
<?php endif; ?>
