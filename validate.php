<?php
function val($val){
	htmlentities($val); 
	htmlspecialchars($val);
	stripslashes($val);
}
#	Validating an Input to accept only numbers with 11 Character length
function valNum($num){
	val($num);
	if( !(filter_var($num, FILTER_VALIDATE_INT)) && ((strlen($num)) < 11) ){
		$_SESSION['int_error'] = " Invalid Phone Number <br>";
		$msg = 'false';
		return $msg;
	}
}
#	Validating an Email to have a Dot(.) and At(@) Symbol
function valMail($mail){
	val($mail);
	if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))){
		$_SESSION['mail_error'] = " Invalid Email <br>";
		$msg = 'false';
		return $msg;
	}
}
# 	Validating a password to accept at least 8 Character length 
function valPwd($pwd){
	val($pwd);
	if(strlen($pwd) < 8){
		$_SESSION['pwd_error'] = " Password must be at least 8 character <br>";
		$msg = 'false';
		return $msg;
	}
}
#	Checking if two input[password] match each other
function pwdMatch($pwd0, $pwd1){
	val($pwd1);
	if($pwd0 != $pwd1){
		$_SESSION['match_error'] = " Password do not Match <br>";
		$msg = 'false';
		return $msg;
	}
}
#	Validating a Radio Button to make sure at least one is checked
function valRadio($radio){
	val($radio);
	if(empty($radio)){
		$_SESSION['gender_error'] = " Please, Select a Gender <br>";
		$msg = 'false';
		return $msg;
	}
}
#	Validating  a textfield not to be empty
function valField($txt){
	val($txt);
	if(empty($txt)){
		$_SESSION['dob_error'] = " Field Cannot be Empty<br>";
		$msg = 'false';
		return $msg;
	}
}
#
function valDropDown($name){
	val($name);
	if($name == "0"){
		$_SESSION['rout_error'] = " Please Select a Route/Rank<br>";
		$msg = 'false';
		return $msg;
	}
}
#	Generating Random Number
function rndm( $numchar ){
    $word = "0,1,2,3,4,5,6,7,8,9";
    $array = explode ( "," ,$word );
    shuffle ($array );
    $newstring = implode($array , "" );
    return substr( $newstring, 0, $numchar );
}
function chk_session_error(){
	if(isset($_SESSION['reg_error'])){ echo $_SESSION['reg_error']; unset($_SESSION['reg_error']);}
	if(isset($_SESSION['pwd_error'])){ echo $_SESSION['pwd_error']; unset($_SESSION['pwd_error']);}
	if(isset($_SESSION['match_error'])){ echo $_SESSION['match_error']; unset($_SESSION['match_error']);}
	if(isset($_SESSION['gender_error'])){ echo $_SESSION['gender_error']; unset($_SESSION['gender_error']);}
	if(isset($_SESSION['mail_error'])){ echo $_SESSION['mail_error']; unset($_SESSION['mail_error']);}
	if(isset($_SESSION['int_error'])){ echo $_SESSION['int_error']; unset($_SESSION['int_error']);}
	if(isset($_SESSION['dob_error'])){ echo $_SESSION['dob_error']; unset($_SESSION['dob_error']);}
	if(isset($_SESSION['rout_error'])){ echo $_SESSION['rout_error']; unset($_SESSION['rout_error']);}
}
?>