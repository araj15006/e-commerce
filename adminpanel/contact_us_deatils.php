<?php
session_start();

include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}


include_once("header.php");
$ID = $_GET["id"];
$query = "SELECT * FROM contact_us where id = $ID";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
include_once("navbar.php");
include_once("sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<?
include_once('content-header.php')
    ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- main content start -->



        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <? echo $data["id"]; ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">NAME</label>
                        <div class="col-sm-10">
                            <? echo $data['name'] ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">PHONE no.</label>
                        <div class="col-sm-10">
                            <? echo $data['e-mail'] ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-10">
                            <? echo $data['phone_no'] ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <? echo $data['subject'] ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Message</label>
                        <div class="col-sm-10">
                            <? echo $data['message'] ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                    <a href="user_listing.php"> <button type="button" class="btn btn-default">Back</button></a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- end main content -->

    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?
include_once('main-footer.php')
    ?>