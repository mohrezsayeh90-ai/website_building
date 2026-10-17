<?php $this->includeFile('layouts/partials/header');
//echo '<pre/>'; print_r($products);
?>
<div class="main-div-project">
    <div class="project-content">
        <div class="p-2 pb-0">
            <section>
                <h4>مناقصه</h4>
                <div class="owl-carousel owl-theme tend-borders">
                    <?php
                    foreach ($all[0] as $item) { ?>
                        <div class="special-card radial-Gradient-gold" id="card_<?= $item["code"] ?> "
                             ondrop="dropEnd(event)" ondragover="onDrag(event)">
                            <div class="mt-auto mb-auto mx-2">
                                <img src="<?= $this->asset('images/tools.png') ?>" alt="tenders" width="60" height="90">
                            </div>
                            <div class="d-flex flex-column align-items-center w-100">
                                <p aria-label="code"><?= $item['code'] ?></p>
                                <p><?= $item['name'] ?></p>
                                <div class="row m-0 products">
                                    <?php
                                    foreach ($all[2] as $itm) {
                                        if ($item['code'] === $itm['mon_cod']) { ?>
                                            <div class="col-6">
                                                <div class="radial-Gradient-navy rounded-1 me-3 mb-2 p-2 trash-container">
                                                    <span><i class="bi bi-boxes ms-1"></i> <?= $itm['mah_cod'] ?></span>
                                                    <div class="trash-can p-1"><i class="fa fa-trash i-hover-color"
                                                                                  style="color:#f8f8f8"
                                                                                  id="trashTag_<?= $itm['mah_cod'] ?>"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section>
                <h4>محصولات</h4>
                <div class="position-relative pro-borders">
                    <div class="my-scroll-parent">
                        <div class="my-scroll-div">
                            <div class="row m-0 me-5">
                                <?php foreach ($all[1] as $item): ?>
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="special-card radial-Gradient-navy" id="card_<?= $item["code"] ?> "
                                             draggable="true" ondragstart="dragStart(event)">
                                            <div class="mt-auto mb-auto mx-2">
                                                <img src="<?= $this->asset('images/boxes.svg') ?>" alt="products" width="60" height="100">
                                            </div>
                                            <div class="d-flex flex-column w-100 mx-3">
                                                <p>کد محصول:<?= $item["code"] ?> </p>
                                                <p>نام محصول: <?= $item["name"] ?></p>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn p-1 rounded-4 text-primary show-details"
                                                            value="<?= $item["code"] ?>">
                                                        <span>مشاهده ی جزئیات</span>
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <label for="file<?= $item["code"] ?>"
                                                           class="btn rounded-4 text-red">
                                                        <span>آپلود فایل</span>
                                                        <i class="fa fa-file"></i>
                                                    </label>
                                                    <input id="file<?= $item["code"] ?>" type="file" class="upload-file"
                                                           multiple hidden="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</main>
<?php
$this->includeFile('layouts/scripts') ?>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/tender.js'); ?><!--"></script>-->
