<nav class="menu">
    <div class="links">
        <a href="<?= base_url() ?>">خانه</a>
        <a href="<?= base_url() ?>categories">دسته بندی کالاها</a>
    </div>
    <div class="links">
        <a href="#" class="fal fa-user"></a>
        <a href="<?= base_url('basket') ?>" class="fal fa-shopping-cart">
            <span class="basket-counter"></span>
        </a>
        <a class="fal fa-search" id="btnSearch"></a>
        <div class="searchBox" style="display: none" id="searchBox">
            <i id="btnCloseSearch" class="fal fa-times"></i>
            <form action="<?= base_url("page/search") ?>" method="GET">
                <input type="search" name="q" placeholder="جستجو" class="i-search">
            </form>
        </div>
    </div>
</nav>
<div class="row">
    <h5 class="h5 w-100 text-right d-none"><?= $title ?></h5>
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