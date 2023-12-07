<?php
session_start();

include_once('database.php');
$user_id = $_SESSION['id']; 
$pid = $_POST['productid'];


$returnArr = array("flag"=>false);


$get_user_data = "select * from cart where user_id='$user_id' and product_id=$pid";
$e = mysqli_query($conn,$get_user_data);
$r = mysqli_fetch_assoc($e);


if(isset($r['id'])){
    $get_user_data = "delete from cart where user_id='$user_id' and product_id=$pid";
    $get_user_data_run = mysqli_query($conn,$get_user_data);

    if($get_user_data_run==true){
        $returnArr['flag'] = true;
    }
}
header("content-Type:application/json");
echo json_encode($returnArr);exit;
