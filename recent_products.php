<?
$last_product = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
$last_product_run = mysqli_query($conn, $last_product);
?>




<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent
            Products</span></h2>
    <div class="row px-xl-5">
        <? while($get_products_detials = mysqli_fetch_assoc($last_product_run)) {
            $product_id = $get_products_detials['id'];
            $image = "select * from product_images where `product_id` = '$product_id'";
            $image_query_run = mysqli_query($conn, $image);
            $get_image = mysqli_fetch_assoc($image_query_run);
            $pimage = isset($get_image['image']) && $get_image['image']!=""?$get_image['image']:""; 

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden" style="height: 350px;">
                        <img class="img-fluid w-100" src="img/<?= $pimage; ?>" alt="" style="height: 400px;">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" onclick="addtocart('<?= $product_id ?>', event);" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href='#'
                            ><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="detail.php?id=<?= $product_id ?>"><?= $get_products_detials['name'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹
                                <?= $get_products_detials['price'] ?>
                            </h5>
                            <h6 class="text-muted ml-2"><del>₹
                                    <?= $get_products_detials['price'] ?>
                                </del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>

</div>
<!-- Products End -->
<!-- Products End -->
<!-- Products End -->
<script>
    function addtocart(product_id) {
        $.ajax({
            method: "GET",
            url: "add_to_cart.php",
            data: { id: product_id },
            dataType: "json",  // Expect JSON response
            success: function(response) {
                if (response.flag === true) {
                    // Update cart quantity directly without waiting for server response
                    var currentQty = parseInt($("#cart_qty").html());
                    $("#cart_qty").html(currentQty + 1);
                } else {
                    if (response.is_login === 'no') {
                        alert("Sorry! You are not logged in");
                        // Redirect to login page if needed
                    } else {
                        alert("Sorry! Data is not added to the cart");
                    }
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
                alert("AJAX request failed. See the console for more details.");
            }
        });
    }
</script>






<!-- Products End -->