<!doctype html>
<html lang = "en">
<head>
	<meta charset = "utf-8">
	<title>Final Project - User Account Management: Backend</title>
</head>
<body>
</body>
</html>

<?php
require 'db.php';
class checkUserName{
	public $isUnique;
	public $noSpecialChars;

	public function check_isUnique($username){
		$query = "SELECT * FROM users WHERE userName = '$username'";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
		if (empty($results)){
			$isUnique = TRUE;
		}
		else{
			$isUnique = FALSE;
		}
		return $isUnique;
	}

	public function check_noSpecialChars($username){
		$pattern = "/^[^&=_'\-+,<>.]+(?:\.[^&=_'\-+,<>.]+)*$/";
		if (preg_match($pattern, $username)){
			$noSpecialChars = TRUE;
		}
		else{
			$noSpecialChars = FALSE;		
		}
		return $noSpecialChars;
	}

	//make function that checks if username is in db
}

class checkPassword{
	public $followsRules;
	public $notUsed;
	public $correctPass;

	//checking rules function 
	public function check_rules($password){
		$pattern = "/(?=.*[A-Z])(?=.?[a-z])(?=.*?[0-9]).{7,30}/";
		if (preg_match($pattern, $password)){
			//if something in the pattern matches, it DOES follow rules
			$followsRules = TRUE;
		}
		else{
			//if something in the pattern does not match, it does NOT follow the rules
			$followsRules = FALSE;		
		}
		return $followsRules;
	}

	//checking if current password correct
	public function check_password($password, $username){
		$query = "SELECT userPassword FROM users WHERE userName = '$username' AND userPassword='$password'";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
		if (empty($results)){
			$correctPass = FALSE;
		}
		else{
			$correctPass = TRUE;	
		}
		return $correctPass;
	}

	//checking notUsed 
	public function check_notUsed($password, $username){
		$query = "SELECT oldPassword FROM users WHERE userName = '$username'";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
		if ($results[0][0]===$password){
			//echo "Password cannot be the same as your old password!";
			$notUsed = FALSE;
		}
		else{
			$query = "SELECT oldestPassword FROM users WHERE userName = '$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
			if ($results[0][0]===$password){
				//echo "Password cannot be the same as one of your previous two passwords!";
				$notUsed = FALSE;
			}
			else{
				$notUsed = TRUE;
			}	
		}
		return $notUsed;
	}
}

class checkEmail{
	public $isUnique;

	public function check_isUnique($email){
		$query = "SELECT * FROM users WHERE email = '$email'";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
		if (empty($results)){
        	return true;
        }
        else{
        	header("Location: register.php?error=An account already registered with that email");
            exit();
        }
}
}

class users{
	public $userID; //categoryID
	public $userName; //productCode
	public $email; //productName
	public $userPassword; //listPrice
	public $firstName; 
	public $lastName; 
	
	//just for development purposes, not needed in final project
	public function displayUsers(){
		$query = "SELECT * FROM users";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
		//var_dump($results);
		$run_process->printTable($results);
	}

	//WORKS!
	public function update_userName($username, $new_username){
		$check = new checkUserName();
		if ( $check->check_noSpecialChars($username)) { 
			$query = "UPDATE users SET userName = '$new_username' WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
		}
		else if ($check->check_isUnique($username)){
			echo "<br> This username does not fulfill the requirements. Please choose a different username!<br>";
		}
		else{
			echo "<br> This username is already taken. Please choose a different username!<br>";
		}
	}

	public function update_userPassword($new_password, $username, $password){
		$check = new checkPassword();
		if ( ($check->check_rules($new_password)) && $check->check_password($password, $username) && $check->check_notUsed($password, $username)){
			//gets old password
			$query = "SELECT oldPassword FROM users WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
			$results = $results[0][0];
			echo $results;

			//changes oldest password to old password
			$query = "UPDATE users SET oldestPassword='$results' WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);

			//gets current password
			$query = "SELECT userPassword FROM users WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
			$results = $results[0][0];

			//changes old password to current password
			$query = "UPDATE users SET oldPassword='$results' WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
			
			//updates current password
			$query = "UPDATE users SET userPassword='$new_password' WHERE userName='$username'";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
		}
		else{
			if (! ($check->check_rules($new_password)) ){
				echo "<br>This new password does not fulfill the requirements. Please choose a different password!<br>";
			}
			if (! ($check->check_password($password, $username)) ){
				echo "<br>Incorrect current password. Please try again!<br>";
			}
			if (! ($check->check_notUsed($password, $username)) ){
				echo "<br>New password cannot be the same as previous two passwords. Please try again!<br>";
			}
		}
	}
}


// $run_users = new users();
// echo "1: Display the original users table. <br>";
// $run_users->displayUsers();
// echo "<p style=text-align:center>=== <br><p>";

// // //Will just have to adapt functionality so that once a user is logged in, their ID is attached so that don't have to declare userID
// echo "4: Update a user's username. <br>";
// //$run_users->userID=$this->userID?
// $run_users->userID=1;
// // $run_users->userName="oliviaaa"; //oliviarodrigo
// $run_users->update_userName("oliviarodrigo","oliviaaa"); 

// // $run_pass = new checkPassword();
// // $run_pass->check_notUsed("joshsux", "Username");
// // $run_users->displayUsers();
// $run_users->update_userPassword("hamBurger1D", "oliviarodrigo", "password"); 
// $run_users->displayUsers();
// echo "<p style=text-align:center>=== <br><p>";
?>
