<div class="row">
    <div class="col-sm-12">
        <?php foreach ($content["subCategories"] as $item) : ?>
            <a class="sub-category" href="<?= base_url("products?sc={$item->id}") ?>"><?= $item->title ?></a>
        <?php endforeach; ?>
    </div>
</div>