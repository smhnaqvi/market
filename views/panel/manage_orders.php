<table class="table text-right" style="direction: rtl">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">آدرس</th>
        <th scope="col">زمان سفارش</th>
        <th scope="col">نوع برداخت</th>
        <th scope="col">وضعیت ارسال</th>
        <th scope="col">وضعیت پرداخت</th>
        <th scope="col"></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($content as $i => $item) : ?>
        <tr>
            <th scope="row"><?= $i + 1 ?></th>
            <td><?= $item->address ?></td>
            <td><?= $item->created_at ?></td>
            <td><?= $item->pay_type ?></td>
            <td><?= $item->is_delivered ?></td>
            <td><?= ($item->is_delivered === '0') ? "<span class='badge badge-danger'>هنوز  ارسال نشده</span>" : "<span class='badge badge-success'>ارسال شده</span>" ?></td>
            <td><?= ($item->is_paid === '0') ? "<span class='badge badge-danger'>پرداخت نشده</span>" : "<span class='badge badge-success'>پرداخت شده</span>" ?></td>
            <td>
                <div class="dropdown show text-left">
                    <i class="fal fa-ellipsis-v text-success pl-2 pr-2"
                       style="font-size: 25px;cursor: pointer"
                       data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"></i>
                    <div class="dropdown-menu text-center">
                        <a class="dropdown-item" href="<?= base_url("panel/order/{$item->id}/delivered") ?>">ارسال
                            شده</a>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>