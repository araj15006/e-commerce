<?php
session_start();
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$error = "";
$sucess = "";
$product_id = $_GET['id'];

$get_product_details = "select * from products_size where `product_id` = $product_id";
$get_product_details_run = mysqli_query($conn, $get_product_details);
$activate = mysqli_fetch_assoc($get_product_details_run);

if (isset($_POST['add_size1'])) {

    $size1 = $_POST['add_size1'];
    $size2 = $_POST['add_size2'];
    $size3 = $_POST['add_size3'];
    $size4 = $_POST['add_size4'];
    $size5 = $_POST['add_size5'];
    $size6 = $_POST['add_size6'];

    $size_insert_query = "INSERT INTO `products_size`(`product_id`, `status`, `size1`, `size2`, `size3`, `size4`, `size5`, `size6`) VALUES ('$product_id','1','$size1','$size2','$size3','$size4','$size5','$size6')";
    mysqli_query($conn, $size_insert_query);
}


if (isset($_POST['size1'])) {
    $size1 = $_POST['size1'];
    $size2 = $_POST['size2'];
    $size3 = $_POST['size3'];
    $size4 = $_POST['size4'];
    $size5 = $_POST['size5'];
    $size6 = $_POST['size6'];

    $detials_update_query = "UPDATE `products_size` SET `size1`='$size1',`size2`='$size2',`size3`='$size3',`size4`='size4',`size5`='$size5',`size6`='$size6' WHERE `product_id`='$product_id'";
    $detials_update_run = mysqli_query($conn, $detials_update_query);
}


$get_product_details = "select * from products_size where id = $product_id";
$get_product_details_run = mysqli_query($conn, $get_product_details);


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

    <form accept-charset="UTF-8" action="admin_products.php" method="POST">
        <div class="form-group">

            <?
            if (empty($activate) == false) {
                $product_details = mysqli_fetch_assoc($get_product_details_run)
                    ?>
                <input type="text" name="size1" class="form-control" value="<?= $activate['size1'] ?>"
                    placeholder="Size?">
                <br>
                <input type="text" name="size2" class="form-control" value="<?= $activate['size2'] ?>"
                    placeholder="size">
                <br>
                <input type="text" name="size3" class="form-control" value="<?= $activate['size3'] ?>"
                    placeholder="size">
                <br>
                <input type="text" name="size4" class="form-control" value="<?= $activate['size4'] ?>"
                    placeholder="size">
                <br>
                <input type="text" name="size5" class="form-control" value="<?= $activate['size5'] ?>"
                    placeholder="size">
                <br>
                <input type="text" name="size6" class="form-control" value="<?= $activate['size6'] ?>"
                    placeholder="size">
            <? } 
            if (empty($activate) == true) { ?>

                <input type="text" name="add_size1" class="form-control" placeholder="Size">
                <br>
                <input type="text" name="add_size2" class="form-control" placeholder="size">
                <br>
                <input type="text" name="add_size3" class="form-control" placeholder="size">
                <br>
                <input type="text" name="add_size4" class="form-control" placeholder="size">
                <br>
                <input type="text" name="add_size5" class="form-control" placeholder="size">
                <br>
                <input type="text" name="add_size6" class="form-control" placeholder="size">
            <? } ?>
        </div>
        <hr>
        
                       
                    
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
        <a href="admin_products.php"> <button style="margin-left:77%" type="button" class="btn btn-default">Home</button></a>
    </form>
</div>






</div>
<?
include_once('main-footer.php')
    ?>