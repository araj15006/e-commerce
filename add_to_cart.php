
<?php
session_start();


?>


<?php

// Initialize $returnArr
$returnArr = array();

if (!isset($_SESSION['id'])) {
    $returnArr['is_login'] = 'no';
    $returnArr['flag'] = false;
    header('Access-Control-Allow-Origin: user_login.php');
    echo json_encode($returnArr);
    exit;
}

include_once('database.php');

$product_id = $_GET['id'];
$user_id = $_SESSION['id'];

$cart_query = "INSERT INTO `cart`(`user_id`, `product_id`) VALUES ('$user_id','$product_id')";
$add_data = mysqli_query($conn, $cart_query);

if ($add_data) {
    $get_numbers = "SELECT * FROM cart WHERE user_id = $user_id";
    $run_query = mysqli_query($conn, $get_numbers);
    $numbers = mysqli_num_rows($run_query);

    $returnArr['flag'] = true;
    $returnArr['cart_total_qty'] = $numbers;
} else {
    $returnArr['flag'] = false;
}

echo json_encode($returnArr);
exit;

if (!isset($_SESSION['id'])) {
    header("Location: user_login.php");
    exit;
}
?>
