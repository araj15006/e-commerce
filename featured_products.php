<style>
    .img-fluid:hover {
        cursor: pointer;
        background: rgba(255, 255, 255, 0.7);
    }
</style>


<?
$feature_product = "select * from `products` where `feature_product` = '1' and `status` ='1' ORDER BY id DESC LIMIT 4";
$feature_product_run = mysqli_query($conn, $feature_product)

    ?>
<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">Upcomming</span></h2>
    <div class="row px-xl-5">
        <?
        while ($feature = mysqli_fetch_assoc($feature_product_run)) {
            $product_id = $feature['id'];
            $image_query = "select * from product_images where `product_id`= '$product_id'";
            $image_query_run = mysqli_query($conn, $image_query);
            $image_name = mysqli_fetch_assoc($image_query_run);

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden" style="height: 350px;">
                        <img class="img-fluid w-100" src="img/<?= $image_name['image'] ?>" alt="" style="height: 400px;">
                        <div class="product-action">
                    </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate"
                            href="detail.php?id=<?= $product_id ?>&upcomming=<?= $feature['name'] ?>">
                            <?= $feature['name'] ?>
                        </a>

                        <!-- <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div> -->
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>
<!-- Products End -->