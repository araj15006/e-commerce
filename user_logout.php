<?php
session_start();

//echo $_SESSION['name'];
unset($_SESSION['id']);
unset($_SESSION['name']);
session_destroy();

//print_r($_SESSION);

header("location:index.php");

?>