<?
if(isset($_SESSION['id']))
{
	header("location:user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<? include_once('header.php'); ?>
<body>
    
<?
include_once('dashboard_nav_bar.php');
$user_id = $_SESSION['id'];
$order_detials_query = "SELECT * FROM `orders` WHERE user_id = $user_id";
$order_detials_query_run = mysqli_query($conn, $order_detials_query);
$track_detials = mysqli_fetch_assoc($order_detials_query_run);

?>
<div class="container mt-4 mb-4">
    <div class="row d-flex cart align-items-center justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="d-flex justify-content-center border-bottom">
                    <div class="p-3">
                        <div class="progresses">
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span class="font-weight-bold">3</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 border-right p-5">
                        <div class="text-center order-details">
                            <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span> <span class="font-weight-bold">Order Confirmed</span> <small class="mt-2">Your illustraion will go to you soon</small> <a href="#" class="text-decoration-none invoice-link">View Invoice</a> <a href='orders.php'></div> <button class="btn btn-danger btn-block order-button" style='background-color:#ffd333;'>Go to your Order</button>
                            <br>

                            <a href='index.php'>
                            <button class="btn btn-danger btn-block order-button" style='background-color:#ffd333;'>Home</button>
</a>
                            
                        </div>
                    </div>
                    <div class="col-md-6 background-muted">
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> 3 days delivery</span> <span><i class="fa fa-refresh text-muted"></i> 2 Max Revisions</span> </div>
                            <div class="mt-3">
                                <h6 class="mb-0"><?= $track_detials['ship_to_name'] ?></h6> <span class="d-block mb-0">Mob:<?= $track_detials['ship_to_phone_number'] ?> <br> <?=$track_detials['ship_to_street']?>  <?=$track_detials['ship_to_locality']?> <?= $track_detials['ship_to_city'] ?><br> <?= $track_detials['ship_to_state'] ?> <?= $track_detials['ship_to_state'] ?> <?= $track_detials['Ship_to_pincode'] ?></span> <small>Min: 1 illustraion</small>
                                <div class="d-flex flex-column mt-3"> <small><i class="fa fa-check text-muted"></i> Vector file</small> <small><i class="fa fa-check text-muted"></i> Sources files</small> </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>x3</span> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>$20 per unit</span> </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>$60</span> </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Processing fees</span> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>$1.80</span> </div>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">$61.80</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div> </div>
            </div>
        </div>
    </div>
</div>
<?
  
    include_once('fotter.php');
    ?>

</body>