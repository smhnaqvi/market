<div class="py-5 text-center d-none">
    <h2>سفارش محصولات</h2>
    <p class="lead">شما میتوانید براحتی محصولات مورد نیاز خود را از این فروشگاه با قیمتی مناسب و بصورت آنلاین خریداری کنید و درب منزل تحویل بگیرید.</p>
</div>

<div class="row" style="direction: ltr">
    <div class="col-md-7 order-md-2 mb-4">
        <div class="h5 d-flex justify-content-end align-items-center mb-3">
            <span class="text-muted mr-2">سبد خرید</span>
            <div class="badge badge-secondary badge-pill pl-3 pr-3 pb-2 pt-2">
                <span class="d-inline-block">محصول</span>
                <span class="d-inline-block"><?= count($content["basket"]["items"]) ?></span>
            </div>
        </div>
        <ul class="list-group mb-3" style="direction: rtl">
            <?php if (!empty($content["basket"]["items"])) : ?>
                <?php foreach ($content["basket"]["items"] as $product) : ?>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="card w-100">
                            <div data-rowId="<?= $product["rowid"] ?>" data-id="<?= $product["id"] ?>"
                                 class="product-info2">
                                <img data-cover="<?= $product["cover"] ?>" class="product-cover2"
                                     src="<?= $product["cover"] ?>" alt="<?= $product["name"] ?>">
                                <div class="product-price-box">
                                    <h1 data-title="<?= $product["name"] ?>"
                                        class="product-title _font-size"><?= $product["name"] ?></h1>
                                    <h1 data-price="<?= $product["price"] ?>"
                                        class="product-price text-success"><?= number_format($product["price"]) ?>
                                        <span>تومان</span></h1>
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
                                    <button onclick="addToBasket(this)"
                                            class="btn btn-light text-primary pl-1 pr-1  p-0"><i
                                                class="fal fa-repeat"></i></button>
                                    <a href="<?= base_url("basket/removeItem?rowId={$product['rowid']}") ?>"
                                       class="btn btn-light pl-1 pr-1 p-0 text-danger btn-remove-item2"><i
                                                class="fal fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li class="list-group-item d-flex justify-content-center align-items-center">
                <span class="_font-size ml-2">مبلغ کل فاکتور: </span>
                <strong id="setTotalPrice"
                        class="float-right text-success"><?= number_format($content["basket"]["total_price"]) ?></strong>
                <span class="mr-2 _font-size">تومان</span>
            </li>
        </ul>
    </div>
    <div class="col-md-5 order-md-1" style="direction: rtl">
        <h4 class="mb-3"></h4>
        <form class="needs-validation text-right _font-size" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">نام</label>
                    <input type="text" class="form-control _font-size" id="firstName" placeholder="نامت رو وارد کن"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">نام خانوادگی</label>
                    <input type="text" class="form-control _font-size" id="lastName"
                           placeholder="نام فاملی تو را وارد کن"
                           required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="lastName">شماره همراه</label>
                    <input type="number" class="form-control _font-size" id="lastName"
                           placeholder="شماره همراه تو وارد کن"
                           required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address">آدرس تحویل</label>
                    <textarea type="text" class="form-control _font-size" id="address"
                              placeholder="آدرس محل تحویل محصولات رو وارد کن" required></textarea>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-sm btn-block btn-primary" type="submit">پرداخت فاکتور</button>
        </form>
    </div>
</div>