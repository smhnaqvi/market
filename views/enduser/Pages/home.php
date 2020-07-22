<div class="container">
    <!--    slider section -->
    <?php if (isset($content["slider"]) and !empty($content["slider"])): ?>
        <div class="row">
            <div class="col-12">
                <div id="slider" class="carousel slide" data-ride="carousel" style="height: 300px;">
                    <ol class="carousel-indicators">
                        <?php $i = 0;
                        foreach ($content["slider"] as $slide) { ?>
                            <?php if ($i === 0) { ?>
                                <li data-target="#slider" data-slide-to="<?= $i ?>" class="active"></li>
                            <?php } else { ?>
                                <li data-target="#slider" data-slide-to="<?= $i ?>"></li>
                            <?php } ?>
                            <?php $i++;
                        } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $i = 0;
                        foreach ($content["slider"] as $slide) { ?>
                            <div style="background: url('<?= base_url("upload/$slide->value") ?>')"
                                 class="carousel-item slider <?= ($i === 0) ? "active" : "" ?>">
                            </div>
                            <?php $i++;
                        } ?>
                    </div>
                    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!--            <img class="main-banner" src="-->
                <? //= base_url("upload/banner1.jpg") ?><!--" alt="">-->
            </div>
        </div>
        <script>

        </script>
    <?php endif ?>
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="special-offer">
                <img src="<?= base_url("upload/offer1.jpg") ?>" alt="offer1">
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="special-offer">
                <img src="<?= base_url("upload/offer2.jpg") ?>" alt="offer1">
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="special-offer">
                <img src="<?= base_url("upload/offer3.jpg") ?>" alt="offer1">
            </div>
        </div>
    </div>
</div>