<div class="row">
    <div class="col-md-4 col-sm-12 mb-5">
        <form action="<?= base_url("panel/market/add-new") ?>" method="post">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">نام مغازه</span>
                </div>
                <input required type="text" class="form-control" name="name" aria-label="نام مغازه"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">نام مالک</span>
                </div>
                <input required type="text" class="form-control" name="owner_name" aria-label="نام مالک"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">شماره تماس</span>
                </div>
                <input required type="number" minlength="0" class="form-control" name="phone_number"
                       aria-label="شماره تماس"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">آدرس مغازه</span>
                </div>
                <textarea name="address" class="form-control" aria-label="آدرس مغازه"></textarea>
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
<hr>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 text-right">لیست مغازه ها</h1>
        </div>
        <table class="table text-right" style="direction: rtl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام مغازه</th>
                <th scope="col">نام مالک</th>
                <th scope="col">شماره تلفن مغازه</th>
                <th scope="col">آدرس مغازه</th>
                <th scope="col">تاریخ ثبت</th>
                <th scope="col">وضعیت</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($content["markets"] as $i => $item) { ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= $item->name ?></td>
                    <td><?= $item->owner_name ?></td>
                    <td><?= $item->phone_number ?></td>
                    <td><?= $item->address ?></td>
                    <td><?= $item->created_at ?></td>
                    <td>
                        <?php if ($item->is_active): ?>
                            <span class="badge badge-success">فعال</span>
                        <?php else: ?>
                            <span class="badge badge-danger">غیر فعال</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="dropdown show">
                            <i class="fal fa-ellipsis-v text-success pl-2 pr-2" style="font-size: 25px;cursor: pointer"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"></i>
                            <div class="dropdown-menu text-center">
                                <a class="dropdown-item" href="<?= base_url("panel/market/$item->id/products") ?>">افزودن
                                    محصول</a>
                                <a class="dropdown-item"
                                   href="<?= base_url("panel/market/$item->id/edit") ?>">ویرایش</a>
                                <a class="dropdown-item" href="<?= base_url("panel/market/$item->id/delete") ?>">حذف</a>
                                <a class="dropdown-item"
                                   href="<?php $state = ($item->is_active) ? 0 : 1; echo base_url() . "panel/market/$item->id/activation?state=$state" ?>">
                                    <?php if (!$item->is_active): ?>
                                        <span class="badge badge-success w-100">فعال کردن</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger w-100">غیر فعال کردن</span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>