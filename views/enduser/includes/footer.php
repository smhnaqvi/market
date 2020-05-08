<footer>
    <ul>
        <li>
            <a href="<?=base_url('/home')?>">
                <span class="fal fa-home"></span>
                <span>صفحه اصلی</span>
            </a>
        </li>
        <li>
            <a href="<?=base_url('/markets')?>">
                <span class="fal fa-store"></span>
                <span>سوپر مارکت</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/categories') ?>">
                <span class="fal fa-list"></span>
                <span>دسته بندی ها</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/basket') ?>">
                <span class="fal fa-shopping-basket"><span class="basket-counter">12</span></span>
                <span>سبد خرید</span>
            </a>
        </li>
    </ul>
</footer>

<script src="<?= base_url("assets/library/bootstrap/js/jquery-3.2.1.slim.min.js") ?>"></script>
<script src="<?= base_url("assets/library/bootstrap/js/popper.min.js") ?>"></script>
<script src="<?= base_url("assets/library/bootstrap/js/bootstrap.min.js") ?>"></script>
</body>
</html>



