<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$error = "";
$sucess = "";

$product_id = $_GET['id'];
if (empty($_FILES['file1']['name']) == false) {

    $file = $_FILES['file1']['name'];
    $file_location = $_FILES['file1']['tmp_name'];
    $file_name = rand() . time() . $file;
    $dest_path = "../img/";
    $move_file = move_uploaded_file($file_location, $dest_path . $file_name);

    // updating data into our data base
    $image_upload_query = "INSERT INTO `product_images`(`image`,`product_id`) VALUES ('$file_name','$product_id')";
    $image_upload_run = mysqli_query($conn, $image_upload_query);

    if ($move_file == true) {
        $sucess1 = "file sucessfully uplodae";
    }

}

if (empty($_FILES['file2']['name']) == false) {

    $file = $_FILES['file2']['name'];
    $file_location = $_FILES['file2']['tmp_name'];
    $file_name = rand() . time() . $file;
    $dest_path = "../img/";
    $move_file = move_uploaded_file($file_location, $dest_path . $file_name);

    // updating data into our data base
    $image_upload_query = "INSERT INTO `product_images`(`image`,`product_id`) VALUES ('$file_name','$product_id')";
    $image_upload_run = mysqli_query($conn, $image_upload_query);

    if ($move_file == true) {
        $sucess2 = "file sucessfully uplodae";
    }
}

if (empty($_FILES['file3']['name']) == false) {

    $file = $_FILES['file3']['name'];
    $file_location = $_FILES['file3']['tmp_name'];
    $file_name = rand() . time() . $file;
    $dest_path = "../img/";
    $move_file = move_uploaded_file($file_location, $dest_path . $file_name);

    // updating data into our data base
    $image_upload_query = "INSERT INTO `product_images`(`image`,`product_id`) VALUES ('$file_name','$product_id')";
    $image_upload_run = mysqli_query($conn, $image_upload_query);

    if ($move_file == true) {
        $sucess3 = "file sucessfully uplodae";
    }

}
if (empty($_FILES['file4']['name']) == false) {

    $file = $_FILES['file4']['name'];
    $file_location = $_FILES['file4']['tmp_name'];
    $file_name = rand() . time() . $file;
    $dest_path = "../img/";
    $move_file = move_uploaded_file($file_location, $dest_path . $file_name);

    // updating data into our data base
    $image_upload_query = "INSERT INTO `product_images`(`image`,`product_id`) VALUES ('$file_name','$product_id')";
    $image_upload_run = mysqli_query($conn, $image_upload_query);

    if ($move_file == true) {
        $sucess4 = "file sucessfully uplodae";
    }

}

if (empty($_FILES['file5']['name']) == false) {
    $file = $_FILES['file5']['name'];
    $file_location = $_FILES['file5']['tmp_name'];
    $file_name = rand() . time() . $file;
    $dest_path = "../img/";
    $move_file = move_uploaded_file($file_location, $dest_path . $file_name);

    // updating data into our data base
    $image_upload_query = "INSERT INTO `product_images`(`image`,`product_id`) VALUES ('$file_name','$product_id')";
    $image_upload_run = mysqli_query($conn, $image_upload_query);

    if ($move_file == true) {
        $sucess5 = "file sucessfully uplodae";
    }

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
    <form accept-charset="UTF-8" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1" required="required">Category title</label>
        </div>
        <hr>
        <div class="form-group mt-3">
            <label class="mr-2">Upload product image 1</label>
            <label class="mr-2" style="color:red">

            </label>
            <input type="file" name="file1">
        </div>
        <div class="form-group mt-3">
            <label class="mr-2">Upload product image 2</label>
            <label class="mr-2" style="color:red">

            </label>
            <input type="file" name="file2">
        </div>
        <div class="form-group mt-3">
            <label class="mr-2">Upload product image 3</label>
            <label class="mr-2" style="color:red">

            </label>
            <input type="file" name="file3">
        </div>
        <div class="form-group mt-3">
            <label class="mr-2">Upload product image 4</label>
            <label class="mr-2" style="color:red">

            </label>
            <input type="file" name="file4">
        </div>
        <div class="form-group mt-3">
            <label class="mr-2">Upload product image 5</label>
            <label class="mr-2" style="color:red">

            </label>
            <input type="file" name="file5">
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>






</div>
<?
include_once('main-footer.php')
    ?>