<?
if(isset($_FILES['file'])){
    $fname =  $_FILES['file']['name'];
$type =  $_FILES['file']['type'];
$file_location = $_FILES['file']['tmp_name'];
$size=  $_FILES['file']['size'];

$destPath= "product_images/".time()."_".$fname;

$r = move_uploaded_file($file_location, $destPath); 

if($r==true){
    echo "uploaded";
}
else{
    echo "not uploaded";
}

}

?>



<form action="" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>