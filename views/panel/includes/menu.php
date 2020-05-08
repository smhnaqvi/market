<nav class="d-none d-md-flex navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">سوپر ماکت آنلاین</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?= base_url("panel/logout") ?>">خروج از پنل</a>
        </li>
    </ul>
</nav>
<script type="application/javascript">
    const current_url = '<?=current_url()?>';
</script>
<div class="container-fluid">
    <div class="row">
        <nav class="d-md-none d-sm-block navbar navbar-dark bg-dark w-100">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url("panel") ?>">
                            <span class="fal fa-home"></span>
                            داشبورد
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/market/manage") ?>">
                            <span class="fal fa-store"></span>
                            سوپر ماکت ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/product/manage") ?>">
                            <span class="fal fa-bags-shopping"></span>
                            محصولات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/category/manage") ?>">
                            <span class="fal fa-list"></span>
                            دسته بندی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/order/manage") ?>">
                            <span class="fal fa-shopping-basket"></span>
                            سفارشات
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column p-0 text-right">
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url("panel") ?>">
                            <span class="fal fa-home"></span>
                            داشبورد
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/market/manage") ?>">
                            <span class="fal fa-store"></span>
                            سوپر ماکت ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/product/manage") ?>">
                            <span class="fal fa-bags-shopping"></span>
                            محصولات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/category/manage") ?>">
                            <span class="fal fa-list"></span>
                            دسته بندی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("panel/order/manage") ?>">
                            <span class="fal fa-shopping-basket"></span>
                            سفارشات
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 col-lg-10 pt-3 px-4 mr-auto">
            <div class="align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2 text-right"><?= $title ?></h1>
            </div>
            <?php if (isset($_SESSION["success"])) { ?>
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <?= $_SESSION["success"] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } else if (isset($_SESSION["error"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <?= $_SESSION["error"] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

