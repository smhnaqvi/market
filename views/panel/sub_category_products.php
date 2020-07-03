<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="search-box">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="جستحو کن..." aria-label=""
                           aria-describedby="basic-addon1"
                           value="<?= (isset($_GET["search"]) ? $_GET["search"] : null) ?>">
                    <div class="input-group-prepend">
                        <button class="btn btn-success" type="submit"><i class="fal fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table text-right" style="direction: rtl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام محصول</th>
                <th scope="col">تاریخ ثبت</th>
                <th scope="col">آخرین قیمت ثبت شده</th>
                <th scope="col">عکس</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($content["products"] as $i => $item) { ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= $item->name ?></td>
                    <td><?= $item->created_at ?></td>
                    <td><span class="text-success"><?= number_format($item->sell_price) ?></span> تومان</td>
                    <td><img class="img-fluid img-thumbnail rounded cover" style="height: 50px"
                             src="<?= $item->cover ?>" alt="<?= $item->name ?>"></td>
                    <td>
                        <div class="dropdown show text-left">
                            <i class="fal fa-ellipsis-v text-success pl-2 pr-2" style="font-size: 25px;cursor: pointer"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"></i>
                            <div class="dropdown-menu text-center">
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/product/{$item->product_id}/edit") ?>">ویرایش</a>
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/product/delete/{$item->product_id}") ?>">حذف</a>
                                <a href="#"
                                   onclick="assignProductMarket({product_id: <?= $item->product_id ?>,product_name:'<?= $item->name ?>'})"
                                   class="dropdown-item">افزودن به مغازه</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Assign Product to Market -->
<div style="direction: ltr" class="modal fade" id="assignProductMarket" tabindex="-1" role="dialog"
     aria-labelledby="assignProductMarket"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-center w-100" id="assignProductMarketModalTitle"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="direction: rtl">
                <form action="<?= base_url("panel/market/add-product") ?>" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text" for="market_id">لیست مغازه</label>
                        </div>
                        <select required name="market_id" class="custom-select" id="market_id">
                            <option selected disabled>مغازه را انتخاب کنید</option>
                            <?php foreach ($content["markets"] as $market) : ?>
                                <option value="<?= $market->id ?>"><?= $market->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input hidden aria-label="" type="text" required name="product_id" value="" id="product_id">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">(تومان)قیمت فروشنده</span>
                        </div>
                        <input required type="number" class="form-control" name="product_price"
                               aria-label="قیمت فروشنده"
                               aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">(تومان)قیمت سیستم فروش</span>
                        </div>
                        <input required type="number" class="form-control" name="product_sell_price"
                               aria-label="قیمت سیستم فروش"
                               aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <?php if (isset($_SESSION["form_error"])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION["form_error"] ?>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-center">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary ml-2">ثبت محصول</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="<?= base_url("assets/js/sub_category_products.js") ?>"></script>
