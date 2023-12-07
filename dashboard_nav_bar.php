<?
session_start();
include_once('database.php') ;
$filename=$_SERVER['REQUEST_URI'];

if (isset($_SESSION['id'])) {

    $login_image = 'images\user_logout.png';
    $location3 = "user_logout.php";

} else {
    $error = '';
    $login_image = 'images\login_image.png';
    $location3 = "user_login.php";
}

$cart_number = 0;
 //$id=$_SESSION['id'];
 if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $cart_num_query = "select * from `cart` where `user_id` = $user_id";
    $cart_num_query_run = mysqli_query($conn,$cart_num_query);
   $cart_number = mysqli_num_rows($cart_num_query_run);
 }
?>


<!-- Topbar Start -->
<div class="container-fluid">

    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="index.php" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+91 82521 79716</h5>
        </div>
    </div>
</div>



<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" href="dashboard.php"
                style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0" style="font-size: 40px;">Dashboard</h6>

            </a>

        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="index.php" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                       <!-- <a href="index.php" class="nav-item nav-link active">home</a>-->
                        <a href="profile.php" class="nav-item nav-link <?php if($filename=="/ecommerce/profile.php"){?> active <?php } ?>">profile</a>
                        <a href="orders.php" class="nav-item nav-link <?php if($filename=="/ecommerce/orders.php"){?> active <?php } ?>">orders</a>
                        <a href="detail.php" class="nav-item nav-link"></a>
                        <div class="nav-item dropdown">
                            <a href="contact.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Help
                                center </a>
                        </div>
                      
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="cart.php" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="cart.php" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;"><?= $cart_number ?></span>
                        </a>
                        <a href=<? echo $location3 ?>>
                            <img src=<? echo $login_image ?> alt="" style="margin: 20px;">
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>