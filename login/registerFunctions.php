<?php
include "db_connect.php";
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
none_checker($fname);
none_checker($lname);
none_checker($email);
none_checker($password);
none_checker($uname);


function no_num($input){
    if(1 === preg_match('~[0-9]~', $input)){
        header("Location: register.php?error=No numbers are allowed in first and last name");
                    		exit();
    }
    else{
        return true;
    }
}
no_num($fname);
no_num($lname);

function email_checker($input){
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$input))
    {
    header("Location: register.php?error=Invalid email address");
                        		exit();
    }else{
    return true;
    }
}
email_checker($email);


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
valid_password($password);

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
valid_username($uname);
/*
[.0-9A-Za-z]*
function input_check(){
	var fname = document.getElementById("FirstName").value;
	var lname = document.getElementById("LastName").value;
	var email = document.getElementById("Email").value;

	var check_1 = none_checker(fname, "error_report_1");
	if (check_1) {
		var check_2 = number_checker(fname, "error_report_1");
	}

	var check_3 = none_checker(lname, "error_report_2");
	if (check_3) {
		var check_4 = number_checker(lname, "error_report_2");
	}

	var check_5 = none_checker(email, "error_report_3");
	if (check_5) {
		var check_6 = email_checker(email, "error_report_3");
	}

	if (check_1 && check_2 && check_3 && check_4 && check_5 && check_6){
		document.getElementById("error_report_1").innerHTML="&nbsp;";
		document.getElementById("error_report_2").innerHTML="&nbsp;";
		document.getElementById("error_report_3").innerHTML="&nbsp;";
		alert("Submitted Successfully!");
	}
}

function number_checker(input_string, output_string){
	for (var i = 0; i < input_string.length; i++) {
		if(input_string.charAt(i) >= '0' && input_string.charAt(i) <= '9'){
			document.getElementById(output_string).innerHTML= "Numbers are not allowed in this field";
			return false;
		}
	}
	return true;
}

function email_checker(input_string, output_string){
	var hasAt = false;
	for (var i = 0; i < input_string.length; i++) {
		if(input_string.charAt(i) == "@"){
			hasAt = true;
		}
		if(hasAt && input_string.charAt(i) == "."){
			return true;
		}
	}
	document.getElementById(output_string).innerHTML= "Please input vaild email address";
	return false;
}

function none_checker(input_string, output_string){
	if (input_string.length){
		return true;
	} else {
		document.getElementById(output_string).innerHTML= "No empty fields are allowed";
		return false;
	}
}
*/
?>