<nav class="d-none d-md-flex navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">سوپر ماکت آنلاین</a>
    <div class="align-items-center w-100 pr-4">
        <h6 class="h6 text-right text-light"><?= $title ?></h6>
    </div>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link text-white" style="font-size: 20px" href="<?= base_url("panel/logout") ?>">
                <i class="fal fa-power-off"></i>
            </a>
        </li>
    </ul>
</nav>
<script type="application/javascript">
    const current_url = '<?=current_url()?>';
</script>
<div class="container-fluid">
    <div class="row">
        <nav class="d-md-none d-sm-block navbar navbar-dark bg-dark w-100">
            <button class="nav-link navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fal fa-bars"></span>
            </button>
            <a class="nav-link navbar-toggler" href="<?= base_url("panel/logout") ?>">
                <i class="fal fa-power-off"></i>
            </a>
            <div class="collapse navbar-collapse text-right" id="navbarsExample01">
                <ul class="nav navbar-nav p-2">
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

