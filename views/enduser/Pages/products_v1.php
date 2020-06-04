<div class="search-box">
    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="جستحو کن..." aria-label=""
                   aria-describedby="basic-addon1"
                   value="<? //= (isset($_GET["search"]) ? $_GET["search"] : null) ?>">
            <div class="input-group-prepend">
                <button class="btn btn-success" type="submit"><i class="fal fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <?php if (!empty($content["products"]["products"])) : ?>
        <div class="col-md-4 col-sm-12">
            <?php foreach ($content["products"]["products"] as $product) : ?>
                <div class="card mb-3">
                    <div class="card-body align-items-center p-0">
                        <div data-rowId="" data-id="<?= $product->product_id ?>" class="product-info">
                            <a href="<?= base_url("page/product/$product->product_id") ?>"
                               style="text-decoration: none; display: contents">
                                <img data-cover="<?= $product->cover ?>" class="product-cover"
                                     src="<?= $product->cover ?>" alt="<?= $product->name ?>">
                                <div class="product-price-box">
                                    <h1 data-title="<?= $product->name ?>"
                                        class="product-title _font-size"><? //= $product->name ?></h1>
                                    <h1 data-price="<?= $product->sell_price ?>"
                                        class="product-price"><?= number_format($product->sell_price) ?>
                                        <span>تومان</span>
                                    </h1>
                                </div>
                            </a>
                            <div class="product-addCart">
                                <div class="product-count">
                                    <i class="fal fa-plus plusCounter"></i>
                                    <input aria-label="" data-qty type="number" class="text-center form-control"
                                           value="1">
                                    <i class="fal fa-minus minusCounter"></i>
                                </div>
                                <button onclick="addToBasket(this)" class="btn btn-sm btn-light"
                                        style="font-size: 15px;"><i
                                            class="fal fa-cart-plus px-2 text-success"></i>
                                </button>
                            </div>
                        </div>
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
