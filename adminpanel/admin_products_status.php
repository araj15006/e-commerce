<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (isset($_SESSION['id'])) {
    header("location:index.php");
}
$id = $_GET['id'];

    
$status = "select * from products where `id`=$id";
$status_run = mysqli_query($conn,$status);
$status_featch = mysqli_fetch_assoc($status_run);
// $product_id = $status_featch['product_id'];
if($status_featch['status']==1){
    echo $image_upload_query = "UPDATE `products` SET `status`='2' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_products.php");
}else{
    // $product_id = $status_featch['product_id'];
  echo  $image_upload_query = "UPDATE `products` SET `status`='1' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_products.php");
    
}

  
