<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$id = $_GET['id'];

    
$status = "select * from product_images where `id`=$id";
$status_run = mysqli_query($conn,$status);
$status_featch = mysqli_fetch_assoc($status_run);
$product_id = $status_featch['product_id'];
if($status_featch['status']==1){
    $image_upload_query = "UPDATE `product_images` SET `status`='2' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_products_images.php?id=$product_id");
}else{
    $product_id = $status_featch['product_id'];
    $image_upload_query = "UPDATE `product_images` SET `status`='1' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_products_images.php?id=$product_id");
    
}

  
