<div class="container">
    <div class="row">
        <div class="col-12 sub-category-container py-4">
            <?php foreach ($content["subCategories"] as $item) : ?>
                <a class="sub-category" href="<?= base_url("products?sc={$item->id}") ?>"><?= $item->title ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>