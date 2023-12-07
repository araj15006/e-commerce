<?php
session_start();
include_once("database.php");
$user_id = $_SESSION['id'];

if (isset($_GET['pid']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    $pid = $_GET['pid'];
    $get_user_data = "select * from cart where user_id='$user_id' and product_id=$pid";
    $e = mysqli_query($conn, $get_user_data);
    $r = mysqli_fetch_assoc($e);

    if (isset($r['id'])) {
        $get_user_data = "delete from cart where user_id='$user_id' and product_id=$pid";
        $get_user_data_run = mysqli_query($conn, $get_user_data);

        if ($get_user_data_run == true) {
            $returnArr['flag'] = true;
        }
    }
    header("location:cart.php");
}

include_once('nav_bar.php');
$getting_product_id = "select * from `cart` where `user_id` ='$user_id'";
$product_id_run = mysqli_query($conn, $getting_product_id);
$_product_id = array();
while ($data = mysqli_fetch_assoc($product_id_run)) {
    $_product_id[] = $data['product_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php'); ?>

<body>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <!-- table data showing in table -->
                        <?php
                        foreach ($_product_id as $pi) {
                            $images = "select * from product_images where `product_id`= $pi";
                            $image_run = mysqli_query($conn, $images);
                            $product_image = mysqli_fetch_assoc($image_run);

                            $product_detials = "select * from products where `id` = $pi";
                            $query_run = mysqli_query($conn, $product_detials);
                            $get_detials = mysqli_fetch_assoc($query_run);
                            ?>
                            <tr id="id_<?php echo $pi; ?>">
                                <td class="align-middle"><img src="img/<?= $product_image['image'] ?>" alt=""
                                        style="width: 44px;"> </td>
                                <td>
                                    <?= $get_detials['name'] ?>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">$
                                    <?= $get_detials['price'] ?>
                                </td>
                                <td class="align-middle">
                                    <a href="cart.php?pid=<?php echo $pi; ?>&action=delete">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="flex-shrink-1">Subtotal</h6>
                            <div class="flex-shrink-0"
                                style="overflow: hidden; text-overflow: ellipsis; max-width: 70%;">
                                <?php
                                $total_price = 0;
                                foreach ($_product_id as $pi) {
                                    $product_detials = "select * from products where `id` = $pi";
                                    $query_run = mysqli_query($conn, $product_detials);
                                    $get_detials = mysqli_fetch_assoc($query_run);
                                    ?>
                                    <h6 class="mb-0">$
                                        <?= $get_detials['price'] ?>
                                    </h6>
                                    <?php
                                    $product_price = $get_detials['price'];
                                    $total_price = (int) $total_price + (int) $product_price;
                                } ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium flex-shrink-1">Shipping</h6>
                            <h6 class="font-weight-medium flex-shrink-0">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$
                                <?= $total_price ?>
                            </h5>
                        </div>
                        <a href="checkout.php">
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                                Checkout</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Cart End -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function removeProduct(pid, event) {
            event.preventDefault();

            $.ajax({
                method: "POST",
                url: "delete_cart.php",
                data: { productid: pid }
            })
                .done(function (msg) {
                    if (msg.flag == true) {
                        $("#id_" + pid).remove();
                    } else {
                        alert("Sorry! data is not deleted");
                    }
                });
        }
    </script>

    <?php include_once('fotter.php'); ?>
</body>

</html>