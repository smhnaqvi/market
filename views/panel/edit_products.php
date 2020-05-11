<div class="row">
    <div class="col-md-6 col-sm-12 mb-5 m-auto">
        <form action="<?= base_url("panel/product/update") ?>" enctype="multipart/form-data" method="post">
            <input type="text" value="<?= $content["product"]->id ?>" hidden name="id">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">نام فارسی محصول</span>
                </div>
                <input required type="text" class="form-control" name="name" value="<?= $content["product"]->name ?>"
                       aria-label="Small"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="cover" class="custom-file-input" id="getProductCover">
                    <label class="custom-file-label" for="getProductCover">انتخاب جلد</label>
                </div>
            </div>
            <div class="w-100 d-flex mb-3">
                <img class="img-fluid img-thumbnail rounded cover m-auto" style="object-fit: contain;" src="<?= base_url("upload/products/{$content['product']->cover}") ?>" alt="">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <label class="input-group-text" for="getCategoryId">دسته بندی</label>
                </div>
                <select required name="category_id" class="custom-select" id="getCategoryId">
                    <option value="<?= $content["product"]->category_id ?>" selected disabled><?= $content["product"]->category_title ?></option>
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
                <textarea name="description" class="form-control" aria-label="توضیحات"><?= $content["product"]->description ?></textarea>
            </div>
            <?php if (isset($_SESSION["form_error"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION["form_error"] ?>
                </div>
            <?php } ?>
            <button class="btn btn-success w-100" type="submit">ثبت محصول</button>
        </form>
    </div>
</div>
<script type="application/javascript" src="<?= base_url("assets/js/manage_products.js") ?>"></script>
