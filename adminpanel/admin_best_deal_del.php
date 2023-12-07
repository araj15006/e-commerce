<?php
session_start();

include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$ID = $_GET["id"];

$query = "DELETE FROM special_offer_down WHERE `id` = $ID" ;
$result = mysqli_query($conn, $query);
header("location:admin_best_deal.php")

?>
