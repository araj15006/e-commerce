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

    
$status = "select * from banner where `id`=$id";
$status_run = mysqli_query($conn,$status);
$status_featch = mysqli_fetch_assoc($status_run);
if($status_featch['status']==1){
    $image_upload_query = "UPDATE `banner` SET `status`='2' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_banner.php");
}else{
    $image_upload_query = "UPDATE `banner` SET `status`='1' WHERE `id` = $id ";
    $image_upload_run = mysqli_query($conn,$image_upload_query);
    header("location:admin_banner.php");
}

  
