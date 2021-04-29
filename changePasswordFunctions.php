<?php
require 'users.php';
$uname = $_POST['uname'];
$newPassword = $_POST['newPassword'];
$currentPassword = $_POST['currentPassword'];

function none_checker($input){
    if (strlen($input) !=0 ){
    		return true;
    	} else {
    		header("Location: changePassword.php?error=No empty fields are allowed");
    		exit();
    	}
}

function valid_password($input){
		$pattern = "/(?=.?[A-Z])(?=.?[a-z])(?=.*?[0-9]).{7,30}/";
		if (preg_match($pattern, $input)){
			return true;
		}
		else{
		header("Location: changePassword.php?error=Password must be between 8-30 characters, contain at least one uppercase letter, lowercase letter, and number digit");
            exit();
			}
	}

if ( none_checker($uname) && none_checker($newPassword) && none_checker($currentPassword)){
	if(valid_password($newPassword)){
		$check_pass = new checkPassword();
		if ( $check_pass->check_password($currentPassword, $uname)){
			if ($check_pass->check_notUsed($newPassword, $uname)){
				$update= new users();
				$update->update_userPassword($newPassword, $uname, $currentPassword);
				header("Location: changePassword.php?error=Updated.");
           		exit();
			}else{
				header("Location: changePassword.php?error=New password cannot be the same as previous two passwords.");
				exit();
			}
		}else{
			header("Location: changePassword.php?error=Current password or username is incorrect.");
            exit();
		}
	}else{
		header("Location: changePassword.php?error=Password must be between 8-30 characters, contain at least one uppercase letter, lowercase letter, and number digit");
            exit();
	}
}

?>