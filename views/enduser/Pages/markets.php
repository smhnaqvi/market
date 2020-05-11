<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($content["markets"] as $item) : ?>
                <div class="card" style="width: 18rem;">
                    <!--                <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body d-flex align-items-center flex-column">
                        <h5 class="card-title w-100 text-center text-info"><?= $item->name ?></h5>
                        <a href="#" class="btn btn-sm btn-info w-100">خرید</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>