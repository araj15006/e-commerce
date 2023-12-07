<?php
session_start();
$user_id = $_SESSION['id'];
include('database.php');
$orderId = '' ;
if (isset($_POST['amt']) && isset($_POST['name'])) {
    $amt = $_POST['amt'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $street = $_POST['street'];
    $locality = $_POST['locality'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $payment_status = "pending";
    $added_on = date('Y-m-d h:i:s');

    // getting all products id with cart
    $array = array();
    $detials_query = "select * from cart where `user_id`='$user_id'";
    $detials_query_run = mysqli_query($conn, $detials_query);
    while ($featch = mysqli_fetch_assoc($detials_query_run)) {
        $array[] = $featch['product_id'];
    }
    // getting all products id with cart end

    // inserting data in orders table
    $order_query = "INSERT INTO `orders`(`user_id`,`gross_amount`, `ship_to_name`, `net_amount`, `ship_to_city`, `ship_to_state`, `ship_to_locality`, `ship_to_email`,`payment_method`,`payment_status`,`order_status`,`Ship_to_pincode`, `ship_to_phone_number`, `ship_to_street`, `ship_to_country`) VALUES ('$user_id','$amt','$name','$amt','$city','$state','$locality','$email','online','$payment_status','$payment_status','$pincode','$number','$street','$country')";
    $order_query_run = mysqli_query($conn, $order_query);
    $orderId = mysqli_insert_id($conn);
    $_SESSION['OID'] = mysqli_insert_id($conn);

    if ($orderId > 0) {

        $get_cart_data = "select * from cart where `user_id`='$user_id'";
        $get_cart_data_run = mysqli_query($conn, $get_cart_data);
        while ($cart = mysqli_fetch_assoc($get_cart_data_run)) {
            $product_id = $cart['product_id'];
            $name_query = "select * from `products` where `id` = '$product_id'";
            $name_query_run = mysqli_query($conn, $name_query);
            $a_name = mysqli_fetch_assoc($name_query_run);
            $product_name = $a_name['name'];
            $product_price = $a_name['price'];
            $product_color = $a_name['colour'];

            $insert_oreder_table = "INSERT INTO `order_details`(`order_id`, `user_id`, `product_id`, `product_name`, `unit_price`, `quantity`,  `product_color`, `total_price`,`order_status`,`payment_status`) VALUES ('$orderId','$user_id','$product_id','$product_name','$product_price','1','$product_color','$product_price','$payment_status','$payment_status')";
            $insert_oreder_table_run = mysqli_query($conn, $insert_oreder_table);

        }


    }
    // mysqli_query($conn, "insert into payment(name,amount,payment_status,added_on) values('$name','$amt','$payment_status','$added_on')");
    
    // inserting data in orders table end
}


if (isset($_POST['payment_id']) && isset($_SESSION['OID']) && $_SESSION['OID']>0) {
    $payment_id = $_POST['payment_id'];
    // mysqli_query($conn, "update payment set payment_status='complete',payment_id='$payment_id' where id='" . $_SESSION['OID'] . "'");

    $order_query = "UPDATE `orders` SET `order_status`='success',`payment_status`='success',`payment_id`='$payment_id' where user_id = $user_id and id=".$_SESSION['OID'];
    mysqli_query($conn, $order_query);

    echo $order_details = "UPDATE `order_details` SET `order_status`='success',`payment_status`='success',`payment_id`='$payment_id' WHERE `order_id`=".$_SESSION['OID'];
    $order_details_run = mysqli_query($conn,$order_details);
}
?>

<!-- $order_query = "UPDATE `orders` SET `order_status`='success',`payment_status`='success',`payment_id`='$payment_id' WHERE  user_id=$user_id" -->