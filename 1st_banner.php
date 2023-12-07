<?php
$banner_query = "select * from banner where `status`= 1";
$banner_query_run = mysqli_query($conn, $banner_query);
$collectData = [];
while ($banner_featch = mysqli_fetch_assoc($banner_query_run)) {
    $collectData[] = $banner_featch;
}
?>

<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">

                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <?php
                    for ($i = 1; $i < count($collectData); $i++) {
                        echo ' <li data-target="#header-carousel" data-slide-to="' . $i . '"></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($collectData as $banner_featch) :
                    ?>

                    <div class="carousel-item position-relative <?php if ($i == 0) { ?>active <?php } ?>"
                        style="height: 430px;">
                        <a href="shop.php?offer=<?php echo $banner_featch['disc']; ?>">
                            <img class="position-absolute w-100 h-100"
                                src="img/<?php echo $banner_featch['image_name']; ?>" style="object-fit: cover; "
                                width=20% alt="">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        <?php echo $banner_featch['title']; ?>
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        <?php echo $banner_featch['disc']; ?>% OFF
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        $i = $i + 1;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <?php
            $offer_query = "select * from special_offer";
            $offer_query_run = mysqli_query($conn, $offer_query);
            while ($offer_collectdata = mysqli_fetch_assoc($offer_query_run)) :
            ?>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="img/<?php echo $offer_collectdata['image_name'] ?>" alt="">
                <div class="offer-text">
                    <h3 class="text-white mb-3"><?php echo $offer_collectdata['title'] ?></h3>
                    <h6 class="text-white text-uppercase">Save <?php echo $offer_collectdata['offer_percentage'] ?>%</h6>
                    <a href="shop.php?offer=<?php echo $offer_collectdata['offer_percentage'] ?>"
                        class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<!-- Carousel End -->
