<?php //var_dump($content["similar_products"]); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="product-info-2">
                <img class="img-fluid"
                     src="<?= base_url("upload/products/{$content['product']->cover}") ?>"
                     alt="<?= $content["product"]->name ?>">
                <div class="product-price-box">
                    <div class="title"><?= $content["product"]->name ?></div>
                    <div class="price my-2"><?= number_format($content["product"]->sell_price) ?><p
                                class="d-inline-block pr-1 m-0">
                            ت</p></div>
                    <button class="addToCart">افزودن به سبد خرید</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">price chart</div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 mt-5 mb-3">
            <p class="text-right h5">محصولات مشابه</p>
        </div>
        <div class="col-md-12 products-list">
            <?php foreach ($content["similar_products"] as $product): ?>
                <div class="product-item pb-5">
                    <a href="<?= base_url("page/product/$product->product_id") ?>"
                       style="text-decoration: none; display: contents">
                        <img src="<?= base_url("upload/products/{$product->cover}") ?>" alt="">
                    </a>
                    <div class="product-price-box">
                        <div class="title"><?= $content["product"]->name ?></div>
                        <div class="price my-2"><?= number_format($content["product"]->sell_price) ?><p
                                    class="d-inline-block pr-1 m-0">
                                ت</p></div>
                        <button class="addToCart2 fal fa-plus"></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>