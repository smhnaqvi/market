<?php if (!empty($content["category"])): ?>
    <div class="row">
        <div class="category-banner"
             style="background-image: url('<?= base_url("upload/category/{$content["category"]->cover}") ?>');background-size: cover;background-position: center">
            <span><?= $content["category"]->title ?></span>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <?php if (!empty($content["products"]["products"])) : ?>
        <div class="col-md-12  products-list">
            <?php foreach ($content["products"]["products"] as $product) : ?>
                <div data-rowId="" data-id="<?= $product->product_id ?>" class="product-item pb-5">
                    <a href="<?= base_url("page/product/$product->product_id") ?>"
                       style="text-decoration: none; display: contents">
                        <img data-cover="<?= $product->cover ?>" src="<?= $product->cover ?>" alt="">
                    </a>
                    <div class="product-price-box">
                        <div data-title="<?= $product->name ?>" class="title"><?= $product->name ?></div>
                        <div data-price="<?= $product->sell_price ?>"
                             class="price my-2"><?= number_format($product->sell_price) ?>
                            <p class="d-inline-block pr-1 m-0">ت</p>
                        </div>
                        <button onclick="addToBasket(this)" class="addToCart2 fal fa-plus"></button>
                    </div>
                    <div class="product-count w-75">
                        <i class="fal fa-plus plusCounter"></i>
                        <input aria-label="" data-qty type="number" class="text-center form-control py-0 mx-2 w-50"
                               value="1">
                        <i class="fal fa-minus minusCounter"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="font-size: 14pt" class="alert alert-warning d-flex justify-content-center align-items-center"
             role="alert">
            نتیجه ای یافت نشد <i style="font-size: 20pt; padding: 0 10px 0 0" class="fal fa-frown text-danger"></i>
        </div>
    <?php endif ?>
</div>
