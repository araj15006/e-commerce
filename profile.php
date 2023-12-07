<?
include_once('dashboard_nav_bar.php') ;
include_once('database.php');

if (isset($_SESSION['id']) == false) {
    header("location:user_login.php");
}
$update = '';
$error = '';
// getting all data from data base

$id = $_SESSION['id'];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['phone_no'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin_code = $_POST['pincode'];
    $street = $_POST['street'];
    $Teliphone_number = '';
    $locality = $_POST['locality'];
    $country = $_POST['country'];
    if (empty($_POST['new_password']) == false) {
        echo $_POST['new_password'];
        $sql_password_query = "select * from user where id = '$id' ";
        $sql_run = mysqli_query($conn, $sql_password_query);
        $sql_coloum = mysqli_fetch_assoc($sql_run);
        $sql_old_password = $sql_coloum['password'];
        $from_old_password = md5(trim($_POST['old_password']));
        $from_new_password = md5(trim($_POST['new_password']));
        if ($from_old_password == $sql_old_password) {
            // print_r($_POST);
            $update_query = "UPDATE user SET `name`='$name' ,`e-mail`='$email' , `phone_no`='$number', `password`='$from_new_password' , `city`='$city' , `street`='$street' ,`pincode`='$pin_code' ,`state`='$state' ,`locality` ='$locality' , `country`='$country',`phone_no`=$Teliphone_number   WHERE id=$id ";
            mysqli_query($conn, $update_query);
            echo $update_query;
            $update = "update sucessfull";
        } else {
            print_r($_POST);
            $error = "your old password is worng";

        }

    } else {

        $get_profile = "select * from user where `id` = $id";
        $get_profile_query_run = mysqli_query($conn, $get_profile);
        $g_profile = mysqli_fetch_assoc($get_profile_query_run);
        $update_query = "UPDATE `user` SET `name`='$name', `e-mail`='$email', `phone_no`='$number', `city`='$city', `street`='$street', `pincode`='$pin_code', `state`='$state', `locality`='$locality', `phone_no`='$Teliphone_number' WHERE `id`='$id'";

        $update_run_query = mysqli_query($conn, $update_query);
        // echo $update_query;

        $update = "update sucessfull";
    }
} else {

    $query = "select * from user where `id`='$id'";
    $sql = mysqli_query($conn, $query);
    $run_query = mysqli_query($conn, $query);
    $get_detials = mysqli_fetch_assoc($run_query);
    $name = ($get_detials['name']);
    $email = ($get_detials['e-mail']);
    $number = ($get_detials['phone_no']);
    $city = ($get_detials['city']);
    $state = ($get_detials['state']);
    $pin_code = ($get_detials['pincode']);
    $country = ($get_detials['country']);
    $street = ($get_detials['street']);

    $Teliphone_number = ($get_detials['phone_no']);
    $locality = ($get_detials['locality']);
    $country = ($get_detials['country']);
}

?>


<!DOCTYPE html>
<html lang="en">

<? include_once('header.php') ?>

<body>
    <? include_once('dashboard_nav_bar.php') ?>

    <style>
        body {
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
    <html>
    <?
    echo $update . $error;
    ?>

    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="background-color:#ffd333;">
                <div class="card h-100" style="background-color:#3d464d;">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name" style="color:#ffd333;">
                                    <? echo $name ?>
                                </h5>
                                <h6 class="user-email">
                                    <? echo $email ?>
                                </h6>
                            </div>
                            <div class="about">
                                <h5>About</h5>
                                <p style='color:white'>I'm Yuki. Full Stack Designer I enjoy creating user-centric,
                                    delightful and human
                                    experiences.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <form method="post" action='' class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary" style="color:black;">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="name" placeholder="name"
                                        value="<? echo $name ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" id="eMail" name="email"
                                        placeholder="email ID" value="<? echo $email ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no"
                                        placeholder="phone number" value="<? echo $number ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">Teliphone number</label>
                                    <input type="text" class="form-control" id="teli_phone_number" name="teli"
                                        placeholder="Teli no." value="<? echo $Teliphone_number ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Street</label>
                                    <input type="name" class="form-control" id="Street" name="street"
                                        placeholder="Enter Street" value="<? echo $street ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">locality</label>
                                    <input type="name" class="form-control" id="Street" name="locality"
                                        placeholder="Enter Street" value="<? echo $locality ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">City</label>
                                    <input type="name" class="form-control" id="ciTy" name="city"
                                        placeholder="Enter City" value="<? echo $city ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sTate">State</label>
                                    <input type="text" class="form-control" id="sTate" name="state"
                                        placeholder="Enter State" value="<? echo $state ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">Zip Code</label>
                                    <input type="text" class="form-control" id="zIp" name="pincode"
                                        placeholder="Zip Code" value="<? echo $pin_code ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">Country</label>
                                    <input type="text" class="form-control" id="zIp" name="country"
                                        placeholder="Zip Code" value="<? echo $country ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Login details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Email</label>
                                    <input type="name" class="form-control" id="Street" name="l_email"
                                        placeholder="Email" value="<? echo $email ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">Password</label>
                                    <input type="name" class="form-control" id="ciTy" placeholder="Password"
                                        value="**********">
                                </div>
                            </div>


                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">For update password</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sTate">Old password</label>
                                    <input type="text" class="form-control" id="sTate" name="old_password"
                                        placeholder="Old password">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">New password</label>
                                    <input type="text" class="form-control" id="zIp" name="new_password"
                                        placeholder="New password">
                                </div>
                            </div>


                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-secondary">Cancel</button>
                                    <button type="Submit" id="submit" name="submit" class="btn btn-primary"
                                        name="update" value="you">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?

    include_once('fotter.php')

        ?>
    <!-- Navbar End -->

</body>

</html>