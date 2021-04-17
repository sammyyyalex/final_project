uM.php
<?php
session_start();
$id = $_SESSION["userID"];
$con = mysqli_connect('127.0.0.1:3306','root','','admin') or die('Unable To connect');

if(count($_POST)>0) {
$result = mysqli_query($con,"SELECT *from users WHERE name='" . $userID . "'");
$row=mysqli_fetch_array($result);
if($_POST["currentPassword"] == $row["userPassword"] && $_POST["newPassword"] == $row["confirmPassword"] ) {
mysqli_query($con,"UPDATE users set userPassword='" . $_POST["newPassword"] . "' WHERE name='" . $userID . "'");
$message = "Password Changed Sucessfully";
} else{
 $message = "Password is not correct";
}
}
?>