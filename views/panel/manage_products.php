<div class="row">
    <div class="col-md-4 col-sm-12 mb-5">
        <form action="<?= base_url("panel/product/add-new") ?>" enctype="multipart/form-data" method="post">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">نام فارسی محصول</span>
                </div>
                <input required type="text" class="form-control" name="name" aria-label="Small"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input required type="file" name="cover" class="custom-file-input" id="getProductCover">
                    <label class="custom-file-label" for="getProductCover">انتخاب جلد</label>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <label class="input-group-text" for="getCategoryId">دسته بندی</label>
                </div>
                <select required name="category_id" class="custom-select" id="getCategoryId">
                    <option value="" selected disabled>انتخاب کنید</option>
                    <?php foreach ($content["categories"] as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->title ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <label class="input-group-text" for="getSubCategoryId">انتخاب زیر دسته</label>
                </div>
                <select required name="subcategory_id" class="custom-select" id="getSubCategoryId"></select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">توضیحات</span>
                </div>
                <textarea name="description" class="form-control" aria-label="توضیحات"></textarea>
            </div>
            <?php if (isset($_SESSION["form_error"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION["form_error"] ?>
                </div>
            <?php } ?>
            <button class="btn btn-success w-100" type="submit">ثبت محصول</button>
        </form>
    </div>
    <div class="col-md-8 col-sm-12">
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
                                <a class="dropdown-item" href="<?= base_url("panel/product/{$item->id}/edit") ?>">ویرایش</a>
                                <a class="dropdown-item" href="<?= base_url("panel/product/delete/{$item->id}") ?>">حذف</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="application/javascript" src="<?= base_url("assets/js/manage_products.js") ?>"></script>
