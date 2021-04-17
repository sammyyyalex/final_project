<!doctype html>
<html lang = "en">
<head>
	<meta charset = "utf-8">
	<title>Final Project - Users</title>
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
}

class checkPassword{
	public $followsRules;
	public $notUsed;

	//checking rules function 
	public function check_rules($password){
		$pattern = "/^(?=.\d)(?=.[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,30}$/";
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

	//checking notUsed before 
	// public function check_notUsed($password){
	// 	$query = "SELECT userPassword FROM users WHERE userName = '$username'";
	// 	$conn_process = new connect_database();
	// 	$conn = $conn_process ->connectDb();
	// 	$run_process = new running_SQL();
	// 	$results = $run_process->runQuery($conn, $query);
	// 	if ($results==$password){
	// 		$notUsed = FALSE;
	// 	}
	// 	else{
	// 		$notUsed = TRUE;		
	// 	}
	// 	return $notUsed;
	// }
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
		$run_process->printTable($results);
	}

	//WORKS!
	public function update_userName($username){
		$check = new checkUserName();
		if ( ($check->check_isUnique($username)) &&  $check->check_noSpecialChars($username)) {
			$query = "UPDATE users SET userName = '$username' WHERE userID=$this->userID";
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

	//NOT fully functional -> needs to check previous two passwords, and regex for checking reqs doesn't work
	public function update_userPassword($password){
		$check = new checkPassword();
		if ( ($check->check_rules($password)) ){
			$query = "UPDATE users SET userPassword = '$password' WHERE userID=$this->userID";
			$conn_process = new connect_database();
			$conn = $conn_process ->connectDb();
			$run_process = new running_SQL();
			$results = $run_process->runQuery($conn, $query);
		}
		else{
			echo "<br> This password does not fulfill the requirements. Please choose a different password!<br>";
		}
	}
}


$run_users = new users();
echo "1: Display the original users table. <br>";
$run_users->displayUsers();
echo "<p style=text-align:center>=== <br><p>";

//Will just have to adapt functionality so that once a user is logged in, their ID is attached so that don't have to declare userID
echo "4: Update a user's username. <br>";
//$run_users->userID=$this->userID?
$run_users->userID=1;
//$run_users->userName="oliviaaa"; //oliviarodrigo
//$run_users->update_userName("orodrigo"); 
$run_users->update_userPassword("j0shSuxxx");
$run_users->displayUsers();
echo "<p style=text-align:center>=== <br><p>";
?>
