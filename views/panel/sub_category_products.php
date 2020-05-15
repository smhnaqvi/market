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
                    <td><img class="img-fluid img-thumbnail rounded cover" style="height: 50px"
                             src="<?= base_url('upload/products/') . $item->cover ?>" alt="<?= $item->name ?>"></td>
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
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
