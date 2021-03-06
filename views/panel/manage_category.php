<div class="row">
    <div class="col-md-4 col-sm-12 mb-5">
        <?php if (isset($content["category"]) and !empty($content["category"])): ?>
            <form action="<?= base_url("panel/category/update") ?>" enctype="multipart/form-data" method="post">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">نام فارسی دسته بندی</span>
                    </div>
                    <input type="text" hidden name="id" value="<?= $content["category"]->id ?>">
                    <input type="text" class="form-control" name="title" aria-label="Small"
                           value="<?= $content["category"]->title ?>"
                           aria-describedby="inputGroup-sizing-sm">
                </div>
                <?php if (isset($content["category"]->cover) and !empty($content["category"]->cover)): ?>
                    <div class="mb-3">
                        <img class="img-thumbnail img-fluid"
                             src="<?= base_url("upload/category/" . $content["category"]->cover) ?>"
                             alt="<?= $content["category"]->cover ?>">
                    </div>
                <?php endif; ?>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="cover" value="<?= $content["category"]->cover ?>"
                               class="custom-file-input" id="getCategoryCover">
                        <label class="custom-file-label" for="getProductCover">انتخاب کاور</label>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">توضیحات</span>
                    </div>
                    <textarea name="description" class="form-control"
                              aria-label="توضیحات"><?= $content["category"]->description ?></textarea>
                </div>
                <?php if (isset($_SESSION["form_error"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION["form_error"] ?>
                    </div>
                <?php } ?>
                <button class="btn btn-success w-100" type="submit">ثبت دسته</button>
            </form>
        <?php else: ?>
            <form action="<?= base_url("panel/category/add-new") ?>" enctype="multipart/form-data" method="post">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">نام فارسی دسته بندی</span>
                    </div>
                    <input type="text" class="form-control" name="title" aria-label="Small"
                           aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input required type="file" name="cover" class="custom-file-input" id="getCategoryCover">
                        <label class="custom-file-label" for="getProductCover">انتخاب کاور</label>
                    </div>
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
                <button class="btn btn-success w-100" type="submit">ثبت دسته</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="col-md-8 col-sm-12">
        <table class="table text-right" style="direction: rtl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان فارسی</th>
                <th scope="col">توضیحات</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($content["categories"] as $i => $item) { ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><img class="img-thumbnail" style="width: 150px; object-fit: cover"
                             src="<?= base_url("upload/category/$item->cover") ?>"
                             alt="<?= $item->cover ?>"></td>
                    <td><?= $item->title ?></td>
                    <td>
                        <div class=" dropdown show text-left">
                            <i class="fal fa-ellipsis-v text-success pl-2 pr-2" style="font-size: 25px;cursor: pointer"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"></i>
                            <div class="dropdown-menu text-center">
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/category/$item->id/manage-subcategories") ?>">مدریت زیر
                                    دسته</a>
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/category/$item->id/edit") ?>">ویرایش</a>
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/category/$item->id/delete") ?>">حذف</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
