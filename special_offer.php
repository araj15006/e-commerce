 <!-- Offer Start -->
 <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">

        <?
            $offer_query = "select * from special_offer_down where status = 1";
            $offer_query_run = mysqli_query($conn,$offer_query);
            while($offer_collectdata = mysqli_fetch_assoc($offer_query_run)){
            ?>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/<? echo $offer_collectdata['image_name']; ?>" alt="">
                    <div class="offer-text">
                        <h3 class="text-white mb-3"><? echo $offer_collectdata['title'] ?></h3>
                        <h6 class="text-white text-uppercase">Save <? echo $offer_collectdata['offer_percentage'] ?>%</h6>
                        <a href="shop.php?offer=<?= $offer_collectdata['offer_percentage']  ?>" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            
            <? } ?>
            
        </div>
    </div>
    <!-- Offer End -->