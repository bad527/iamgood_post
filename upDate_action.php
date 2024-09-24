<?php
require_once("dbtools.inc.php");
$link=create_connection();
$id=$_POST["id"];
$name=$_POST["name"];
$gmail=$_POST["gmail"];
switch($_POST["sex"]){
    case "1":
        $sex="1";
        break;
    case "0":
        $sex= "0";
}
$subject=$_POST["subject"];
$content=$_POST["content"];

$sql="UPDATE `talk` SET `name`='$name',`gmail`='$gmail',`sex`='$sex',`subject`='$subject',`content`='$content' 
    WHERE `id`='$id'";
$result=mysqli_query($link,$sql);

header("location:index.php");
mysqli_free_result($result);
mysqli_close($link);
?>