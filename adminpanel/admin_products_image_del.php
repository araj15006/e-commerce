<?php
session_start();

include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$ID = $_GET["id"];

$product_id = "select * from product_images where `id`=$ID";
$product_id_run = mysqli_query($conn,$product_id);
$product_id_featch = mysqli_fetch_assoc($product_id_run);
$product_id = $product_id_featch['product_id'];

$query = "DELETE FROM product_images WHERE `id` = $ID" ;
$result = mysqli_query($conn, $query);
header("location:admin_products_images.php?id=$product_id")

?>
