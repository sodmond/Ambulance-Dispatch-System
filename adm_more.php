<?php
require_once('conn.php');
require_once('validate.php');
session_start();
if(isset($_SESSION['admin']))
{
	$rank = mysqli_fetch_array(mysqli_query($conn, ' SELECT Rank FROM admin_login_details WHERE (Admin_id="'.$_SESSION['admin'].'") '));
	if($rank['Rank'] != "global"){
		$_SESSION['account'] = '<script>alert("Oops! You dont have permission"); location.reload();</script>';
		header('Location: admin_center.php');
	}
if(!(isset($_POST['aid'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. More Admin Features</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
fieldset{
	width:400px; height:auto; background:#FAFAFA; border:1px #900 solid;
	font:1.0em Calibri;
	margin-top:50px; margin-left:130px; text-align:right; padding:15px;
}
legend{
	background:#900; color:#DDD; text-align:center; font:1.1em Cambria; padding:3px;
}
</style>
</head>

<body>
<div class="container">

<!-- 		Head Section Starts here	 -->
<div class="header">
<img src="images/header.png"  />
</div>

<!-- 		Content Starts here		 -->
<div class="content">
<div style="background:#0D870A; color:#EEE; font:0.9em Georgia; font-style:italic; text-align:center;">
<?php if(isset($_SESSION['reg_suces'])){ echo $_SESSION['reg_suces']; unset($_SESSION['reg_suces']);} ?>
</div>
<div style="background:#F00; color:#000; font:0.9em Georgia; font-style:italic; text-align:center;">
<?php chk_session_error(); ?>
</div>

<fieldset>
<legend>Change Password</legend>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Enter Admin ID: <input type="text" name="aid" class="txt" required="required" /></p>
<p>Enter Old Password: <input type="password" name="Opwd" class="txt" required="required" /></p>
<p>Enter New Password: <input type="password" name="Npwd" class="txt" required="required" id="pwd0" /></p>
<p>Retype New Password: <input type="password" name="Rpwd" class="txt" required="required" id="pwd1" /></p>
<input type="hidden" name="pwd" />
<p align="center"><input type="submit" value="Save Changes" class="btn" /></p>
</form>
<p align="center"><a href="adm_profile_mgt.php">&crarr; Go back home</a></p>
</fieldset>

<fieldset style="margin-bottom:50px;">
<legend>Change Rank</legend>
<form method="post" action="">
<p>Enter Admin ID: <input type="text" name="aid" class="txt" required="required" /></p>
<p>Select Rank: <select name="rank" class="txt" style="height:25px; width:205px;">
    	<option value="0">- - - - - - - Select a Rank</option>
        <option value="global">- - - Global</option>
        <option value="user">- - - User</option>
</select></p>
<input type="hidden" name="cRank" />
<p align="center"><input type="submit" value="Save Changes" class="btn" /></p>
</form>
<p align="center"><a href="adm_profile_mgt.php">&crarr; Go back home</a></p>
</fieldset>
</div>

<!-- 		Side Section Starts here		 -->
<div class="aside">
<div><a href="record_call.php">Record a Call</a></div>
<div><a href="profile_mgt.php">Profile Management</a></div>
<div><a href="admin_center.php">Admin Center</a></div>
<div><a href="deactivate_drv.php">Deactivate Driver</a></div>
<div><a href="logout.php">Logout</a></div>
</div>

<!-- 		Footer Section Starts here	 -->
<div class="footer">
<br />
ADMA &copy; 2015 | Project by David Gbubemi Joshua
</div>

</div>
</body>
</html>
<?php
}
else{
	if(isset($_POST['pwd'])){
		$aid = $_POST['aid'];
		$Opwd = $_POST['Opwd'];
		$Npwd = $_POST['Npwd'];
		$Rpwd = $_POST['Rpwd'];
		val($aid); val($Opwd);
		$msg = true;
		if(valPwd($Npwd) == 'false'){ $msg = false;} 
		if(pwdMatch($Npwd, $Rpwd) == 'false'){ $msg = false;}
		$pwd = mysqli_fetch_array(mysqli_query($conn, 'SELECT Password FROM admin_login_details WHERE Admin_id="'.$aid.'"'));
		if(($Opwd == $pwd['Password']) && ($msg == true)){
			$sql = mysqli_query($conn, 'UPDATE admin_login_details SET Password = "'.$Npwd.'" WHERE Admin_id="'.$aid.'"');
			if($sql){
				$_SESSION['reg_suces'] = " Password Changed succesfully";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			else{
				$_SESSION['reg_error'] = " Error Changing Password<br>";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
		}
	}
	else if(isset($_POST['cRank'])){
		$aid = $_POST['aid'];
		$rank = $_POST['rank'];
		val($aid);
		$msg = true;
		if(valDropDown($rank) == 'false'){ $msg = false; }
		if($msg == true){
			$sql = mysqli_query($conn, 'UPDATE admin_login_details SET Rank = "'.$rank.'" WHERE Admin_id="'.$aid.'"');
			if($sql){
				$_SESSION['reg_suces'] = " Rank Changed succesfully";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			else{
				$_SESSION['reg_error'] = " Error Changing Rank<br>";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
		}
	}
	else{
		header('Location: '.$_SERVER['PHP_SELF']);
	}
}
}
else{
	header('Location: login.php');
}
?>