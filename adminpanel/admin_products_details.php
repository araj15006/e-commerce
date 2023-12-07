<?php
session_start();
include_once("database.php");
if (!isset($_SESSION['id'])) {
  header("location:index.php");
}
$error = "";
$sucess = "";
$product_id= $_GET['id'];


$category_id_query = "select * from category where status=1";
$category_id_query_run = mysqli_query($conn, $category_id_query);


if (isset($_POST['product_name'])) {
    
    // table data
    $catrgory_id = $_POST['option'];
    $product_name = $_POST['product_name'];
    $color = $_POST['Color'];
    $price = $_POST['price'];
    $short_discription = $_POST['short_discription'];
    $long_discrition = $_POST['long_discrition'];
    $additional_information = $_POST['additional_information'];
    $gender = $_POST['gender'];
    
    // table data end
    
    $detials_update_query = "UPDATE `products` SET `name`='$product_name',`category_id`='$catrgory_id',`colour`='$color',`price`='$price',`short_disc`='$short_discription',`long_disc`='$long_discrition',`information`='$additional_information',`gender`='$gender' WHERE `id`='$product_id'";
  $detials_update_run = mysqli_query($conn, $detials_update_query);
}


$get_product_details = "select * from products where id = $product_id";
$get_product_details_run = mysqli_query($conn,$get_product_details);


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

  <form accept-charset="UTF-8" action="" method="POST">
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
        <option value="1"> Men
        </option>
        <option value="2"> Women
        </option>
        <option value="3"> Unisex
        </option>
      </select >
      <br>
      <? while($product_details=mysqli_fetch_assoc($get_product_details_run)){ ?>
      <input type="text" name="product_name" class="form-control" value="<?= $product_details['name'] ?>" placeholder="Product name">
      <br>
      <input type="text" name="Color" class="form-control" value="<?= $product_details['colour'] ?>" placeholder="Color">
      <br>
      <input type="text" name="price" class="form-control" value="<?= $product_details['price'] ?>" placeholder="Price">
      <br>
      <input type="text" name="short_discription" class="form-control"  value="<?= $product_details['short_disc'] ?>"  placeholder="Short discription">
      <br>
      <input type="text" name="long_discrition" class="form-control" value="<?= $product_details['long_disc'] ?>"  placeholder="long_discription">
      <br>
      <input type="text" name="additional_information" class="form-control" value="<?= $product_details['information'] ?>" placeholder="Additional information">
      <?}?>
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