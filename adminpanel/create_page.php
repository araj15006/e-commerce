<?php
include_once("database.php");

$error = array();
if(isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rpassword = $_POST['repeatPassword'];
  $cheak_box = isset($_POST['remember'])?$_POST['remember']:""; 


  if($email==""){
   $error['email'] = "pless enter email" ;

  }
  if($password==""){
   $error['password'] = "pless enter password" ;

  }
  if($rpassword==""){
   $error['rpassword'] = "pless enter rpassword" ;

  }
  if($cheak_box==""){
   $error['remember'] = "pless select the remember me" ;
  }
  if($password != $rpassword ){
   $error["not_match"] = 'password not match';
  }
  if(strlen($password)<5){
   $error["length"] = 'password must be in 5 character';

  }

 if(empty($error)){
   $mysql_qu = "INSERT INTO `user`(`e-mail`, `password` ) VALUES ('$email','$password')";
   $e = mysqli_query($conn, $mysql_qu);
   header("location:dashboard.php");
  
 }
  
}


?>



<!DOCTYPE html>
<html>
<head>
<style>
body{
   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   width: 30%;
   height: 40%;
   margin-left:auto ;
   margin-right:auto ;
}
* {box-sizing: border-box}
input[type=text], input[type=password] {
   width: 100%;
   font-size: 28p;
   padding: 8px;
   margin: 5px 0 22px 0;
   display: inline-block;
   border: none;
   background: #f1f1f1;
}
label{
   font-size: 15px;
}
input[type=text]:focus, input[type=password]:focus {
   background-color: #ddd;
   outline: none;
}
hr {
   border: 1px solid #f1f1f1;
   margin-bottom: 25px;
}
button {
   font-size: 15px;
   font-weight: bold;
   background-color: #5665e6;
   color: white;
   padding: 10px 10px;
   margin: 8px 0;
   border: none;
   cursor: pointer;
   width: 100%;
   opacity: 0.9;
}
button:hover {
   opacity:1;
}
.cancel {
   padding: 10px 15px;
   background-color: #ff3d2f;
}
.formContainer {
   padding: 16px;
}
.formContainer p{
   font-size: 70%;
}
</style>
<body>
<form method='post' action=''>
<div class="formContainer">
<h1>Sign Up Form</h1>
<hr>
<?php //echo $error; ?>
<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter Email" name="email" ><br>
<span style="color:red;"><?php if(isset($error['email'])){ echo $error['email']; } ?></span><br>
<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter Password" name="password" ><br>
<span style="color:red;"><?php if(isset($error['password'])){ echo $error['password']; } ?></span><br>
<label for="repeatPassword"><b>Repeat Password</b></label>
<input type="password" placeholder="Repeat Password" name="repeatPassword">
<span style="color:red"><?php if(isset($error["not_match"])){echo  $error["not_match"];}; if(isset($error['length'])){echo $error['length'];}?></span><br>
<label>
<input type="checkbox" name="remember" value="yes" style="marginbottom: 15px"> Remember me
</label>
<p>By creating an account you agree to our <a href="#"
style="color:dodgerblue">Terms & Privacy</a><p>
<div>
<button type="submit" class="signup">Sign Up</button>
<button type="button" class="cancel">Cancel</button>

</div>
</div>
</form>
</body>
</html>