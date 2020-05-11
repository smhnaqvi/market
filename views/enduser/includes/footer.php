</div>

<!-- Basket Modal -->
<div class="modal fade" id="basketModal" tabindex="-1" role="dialog" aria-labelledby="basketModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center text-dark w-100" id="exampleModalLongTitle">سبد خرید شما</h5>
            </div>
            <div class="modal-body" id="basketInfo"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">سفارش</button>
            </div>
        </div>
    </div>
</div>


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
            <a data-toggle="modal" data-target="#basketModal">
                <span class="fal fa-shopping-basket"><span class="basket-counter"></span></span>
                <span>سبد خرید</span>
            </a>
        </li>
    </ul>
</footer>

<script src="<?= base_url("assets/library/jquery-3.4.1.min.js") ?>"></script>
<script src="<?= base_url("assets/library/bootstrap/js/popper.min.js") ?>"></script>
<script src="<?= base_url("assets/library/bootstrap/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/js/app.js") ?>"></script>
</body>
</html>



