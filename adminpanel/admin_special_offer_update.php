<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$id = $_GET['id'];
$error = "";
$sucess = "";

$special_offer_title="";
$special_offer_discount="";
$get_special_offer_data_query = "select * from special_offer where `id` = $id";
$get_special_offer_data_query_run = mysqli_query($conn,$get_special_offer_data_query);
$get_special_offer_fetch = mysqli_fetch_assoc($get_special_offer_data_query_run);

if(empty($get_special_offer_fetch)== false){
  $special_offer_title = $get_special_offer_fetch['title'];
  $special_offer_discount = $get_special_offer_fetch['offer_percentage'];
}


if(isset($_POST['title'])){    
      $title = $_POST['title'];
      $disc = $_POST['disc'];
      $file = $_FILES['file']['name'];
      $file_location = $_FILES['file']['tmp_name'];
      $file_name = rand().time().$file;
      $dest_path = "../img/";
      $move_file = move_uploaded_file($file_location,$dest_path.$file_name);
  
      // updating data into our data base
      $image_upload_query = "UPDATE `special_offer` SET `title`='$title',`offer_percentage`='$disc',`image_name`='$file_name' WHERE `id` = $id ";
      $image_upload_run = mysqli_query($conn,$image_upload_query);
  
      if($move_file == true){
  $sucess = "file sucessfully updated";
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
<?
        if(empty($sucess) == false){?>
        <div class="alert alert-success" role="alert">
        <?= $sucess ?>
      </div>
    <?  }?>

        <form accept-charset="UTF-8" action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1" required="required">Category title</label>
            <input type="text" name="title" class="form-control" value="<?=$special_offer_title?>"  placeholder="Enter title">
            <br>
            <input type="text" name="disc" class="form-control" value="<?=$special_offer_discount?>" placeholder="discount">
          </div>
          <hr>
          <div class="form-group mt-3">
            <label class="mr-2">Upload product image </label>
            <label class="mr-2" style="color:red"><? echo $error ?></label>
            <input type="file" name="file">
          </div>
          <hr>
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="admin_special_offer.php"> <button style="margin-left:77%" type="button" class="btn btn-default">Home</button></a>
        </form>
    </div> 
</div>
<?
include_once('main-footer.php')
    ?>