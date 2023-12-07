<?php
$feature_query = "select * from category where `status`=1";
$feature_query_run = mysqli_query($conn, $feature_query);
?>

<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">Categories</span></h2>
    <form class="row px-xl-5 pb-3">
        <?php
        while ($feature_collectdata = mysqli_fetch_assoc($feature_query_run)) {
            $category_id = $feature_collectdata['id'];
            $category_heading = $feature_collectdata['heading'];
            $count_query = "select * from products where category_id = $category_id";
            $count_query_run = mysqli_query($conn, $count_query);
            $total_products = mysqli_num_rows($count_query_run);
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="shop.php?search=<?= $category_heading ?>">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img\<?php echo $feature_collectdata['image_name']; ?>" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6><?php echo $feature_collectdata['heading'] ?></h6>
                            <small class="text-body"><?= $total_products ?> Products</small>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </form>
</div>
<!-- Categories End -->
