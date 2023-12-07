<?

include_once('nav_bar.php');
include_once('database.php');
$user_id = $_SESSION['id'];
$user_name = $_SESSION['name'];
$get_user_data = "select * from user where `id`='$user_id'";
$get_user_data_run = mysqli_query($conn, $get_user_data);
$data = mysqli_fetch_assoc($get_user_data_run);
$array = array();
$detials_query = "select * from cart where `user_id`='$user_id'";
$detials_query_run = mysqli_query($conn, $detials_query);
$cart_id = 1;
while ($featch = mysqli_fetch_assoc($detials_query_run)) {
    $array[] = $featch['product_id'];
}
$amount = 0;
foreach ($array as $am) {
    $amount_query = "select * from products where id = $am";
    $amount_query_run = mysqli_query($conn, $amount_query);
    $a_amount = mysqli_fetch_assoc($amount_query_run);
    $r_amount = $a_amount['price'];
    $amount = intval($amount)+intval($r_amount);


}

if (isset($_POST['first_name'])) {
    $name = $_POST['first_name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $locality = $_POST['locality'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $street = $_POST['street'];
    $pincode = $_POST['pincode'];

    $order_query = "INSERT INTO `orders`(`user_id`,`gross_amount`, `ship_to_name`, `net_amount`, `ship_to_city`, `ship_to_state`, `ship_to_locality`, `ship_to_email`,`order_status`,`Ship_to_pincode`, `ship_to_phone_number`, `ship_to_street`, `ship_to_country`) VALUES ('$user_id','$amount','$name','$amount','$city','$state','$locality','$email','1','$pincode','$number','$street','$country')";
    $order_query_run = mysqli_query($conn, $order_query);
    $orderId = mysqli_insert_id($conn);

    // inserting data in order_details table
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

            $insert_oreder_table = "INSERT INTO `order_details`(`order_id`, `user_id`, `product_id`, `product_name`, `unit_price`, `quantity`,  `product_color`, `total_price`,) VALUES ('$orderId','$user_id','$product_id','$product_name','$product_price','1','$product_color','$product_price')";
            $insert_oreder_table_run = mysqli_query($conn, $insert_oreder_table);

        }


    }
    // inserting data in order_details table
}

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?
    include_once('header.php');
    ?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form class="row px-xl-5" method="post" action="thanks.php">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="First name" name="first_name" required
                                value="<?= $data['name'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Last name" name="last_name" required
                                value="<?= $data['name'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" id="email" type="text" placeholder="example@email.com"
                                name="email" value="<?= $data['e-mail'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" id="number" type="text" placeholder="+123 456 789" name="number"
                                required value="<?= $data['phone_no'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Street</label>
                            <input class="form-control" id="street" type="text" placeholder="Street" name="street"
                                required value="<?= $data['street'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Locality</label>
                            <input class="form-control" id="locality" type="text" placeholder="Locality" name="locality"
                                required value="<?= $data['locality'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select" id="country" name="country" required>
                                <option selected>
                                    <?= $data['country'] ?>
                                </option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" id="city" type="text" placeholder="City" name="city" required
                                value="<?= $data['city'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" id="state" type="text" placeholder="State" name="state" required
                                value="<?= $data['state'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pincode</label>
                            <input class="form-control" id="pincode" type="text" placeholder="Pincode" name="pincode"
                                required value="<?= $data['pincode'] ?>">
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>

                        <!--<input type="submit" class="btn btn-block btn-primary font-weight-bold py-3">-->
                        <form>
                            <input type="hidden" name="name" id="name" value="<?= $user_name ?>"
                                placeholder="Enter your name" /><br /><br />
                            <input type="hidden" name="amt" id="amt" placeholder="Enter amt"
                                value="<?= $amount ?>" /><br /><br />
                            <input type="button" name="btn" id="btn"
                                class="btn btn-block btn-primary font-weight-bold py-3" value="Pay Now"
                                onclick="pay_now()" />
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->


    <?
    include_once('fotter.php')
        ?>



    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <script>
        function pay_now() {
            var name = jQuery('#name').val();
            var amt = jQuery('#amt').val();
            var email = jQuery('#email').val();
            var number = jQuery('#number').val();
            var street = jQuery('#street').val();
            var locality = jQuery('#locality').val();
            var country = jQuery('#country').val();
            var city = jQuery('#city').val();
            var state = jQuery('#state').val();
            var pincode = jQuery('#pincode').val();


            jQuery.ajax({
                type: 'post',
                url: 'payment_process.php',
                data: "amt=" + amt + "&name=" + name + "&email=" + email + "&number=" + number + "&street=" + street + "&locality=" + locality + "&country=" + country + "&city=" + city + "&state=" + state + "&pincode=" + pincode,
                success: function (result) {
                    var options = {
                        "key": "rzp_test_8DF4vc8cMoF4qd",
                        "amount": amt * 100,
                        "currency": "INR",
                        "name": "Payment page",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response) {

                            console.log(Object.entries(response));
                            jQuery.ajax({
                                type: 'post',
                                url: 'payment_process.php',
                                data: "cart_id=<?php echo $cart_id; ?>&payment_id=" + response.razorpay_payment_id,
                                success: function (result) {
                                    //alert("thank you");
                                    window.location.href = "thanks.php";
                                }
                            });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });


        }
    </script>
</body>

</html>