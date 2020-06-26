<div class="row">
    <div class="category-container col-12">
        <?php foreach ($content["categories"] as $item) : ?>
            <a class="w-100" href="<?= base_url("products?c={$item->id}") ?>">
                <div class="category-item"
                     style="background-image: url('<?= base_url("upload/category/{$item->cover}") ?>');background-size: cover;background-position: center">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <span class="category-title"><?= $item->title ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>