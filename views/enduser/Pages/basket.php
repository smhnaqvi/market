<div class="container">
    <?php if (!empty($content["basket"]["items"])) : ?>
        <?php foreach ($content["basket"]["items"] as $product) : ?>
            <div class="card mb-3">
                <div class="card-body align-items-center p-0">
                    <div data-rowId="<?= $product["rowid"] ?>" data-id="<?= $product["id"] ?>" class="product-info">
                        <img data-cover="<?= $product["cover"] ?>" class="product-cover"
                             src="<?= $product["cover"] ?>" alt="<?= $product["name"] ?>">
                        <div class="product-price-box">
                            <h1 data-title="<?= $product["name"] ?>"
                                class="product-title"><?= $product["name"] ?></h1>
                            <h1 data-price="<?= $product["price"] ?>"
                                class="product-price"><?= number_format($product["price"]) ?><span>تومان</span></h1>
                        </div>

                        <!--                </div>-->
                        <div class="">
                            <div class="product-item-total-price"><?= number_format((int)$product["subtotal"]) ?></div>
                        </div>
                        <div class="product-addCart ml-1">
                            <div class="product-count">
                                <i class="fal fa-plus plusCounter"></i>
                                <input aria-label="" data-qty type="number" class="text-center form-control"
                                       value="<?= $product["qty"] ?>">
                                <i class="fal fa-minus minusCounter"></i>
                            </div>
                            <button onclick="addToBasket(this)" class="btn btn-sm btn-primary pr-3 pl-3 p-0"><i
                                        class="fal fa-check"></i></button>
                        </div>
                        <a href="<?= base_url("basket/removeItem?rowId={$product['rowid']}") ?>"
                           class="text-danger pr-3 pl-3 btn-remove-item"><i class="fal fa-trash"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="card bg-secondary d-flex justify-content-between flex-row align-items-center p-3">
            <div class="total-price text-light">
                <div id="setTotalPrice" class="float-right"><?= number_format($content["basket"]["total_price"]) ?></div>
                <span class="pr-2">تومان</span>
            </div>
            <div class="pay">
                <button class="btn btn-dark">پرداخت</button>
            </div>
        </div>
    <?php else: ?>
        <div style="font-size: 14pt" class="alert alert-warning d-flex justify-content-center align-items-center"
             role="alert">
            سبد خرید خالی است <i style="font-size: 20pt; padding: 0 10px 0 0" class="fal fa-frown text-danger"></i>
        </div>
    <?php endif; ?>
</div>
