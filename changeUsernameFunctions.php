<?php
require 'users.php';
$currentUname = $_POST['currentUname'];
$newUname = $_POST['newUname'];
$password = $_POST['password'];

function none_checker($input){
    if (strlen($input) !=0 ){
    		return true;
    	} else {
    		header("Location: changeUsername.php?error=No empty fields are allowed");
    		exit();
    	}
}

function valid_username($input){
	$pattern = "/^[^&=_'\-+,<>.]+(?:\.[^&=_'\-+,<>.]+)*$/";
	if (preg_match($pattern, $input)){
		return true;
	}
	else{
		header("Location: changeUsername.php?error=Username must not contain special characters");
		exit();
	}
}

if ( none_checker($currentUname) && none_checker($newUname) && none_checker($password)){
	if(valid_username($newUname)){
		$check_user = new checkUserName();
		$check_pass = new checkPassword();
		if ( $check_user->check_isUnique($newUname)){
			if ($check_pass->check_password($password, $currentUname)){
				$update= new users();
				$update->update_userName($currentUname, $newUname);
				header("Location: changeUsername.php?error=Updated.");
           		exit();
			}else{
				header("Location: changeUsername.php?error=Current password or username is incorrect.");
				exit();
			}
		}else{
			header("Location: changeUsername.php?error=New username is already taken. Choose a different username.");
            exit();
		}
	}else{
		header("Location: changeUsername.php?error=Username must not contain special characters");
		exit();
	}
}

?>