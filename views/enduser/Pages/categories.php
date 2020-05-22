<div class="row">
    <div class="col-md-12 d-none d-sm-block">
        <?php foreach ($content["categories"] as $item) : ?>
            <a class="w-100" href="<?= base_url("products?c={$item->id}") ?>">
                <div class="card d-flex float-right m-2 w-25">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body d-flex align-items-center flex-column">
                        <span class="card-title w-100 text-center text-info m-0"><?= $item->title ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="col-sm-12 d-block d-sm-none">
        <?php foreach ($content["categories"] as $item) : ?>
            <a href="<?= base_url("products?c={$item->id}") ?>">
                <div class="card d-flex float-right m-2 w-100">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body d-flex align-items-center flex-column p-0 m-0 py-2">
                        <span class="card-title w-100 text-right text-info m-0 pr-3 _font-size"><?= $item->title ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>