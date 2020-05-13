<div class="row">
    <div class="col-md-4 col-sm-12 mb-5">
        <form action="<?= base_url("panel/category/{$content["category_id"]}/add-new-subcategory") ?>" method="post">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">نام فارسی دسته بندی</span>
                </div>
                <input type="text" class="form-control" name="title" aria-label="Small"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <button class="btn btn-success w-100" type="submit">ثبت دسته</button>
        </form>
    </div>
    <div class="col-md-8 col-sm-12">
        <table class="table text-right" style="direction: rtl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان فارسی</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($content["categories"] as $i => $item) { ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= $item->title ?></td>
                    <td>
                        <div class="dropdown show text-left">
                            <i class="fal fa-ellipsis-v text-success pl-2 pr-2" style="font-size: 25px;cursor: pointer"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"></i>
                            <div class="dropdown-menu text-center">
                                <!--<a class="dropdown-item" href="base_url("panel/category/$item->id/update-subcategory")">ویرایش</a>-->
                                <a class="dropdown-item" href="<?= base_url("panel/category/$item->id/subcategory-products") ?>">محصولات</a>
                            </div>
                            <div class="dropdown-menu text-center">
                                <!--<a class="dropdown-item" href="base_url("panel/category/$item->id/update-subcategory")">ویرایش</a>-->
                                <a class="dropdown-item" href="<?= base_url("panel/category/$item->id/delete-subcategory") ?>">حذف</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
