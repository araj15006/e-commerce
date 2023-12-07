<?
include_once('dashboard_nav_bar.php');



if (!isset($_SESSION['id'])) {
    header("location:user_login.php");
}

include_once('database.php');

$user_id = $_SESSION['id'];
$user_name = $_SESSION['name'];

$perPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
echo $page;




// getting products detials
$orderQuery = "SELECT * FROM `order_details` WHERE user_id = $user_id";
$orderExc = mysqli_query($conn, $orderQuery);
$totalrow = mysqli_num_rows($orderExc);
$totalRows = ceil($totalrow / $perPage);



$start = ($page - 1) * $perPage;


// getting products detials
$order_detials_query = "SELECT * FROM `order_details` WHERE user_id = $user_id limit $start,$perPage";
$order_detials_query_run = mysqli_query($conn, $order_detials_query);



// pagenation 



?>

<!DOCTYPE html>
<html lang="en">

<? include_once('header.php') ?>

<body>

    <style>
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
    <?
    include_once('dashboard_nav_bar.php')
        ?>

    <section class="h-100 gradient-custom" style="background-color:white">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-12">
                    <div class="card" style="border-radius: 10px;border:0px">
                        <div class="card-header px-4 py-5" style="background-color:#ffd333;border-radius:10px">
                            <h5 class="text-muted mb-0">Thank you for shopping with us, <span style="color: #a8729a;">
                                    <? echo $user_name ?>
                                </span>!</h5>
                        </div>
                        <div class="card-body p-4" style="background-color:#3d464d;border-radius: 10px">
                            <div class="card shadow-0 border mb-4" style="border-radius: 10px;">
                                <div class="card-body">
                                    <div class="row">
                                        <? while ($get_detials = mysqli_fetch_assoc($order_detials_query_run)) {
                                            $product_id = $get_detials['product_id'];
                                            $images = "select * from product_images where `product_id`= $product_id";
                                            $image_run = mysqli_query($conn, $images);
                                            $product_image = mysqli_fetch_assoc($image_run);
                                            ?>

                                            <div class="col-md-2" style='border-redius:20px;'>
                                                <img src="img\<?= $product_image['image'] ?>" class="img-fluid" alt="Phone">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Name:</p>
                                                <p class="text-muted mb-0">
                                                    <? echo $get_detials['product_name'] ?>
                                                </p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Color:</p>
                                                <p class="text-muted mb-0">
                                                    <? echo $get_detials['product_color'] ?>
                                                </p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Qty:</p>
                                                <p class="text-muted mb-0">
                                                    <? echo $get_detials['quantity'] ?>
                                                </p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Total price:</p>
                                                <p class="text-muted mb-0">
                                                    <? echo $get_detials['total_price'] ?>
                                                </p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Order id:</p>
                                                <p class="text-muted mb-0">
                                                    <? echo $get_detials['order_id'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-2">
                                                <a href='track_order.php'>
                                                    <p class="text-muted mb-0 small">Track Order</p>
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="progress" style="height: 6px; border-radius: 16px;bo">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width:65%; border-radius: 16px; background-color: #ffd333;"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="d-flex justify-content-around mb-1">
                                                    <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                                                    <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .pagination {
                                    border-radius: 25px;
                                }
                            </style>

                            <div class="pagination">
                                <?php
                                if ($totalRows > 1) {
                                    ?>
                                    <a href="#">&laquo;</a>
                                    <?php
                                }
                                for ($i = 1; $i <= $totalRows; $i++) {
                                    ?>
                                    <a <? if ($page == $i) {
                                        echo "style=background-color:#ffd333;";
                                    } ?>
                                        href="orders.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php }

                                if ($totalRows > 1) {
                                    ?>
                                    <a href="#">&raquo;</a>
                                    <?php
                                }
                                ?>
                                <!--<a href="#">&laquo;</a>
  <a href="#">1</a>
  <a href="#" class="active">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>-->
                            </div>


                        </div>
                    </div>
                </div>
    </section>
</body>

</html>