<?php //var_dump($content["similar_products"]); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-rowId="" data-id="<?= $content['product']->id ?>" class="product-info-2">
                <img class="img-fluid"
                     src="<?= $content['product']->cover ?>"
                     alt="<?= $content["product"]->name ?>" data-cover="<?= $content['product']->cover ?>">

                <div class="product-price-box">
                    <div style="margin-top: -55px;" class="product-count w-75">
                        <i class="fal fa-plus plusCounter"></i>
                        <input aria-label="" data-qty type="number" class="text-center form-control py-0 mx-2 w-25"
                               value="1">
                        <i class="fal fa-minus minusCounter"></i>
                    </div>
                    <div data-title="<?= $content["product"]->name ?>"
                         class="title"><?= $content["product"]->name ?></div>
                    <div data-price="<?= $content["product"]->sell_price ?>"
                         class="price my-2"><?= number_format($content["product"]->sell_price) ?><p
                                class="d-inline-block pr-1 m-0">
                            ت</p></div>
                    <button style="margin-top: 45px;" onclick="addToBasket(this)" class="addToCart">افزودن به سبد خرید
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 mt-5 mb-3">
            <p class="text-right h5">محصولات مشابه</p>
        </div>
        <div class="col-md-12 products-list">
            <?php foreach ($content["similar_products"] as $product): ?>
                <div data-rowId="" data-id="<?= $product->product_id ?>" class="product-item pb-5">
                    <a href="<?= base_url("page/product/$product->product_id") ?>"
                       style="text-decoration: none; display: contents">
                        <img data-cover="<?= $product->cover ?>"
                             src="<?= $product->cover ?>" alt="">
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
                        <input aria-label="" data-qty type="number" class="text-center form-control py-0 mx-2 w-25"
                               value="1">
                        <i class="fal fa-minus minusCounter"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>