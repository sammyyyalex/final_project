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

	//^[a-zA-z0-9]+(?:\.[a-zA-z0-9]+)*$
	//does not fulfill conditions for username
	public function check_noSpecialChars($username){
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
			$noSpecialChars = FALSE;
		}
		else{
			$noSpecialChars = TRUE;		
		}
		return $noSpecialChars;
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
		$run_process->printTable($results);
	}

	//making it a parameter allows for future use where you can pull text from the browser
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

	public function update_userPassword($password){
		$query = "UPDATE users SET userPassword = '$password' WHERE userID=$this->userID";
		$conn_process = new connect_database();
		$conn = $conn_process ->connectDb();
		$run_process = new running_SQL();
		$results = $run_process->runQuery($conn, $query);
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
$run_users->update_userName("ol.iviaaa");
$run_users->displayUsers();
echo "<p style=text-align:center>=== <br><p>";
?>
