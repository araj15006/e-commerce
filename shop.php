<!DOCTYPE html>
<html lang="en">

<? include_once('header.php'); ?>

<body>
    <?
//print_r($_SERVER) ;
$color=[];
if(isset($_GET['color'])){
    $colorval = $_GET['color'];
    $color = explode(",",$colorval);
    
}
echo $offer = '';
if(isset($_GET['offer'])){
    $offer = $_GET['offer'];
}


$size=[];
if(isset($_GET['size'])){
     $sizeval = urldecode($_GET['size']);
   
    $size = explode(",",$sizeval);
    
}



    include_once('nav_bar.php');

    $price = "";
    $where = ' where 1 ';
    if (isset($_GET['offer'])) {
        $price = $_GET['offer'];
        $where .= "and p.offer = $offer";
    }


    if (isset($_GET['price'])) {
        $price = $_GET['price'];

        $pexplode = explode("-", $price); //0-100-9-88
    
        $start = $pexplode[0];
        $end = $pexplode[1];

        $where .= " and p.price between $start and $end";
    }
    
    if (isset($_GET['size'])) {
        $sizeval = $_GET['size'];
        $pexplode = explode(",", $sizeval); //array
        $sizes = "'".implode("','",$pexplode)."'"; // string
      

        $where .= " and ps.size1 in($sizes) or ps.size2 in($sizes)";
    }
    if (isset($_GET['color'])) {
        $colorval = $_GET['color'];
        $pexplode = explode(",", $colorval); //array
        $colors = "'".implode("','",$pexplode)."'"; // string
      

        $where .= " and p.colour in($colors)";
    }

    if ($_GET['search'] ?? 0) {

        $where .= ' and c.heading like "%' . $_GET['search'] . '%" or p.name like "%' . $_GET['search'] . '%"';
    }
   
        if ($_GET['catid'] ?? 0) {

        $where .= ' and c.id=' . $_GET['catid'];
    }

   $count_product = "SELECT p.id,p.price,p.name,p.offer FROM products p inner join category c inner join products_size ps on c.id=p.category_id " . $where." group by p.id";

    $perPage = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;


 //   $orderQuery = "SELECT p.id,p.price,p.name FROM products p inner join category c on c.id=p.category_id inner join products_size ps on ps.product_id=p.id " . $where;
    $orderExc = mysqli_query($conn, $count_product);
    $totalrow = mysqli_num_rows($orderExc);
    $totalRows = ceil($totalrow / $perPage);
    $start = ($page - 1) * $perPage;



    $shop_product = "SELECT p.id,p.price,p.name,p.offer FROM products p inner join category c on c.id=p.category_id inner join products_size ps " . $where ." group by p.id". "          limit $start,$perPage";
    $shop_product_run = mysqli_query($conn, $shop_product);
    $number_of_products = mysqli_num_rows($shop_product_run);

    if ($number_of_products > 0) {
        $null = "4932234785null.jpg";
    }

    ?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="price" class="custom-control-input" checked id="price-all"
                                value="0-10000000000" onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="price" class="custom-control-input" id="price-1" value="0-100"
                                onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="price" class="custom-control-input" id="price-2" value="100-200"
                                onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="price" class="custom-control-input" id="price-3" value="200-300"
                                onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="price" class="custom-control-input" id="price-4" value="300-400"
                                onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="radio" name="price" class="custom-control-input" id="price-5" value="400-500"
                                onclick="applyFilter(this)">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"  id="color-all" name="color"
                                value="" onclick="colorFilter(this)" >
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1" name="color" value="black"
                                onclick="colorFilter(this)" <?php if(in_array("black",$color)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="color" value="white" id="color-2"
                                onclick="colorFilter(this)" <?php if(in_array("white",$color)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="color" value="red" id="color-3"
                            onclick="colorFilter(this)" <?php if(in_array("red",$color)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="color" value="blue" id="color-4"
                            onclick="colorFilter(this)" <?php if(in_array("blue",$color)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" name="color" value="green" id="color-5"
                            onclick="colorFilter(this)" <?php if(in_array("green",$color)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all" onclick="Filter(this)">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="size" value="XS" id="size-1" onclick="sizeFilter(this)" <?php if(in_array("XS",$size)) { ?>checked<?php } ?> >
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"  name="size" value="S" id="size-2" onclick="sizeFilter(this)" <?php if(in_array("S",$size)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="size" value="M" id="size-3" onclick="sizeFilter(this)" <?php if(in_array("M",$size)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="size" value="L" id="size-4" onclick="sizeFilter(this)" <?php if(in_array("L",$size)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input"  name="size" value="XL" id="size-5" onclick="sizeFilter(this)" <?php if(in_array("XL",$size)) { ?>checked<?php } ?>>
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                    while ($collect_data = mysqli_fetch_assoc($shop_product_run)) {
                        $product_id = $collect_data['id'];
                        $image = "select * from product_images where `product_id` = '$product_id'";
                        $image_query_run = mysqli_query($conn, $image);
                        $get_image = mysqli_fetch_assoc($image_query_run);
                        ?>
                        <?
                        if ($number_of_products <= 0) { ?>
                            <img src="4932234785null.jpg" alt="">

                        <? } ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" style="inline-size: 150px; ">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden" style="height: 350px;">
                                    <img class="img-fluid w-100" src="img/<?= $get_image['image'] ?>" alt=""
                                        style="height: 400px;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <div style="word-wrap: break-word;">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="detail.php?id=<?= $collect_data['id'] ?>"><?= $collect_data['name'] ?></a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>
                                            <?= $collect_data['price'] ?>
                                        </h5>
                                        <h6 class="text-muted ml-2"><del>
                                                <?= $collect_data['price'] ?>
                                            </del></h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <? } ?>


                    <form method="get" class="col-12">
                        <nav>
                            <?
                            $page = 1;
                            while ($totalRows >= $page) {
                                ?>
                                <ul class="pagination justify-content-center">
                                    <!-- <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li> -->
                                    <button name="page" value="<?= $page ?>">1</button>

                                    <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                                </ul>
                                <?
                                $page = $page + 1;
                            } ?>
                        </nav>
                        </from>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    <script>
        function applyFilter(obj) {
            var queryParams = new URLSearchParams(window.location.search);
               var markedCheckbox = document.getElementsByName('price');
                var checkboxvalue="";
                for (var checkbox of markedCheckbox) {
                    if (checkbox.checked){
                        if(checkboxvalue==""){
                            checkboxvalue = checkbox.value; 
                        }
                        else{
                            checkboxvalue = checkboxvalue+","+checkbox.value; 
                        }
                        
                    }                
                }
                queryParams.set("price", checkboxvalue);
               window.location.href = "shop.php?" +  queryParams.toString(); 
               
            }
        
       

            function colorFilter(col) {
                var queryParams = new URLSearchParams(window.location.search);
               var markedCheckbox = document.getElementsByName('color');
                var checkboxvalue="";
                for (var checkbox of markedCheckbox) {
                    if (checkbox.checked){
                        if(checkboxvalue==""){
                            checkboxvalue = checkbox.value; 
                        }
                        else{
                            checkboxvalue = checkboxvalue+","+checkbox.value; 
                        }
                        
                    }                
                }
                queryParams.set("color", checkboxvalue);
               window.location.href = "shop.php?" +  queryParams.toString(); 
               
            }
            
            function sizeFilter(size) {
                var queryParams = new URLSearchParams(window.location.search);
               
               // var pricevalue = col.value;
               var markedCheckbox = document.getElementsByName('size');
                var checkboxvalue="";
                for (var checkbox of markedCheckbox) {
                    if (checkbox.checked){
                        if(checkboxvalue==""){
                            checkboxvalue = checkbox.value; 
                        }
                        else{
                            checkboxvalue = checkboxvalue+","+checkbox.value; 
                        }   
                    }
                }
                queryParams.set("size", checkboxvalue);
               window.location.href = "shop.php?" +  queryParams.toString();   
            }
            
 
    </script>

    <? include_once('fotter.php') ?>


</body>

</html>