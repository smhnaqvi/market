<div class="container">
    <div class="row">
        <div class="category-container col-12 py-3">
            <?php foreach ($content["categories"] as $item) : ?>
                <a class="w-100" href="<?= base_url("sub-categories/{$item->id}") ?>">
                    <div class="category-item">
                        <img class="category-cover" src="<?= base_url("upload/category/{$item->cover}") ?>" alt="#">
                        <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                        <span class="category-title"><?= $item->title ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>