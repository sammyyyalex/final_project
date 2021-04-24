<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Username Change</title>
     </head>
    <body>
    <h1>Change Username</h1>
   <form method="POST" action="password_change.php">
    <table>
    <tr>
   <td>Enter your Password</td>
    <td><input type="password" size="10" name="password"></td>
    </tr>
    <tr>
    <td>Enter your existing username:</td>
    <td><input type="password" size="10" name="username"></td>
    </tr>
  <tr>
    <td>Enter your new username:</td>
    <td><input type="username" size="10" name="newusername"></td>
    </tr>
    <tr>
   <td>Re-enter your new username:</td>
   <td><input type="username" size="10" name="confirmnewusername"></td>
    </tr>
    </table>
    <p><input type="submit" value="Update Username">
    </form>

      </body>
</html>



<?php
require "db.php";

        $username = $_POST['username'];
        $password = $_POST['password'];
        $newpassword = $_POST['newusername'];
        $confirmnewpassword = $_POST['confirmnewusername'];
        $result = mysql_query("SELECT userName FROM users WHERE userPassword='$password'");
        if(!$result){
        echo "The password does not match the username that exists!";
        }
        else if($password!= mysql_result($result, 0))
        {
        echo "You entered an incorrect password";
        }
        
        if($newusername==$confirmnewusername){
        $sql=mysql_query("UPDATE users SET userName='$newusername' WHERE userPassword='$password'"); // somewhere i have to put in the username checker
        }

        if($sql){
        echo "Congratulations You have successfully changed your username!";
        }
       else{
       echo "Password does not exist";
       }


?>
