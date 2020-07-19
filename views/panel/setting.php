<div class="card bg-light mb-3 text-dark">
    <div class="card-header bg-light mb-3 text-dark text-right">
        <span><i class="fa fa-image"></i> مدیریت اسلایدر</span>
    </div>
    <div class="row">
        <div class="col-3 p-3">
            <form action="<?= base_url("panel/setting/uploadNewSlide") ?>" method="POST"
                  enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="slide">
                        <label class="custom-file-label" for="getProductCover">انتخاب اسلاید جدید</label>
                    </div>
                </div>
                <button class="btn btn-success w-100" type="submit">ثبت اسلاید</button>
            </form>
        </div>
        <div class="col-9">
            <table class="table text-right" style="direction: rtl">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">عکس</th>
                    <th scope="col">موفقیت</th>
                    <th scope="col">صفحه</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($content["home_slider"] as $i => $item) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <img class="img-fluid img-thumbnail rounded cover" style="height: 50px"
                                 src="<?= base_url('upload/') . $item->value ?>" alt="<?= $item->value ?>">
                        </td>
                        <td width="100"><?= $item->position ?></td>
                        <td width="100"><?= $item->page ?></td>
                        <td width="20">
                            <a class="dropdown-item p-0"
                               href="<?= base_url("panel/setting/removeSlide/{$item->id}") ?>"><span
                                        class="text-danger fa fa-trash"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
