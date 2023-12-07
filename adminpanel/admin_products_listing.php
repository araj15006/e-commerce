<?php
session_start();
include_once("database.php");
if (!isset($_SESSION['id'])) {
  header("location:index.php");
}
$error = "";
$sucess = "";


$category_id_query = "select * from category where status=1";
$category_id_query_run = mysqli_query($conn, $category_id_query);


if (isset($_POST['product_name'])) {
  
  // table data
  $catrgory_id = $_POST['option'];
  $product_name = $_POST['product_name'];
  $Color = $_POST['Color'];
  $price = $_POST['price'];
  $short_discription = $_POST['short_discription'];
  $long_discrition = $_POST['long_discrition'];
  $additional_information = $_POST['additional_information'];
  $gender = $_POST['gender'];
  $feature_product = $_POST['feature_product'];
  $discount = $_POST['discount'];
  
  // table data end

  $detials_upload_query = "INSERT INTO `products`(`name`,`category_id`, `colour`,`price`, `short_disc`,`long_disc` ,`information`,`gender`,`feature_product`,`offer`) VALUES ('$product_name','$catrgory_id','$Color','$price','$short_discription','$long_discrition','$additional_information','$gender','$feature_product','$discount')";
  $detials_upload_run = mysqli_query($conn, $detials_upload_query);

  // getting product id for image
  $get_product_id = "select * from `products` where `name` = '$product_name' and `price` = '$price' and `short_disc` = 'short_discription'";
  $product_id_run = mysqli_query($conn , $get_product_id);
  $get_id = mysqli_fetch_assoc($product_id_run);


}




include_once("header.php");
include_once("navbar.php");
include_once("sidebar.php");
include_once('content-header.php')
  ?>
<style>
  h1 {
    font-size: 20px;
    margin-top: 24px;
    margin-bottom: 24px;
  }

  img {
    height: 60px;
  }
</style>



<div class="col-md-6 offset-md-3 mt-5">
  <h1>Update category</h1>
  <? if (empty($sucess) == false) { ?>
    <div class="alert alert-success" role="alert">
      <?= $sucess ?>
    </div>
  <? } ?>

  <form accept-charset="UTF-8" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
     
      <label> category </label>
      <select name="option">
      <option value="" > select category
        </option>
        <?php
while($res=mysqli_fetch_assoc($category_id_query_run)){


        ?>
        <option value="<?php echo $res['id']; ?>" > <?php echo $res['heading']; ?>
      </option>
      <?php
      //$category_id= $_POST['option'];

  }

  ?>
      </select>
      <br>
      <label> Gender </label>
      <select name="gender">
        <option value="Shirts"> Men
        </option>
        <option value="Jeans"> Women
        </option>
        <option value="Swimwear"> Unisex
        </option>
      </select >
      </select>
      <br>
      <label> Gender </label>
      <select name="feature_product">
        <option value="1"> In feature
        </option>
        <option value="0"> Not in feature product
        </option>
      </select >
      <br>
      <input type="text" name="product_name" class="form-control" placeholder="Product name">
      <br>
      <input type="text" name="Color" class="form-control" placeholder="Color">
      <br>
      <input type="text" name="price" class="form-control" placeholder="Price">
      <br>
      <input type="text" name="discount" class="form-control" value="If any discount write in percentage" placeholder="If any discount write in percentage">
      <br>
      <input type="text" name="short_discription" class="form-control" placeholder="Short discription">
      <br>
      <input type="text" name="long_discrition" class="form-control" placeholder="long_discription">
      <br>
      <input type="text" name="additional_information" class="form-control" placeholder="Additional information">
    </div>
    <hr>
    <div class="form-group mt-3">
      <label class="mr-2">Upload product image </label>
      <label class="mr-2" style="color:red">
        
      </label>
      <input type="file" name="file">
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">
     Submit
    </button>
    <a href="admin_products.php"> <button style="margin-left:76%" type="button" class="btn btn-default">Home</button></a>
  </form>
</div>
</div>
<?
include_once('main-footer.php')
  ?>