<?php foreach ($content["products"] as $product) : ?>
    <div class="card mb-3">
        <div  class="card-body align-items-center p-0">
            <img data-cover="<?= base_url("upload/products/" . $product->cover) ?>" class="product-cover mr-2" src="<?= base_url("upload/products/" . $product->cover) ?>" alt="">
            <div data-id="<?= $product->id ?>" class="product-info">
                <h1 data-title="<?= $product->name ?>" class="product-title"><?= $product->name ?></h1>
                <h1 data-price="<?= $product->sell_price ?>" class="product-price"><?= number_format($product->sell_price) ?><span>تومان</span></h1>
            </div>
            <div class="product-addCart">
                <div class="product-count">
                    <i class="fal fa-plus plusCounter"></i>
                    <input aria-label="" data-qty type="number" class="text-center form-control" value="1">
                    <i class="fal fa-minus minusCounter"></i>
                </div>
                <button onclick="addToBasket(this)" class="btn btn-sm btn-primary" style="font-size: 12px;"><i class="fal fa-shopping-basket ml-2"></i>افزودن</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>