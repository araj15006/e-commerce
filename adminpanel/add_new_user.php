<?php
session_start();

include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$error="";
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];



    $insert = "insert into user (name,`e-mail`,phone_no,city,pincode)values('$name','$email','$phone','$city','$pincode')";
    $e = mysqli_query($conn,$insert);
    if($e==true){
        header("location:user_listing.php");
    }
    else{
        $error = "Sorry! Data is not saved.";
    }


}

include_once("header.php");

include_once("navbar.php")
    ?>

<?
include_once("sidebar.php")
    ?>

<!-- Content Wrapper. Contains page content -->
<?
include_once('content-header.php')
    ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add New User</h3>

                <?php echo $error; ?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NAME</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">EMAIL</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputPassword3" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">PHONE NUMBER</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Phone number"  name="phone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">CITY</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="City"  name="city">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">STATE</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="State"  name="state">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">PIN CODE</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Pin code" name="pincode">
                    </div>
                  </div>
                  
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <a href="user_listing.php"><button type="button" class="btn btn-default float-right">back</button></a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?
include_once('main-footer.php')
    ?>