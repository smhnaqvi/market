<div class="row">
    <div class="col-md-12 d-none d-sm-block">
        <?php foreach ($content["subCategories"] as $item) : ?>
            <a href="<?= base_url("scp/{$item->id}") ?>">
                <div class="card d-flex float-right m-2 w-25">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body d-flex align-items-center flex-column">
                        <h5 class="card-title w-100 text-center text-info"><?= $item->title ?></h5>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="col-sm-12 d-block d-sm-none">
        <?php foreach ($content["subCategories"] as $item) : ?>
            <a href="<?= base_url("scp/{$item->id}") ?>">

                <div class="card d-flex float-right m-2 w-100">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body d-flex align-items-center flex-column">
                        <h5 class="card-title w-100 text-center text-info"><?= $item->title ?></h5>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>