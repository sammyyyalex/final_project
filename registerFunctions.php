<?php
require 'users.php';
$fname = $_POST['first'];
$lname = $_POST['last'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$password = $_POST['password'];

function none_checker($input){
    if (strlen($input) !=0 ){
    		return true;
    	} else {
    		header("Location: register.php?error=No empty fields are allowed");
    		exit();
    	}
}

function no_num($input){
    if(1 === preg_match('~[0-9]~', $input)){
        header("Location: register.php?error=No numbers are allowed in first and last name");
                    		exit();
    }
    else{
        return true;
    }
}

function email_checker($input){
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$input))
    {
    header("Location: register.php?error=Invalid email address");
                        		exit();
    }else{
    return true;
    }
}

function valid_password($input){
		$pattern = "/(?=.?[A-Z])(?=.?[a-z])(?=.*?[0-9]).{7,30}/";
		if (preg_match($pattern, $input)){
			return true;
		}
		else{
		header("Location: register.php?error=Password must be between 8-30 characters, contain at least one uppercase letter, lowercase letter, and number digit");
            exit();
			}
	}


function valid_username($input){
    		$pattern = "/^[^&=_'\-+,<>.]+(?:\.[^&=_'\-+,<>.]+)*$/";
    		if (preg_match($pattern, $input)){
    			return true;
    		}
    		else{
    			header("Location: register.php?error=Username must not contain special characters");
                exit();
    		}
}

if ( none_checker($fname) && none_checker($lname) && none_checker($email) && none_checker($password) && none_checker($uname)){
	if (no_num($fname) && no_num($lname)){
		if (email_checker($email)){
			if(valid_password($password)){
				if(valid_username($uname)){
					$check_uname = new checkUserName();
					$check_email = new checkEmail();
					if ( $check_uname->check_isUnique($uname) && $check_email->check_isUnique($email)){
						$query = "INSERT INTO users (userName, email, userPassword, firstName, lastName) VALUES ('$uname', '$email', '$password', '$fname', '$lname')";
						$conn_process = new connect_database();
						$conn = $conn_process ->connectDb();
						$run_process = new running_SQL();
						$results = $run_process->runQuery($conn, $query);
						header("Location: login.php"); //Will direct user to index.php in login folder
					}
				}
			}
		}
	}
}

?>