<?php
session_start();

include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$ID = $_GET["id"];

$query = "DELETE FROM contact_us WHERE `id` = $ID" ;
$result = mysqli_query($conn, $query);
header("location:contact_us.php")

?>
