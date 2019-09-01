<?php
require_once('conn.php');
session_start();
if(!(isset($_POST['adminid'], $_POST['pword'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Login Page | Automated Ambulance System</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.content{width:900px; height:400px; background:url(images/bg_amb0.jpg) center;}
fieldset{
	width:400px; background:#FB4448;
	margin-left:250px; margin-top:80px;
	font:17px Calibri; text-align:center;
	border:0px; border-radius:10px; box-shadow:1px 1px 3px 3px;
}
legend{	background:#000; color:#C00; width:120px; height:30px; font:18px Cambria, "Cambria Math"; padding:2px; }
</style>
<script>
function chng_case(){
	document.getElementById("id").value = document.getElementById("id").value.toLowerCase();
}
</script>
</head>

<body>
<div class="container">

<!-- 		Head Section Starts here	 -->
<div class="header">
<img src="images/header.png"  />
</div>

<!-- 		Content Starts here		 -->
<div class="content">
<fieldset>
<legend align="center">Admin Login</legend>
<div style="background:#000; color:#F00;">
<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);} ?>
</div>
<div style="background:#0D870A; color:#DDD;">
<?php if(isset($_SESSION['logout'])){ echo $_SESSION['logout']; unset($_SESSION['logout']);} ?>
</div>
<form method="post" action="<?php $_SERVER['PHP_SELF'];  ?>" name="logForm">
<p><label for="adminid">Admin ID: </label>
<input type="text" name="adminid" id="id" required="required" onchange="chng_case()" class="txt" /></p>
<p><label for="pword">Password: </label>
<input type="password" name="pword" required="required" class="txt" /></p>
<p><input type="submit" value="Login" class="btn" /></p>
</form>
<span><a href="index.php">Go to Homepage</a></span>
</fieldset>
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
	$adminid	= 	$_POST['adminid'];
	$pword		= 	$_POST['pword'];
	$query = mysqli_query($conn, 'SELECT COUNT(*) FROM admin_login_details WHERE (Admin_id="'.$adminid.'" AND Password="'.$pword.'")');
	$result = mysqli_fetch_array($query);
	if($result[0] > 0){
		$_SESSION['admin'] = $adminid;
		header('Location: admin_center.php');
	}
	else{
		$_SESSION['error'] = 'Invalid Username/Password';
		header('Location:'.$_SERVER['PHP_SELF']);
	}
}
?>