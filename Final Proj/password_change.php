<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Password Change</title>
</head>
      


<body>
       <h1>Change Password</h1>
      <form method="POST" action="password_change.php">
      <script src="password_change.js"></script>
       <table>
       <tr>
      <td>Enter your UserName</td>
       <td><input type="username" size="10" name="userName"></td>
       </tr>
       <tr>
       <td>Enter your existing password:</td>
       <td><input type="password" size="10" name="userPassword"></td>
       </tr>
     <tr>
       <td>Enter your new password:</td>
       <td><input type="password" size="10" name="newpassword"></td>
       </tr>
       <tr>
      <td>Re-enter your new password:</td>
      <td><input type="password" size="10" name="confirmnewpassword"></td>
       </tr>
       </table>
       <p><input type="submit" value="Update Password">
       </form>
      

      </body>
</html>





<?php
require ('db.php');
class connect_database{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "Final_Project"; // fill in your database name containing tables: products and categories
    public $conn = NULL;

    public function connectDb(){
        try{
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
			//if($this->conn !=null){echo "successfully connected";}
        }
        catch(PDOException $e){
            $error_out->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n". $e->getMessage());
        }
        return $this->conn;
    }
}


$username = $_POST['userName'];
        $password = $_POST['userPassword'];
        $newpassword = $_POST['newpassword'];
        $confirmnewpassword = $_POST['confirmnewpassword'];
        $result = mysql_query("SELECT userPassword FROM users WHERE userID='$userName'");
        
        if(!$result) {
            echo "The username you entered does not exist";
        }
        
        else if($password!= mysql_result($result, 0)) {
            echo "You entered an incorrect password";
        }

        if($newpassword==$confirmnewpassword)
        $sql=mysql_query("UPDATE users SET userPassword='$newpassword' where 
        userID='$userName'");
        if($sql) {
            echo "Congratulations You have successfully changed your password";
        }else{
            echo "Passwords do not match";
       }
      ?>
}
<!-- ok so im pretty sure the if else statement is scuffed -->

?>

