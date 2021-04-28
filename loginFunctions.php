<?php
require 'users.php';
$uname = $_POST['uname'];
$password = $_POST['password'];

$isEmail;

function none_checker($input){
    if (strlen($input) !=0 ){
    		return true;
    	} else {
    		header("Location: login.php?error=No empty fields are allowed");
    		exit();
    	}
}

function email_checker($input){
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$input))
    {
		$isEmail = FALSE;
    }else{
    	$isEmail = TRUE;
    }
	return $isEmail;
}

if ( none_checker($uname) && none_checker($password)){
	$check= new checkPassword();
	if ( $check->check_password($password, $uname) ){
		if (email_checker($uname)){
			echo(alert("<br>Username is an email!<br>"));
		}
		header("Location: welcome.php");
	}
} 
//Get an error to popup if not valid login credentials
?>