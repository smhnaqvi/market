<div class="row mb-4">
    <div class="alert alert-primary w-75 m-auto text-center" role="alert">
        <?= $content['market']->name ?>
    </div>
</div>
<div class="row">
    <?php $market_id = $content['market']->id; ?>
    <div class="col-md-4 col-sm-12 mb-5">
        <form action="<?= base_url("panel/market/add-product") ?>" method="post">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <label class="input-group-text" for="product_id">لیست محصولات</label>
                </div>
                <select required name="product_id" class="custom-select" id="product_id">
                    <option selected disabled>یک محصول انتخاب کنید</option>
                    <?php foreach ($content["products"]["products"] as $product) : ?>
                        <option value="<?= $product->product_id ?>"><?= $product->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">قیمت مغازه</span>
                </div>
                <input required type="text" class="form-control" name="product_price" aria-label="قیمت مغازه"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">قیمت فروش</span>
                </div>
                <input required type="text" class="form-control" name="product_sell_price" aria-label="قیمت فروش"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <?php if (isset($_SESSION["form_error"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION["form_error"] ?>
                </div>
            <?php } ?>
            <input aria-label="" type="text" name="market_id" hidden value="<?= $market_id ?>">
            <button class="btn btn-success w-100" type="submit">ثبت محصول</button>
        </form>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 text-right">لیست محصولات</h1>
        </div>
        <table class="table text-right" style="direction: rtl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام محصول</th>
                <th scope="col">قیمت فروشگاه</th>
                <th scope="col">قیمت فروش</th>
                <th scope="col">تاریخ بروزرسانی</th>
                <th scope="col">عکس محصول</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;
            foreach ($content["market_products"] as $item) { ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= $item->name ?></td>
                    <td><span class="text-danger"><?= number_format($item->price) ?></span> تومان</td>
                    <td><span class="text-success"><?= number_format($item->sell_price) ?></span> تومان</td>
                    <td><?= $item->updated_at ?></td>
                    <td style="width: 150px;">
                        <img class="img-fluid img-thumbnail rounded cover" style="height: 50px"
                             src="<?= base_url('upload/products/') . $item->cover ?>" alt="<?= $item->name ?>">
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>