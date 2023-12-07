 <?
 @session_start();
 $filename=$_SERVER['REQUEST_URI'];
 //echo $_SESSION['id']."jjj";
//
 include_once("database.php");

 if (isset($_SESSION['id'])){

    $location1 = "profile.php" ;
    $location2 = "orders.php";
    $name1 = 'profile';
    $name2= 'Orders';
    $login_image = 'images\user_logout.png';
    $location3 = "user_logout.php";
    
}else{
    
    $location1 = 'user_login.php' ;
    $location2 = 'user_create_account.php';
    $name1 = 'sing in';
    $name2 = 'sing up';
    $login_image = 'images\login_image.png';
    $location3 = "user_login.php";
 }
 
include_once("database.php");

// this code takes categorys of products present on the website
$query = "SELECT * FROM category";
$runQuery = mysqli_query($conn, $query);
$categorys = array();
$i = '';
while ($result = mysqli_fetch_array($runQuery)) {
    $id = $i;
    $title_id = $result['heading'];
    $categorys[$id] = $title_id;
    $i++;

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
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block" >
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="https://www.linkedin.com/in/ankit-raj-b200ba27a/" style='color:aliceblue'>About</a>
                    <a class="text-body mr-3" href="contact.php" >Contact</a>
                    <a class="text-body mr-3" href="faq.php" style='color:aliceblue'>FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"> My account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href= <?echo $location1?> >
                            <button class="dropdown-item" type="button"><? echo $name1?></button>
                            </a>
                            <a href=<? echo $location2?>>
                            <button class="dropdown-item" type="button"><? echo $name2?></button>
</a>
                        </div>
                    </div>
                    <!-- <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">USD</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">GBP</button>
                            <button class="dropdown-item" type="button">CAD</button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">AR</button>
                            <button class="dropdown-item" type="button">RU</button>
                        </div>
                    </div> -->
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="index.php" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form method="get" action="shop.php">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for products">
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
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><? echo $categorys[''] ?> <i
                                    class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link"><? echo $categorys[''] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[1] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[2] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[3] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[4] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[5] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[6] ?></a>
                        <a href="" class="nav-item nav-link"><? echo $categorys[7] ?></a>
                        
                        
                    </div>
                </nav>
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
                            <a href="index.php" class="nav-item nav-link <?php if($filename=="/ecommerce/index.php"){?> active <?php } ?>">Home</a>
                            <a href="shop.php" class="nav-item nav-link <?php if($filename=="/ecommerce/shop.php"){?> active <?php } ?>">Shop</a>
                            
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i
                                        class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link <?php if($filename=="/ecommerce/contact.php"){?> active <?php } ?>">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="cart.php" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="cart.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" id="cart_qty"
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
    <!-- Navbar End -->
   
    