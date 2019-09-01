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
if(!(isset($_POST['did'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. More Driver Features</title>
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
<legend>Change Route</legend>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Enter Driver ID: <input type="text" name="did" class="txt" required="required" /></p>
<p>Select Route: <select name="rout"  class="txt" style="height:25px; width:205px;">
    	<option value="0">- - - - - Assign Route</option>
        <?php $query = mysqli_query($conn, 'SELECT * FROM route ORDER BY NAME');
			while($rout = mysqli_fetch_array($query)){
				echo '<option value="'.$rout['Name'].'">'.$rout['Name'].'</option>';
			}
		?>
</select></p>
<p align="center"><input type="submit" name="route" value="Save Changes" class="btn" /></p>
</form>
<p align="center"><a href="drv_profile_mgt.php">&crarr; Go back home</a></p>
</fieldset>

<fieldset style="margin-bottom:50px;">
<legend>Assign an Ambulance</legend>
<form  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Enter Driver ID: <input type="text" name="did" class="txt" required="required" /></p>
<p>Select Ambulance: <select name="amb_id" class="txt" style="height:25px; width:205px;">
    	<option value="0">- - - - - - - Select Ambulance</option>
        <?php $query = mysqli_query($conn, 'SELECT * FROM ambulance_info WHERE Driver_id=""');
			while($amb = mysqli_fetch_array($query)){
				echo '<option value="'.$amb['Amb_id'].'">'.$amb['Amb_id'].'</option>';
			}
		?>
</select></p>
<p align="center"><input type="submit" name="amb" value="Save Changes" class="btn" /></p>
</form>
<p align="center"><a href="drv_profile_mgt.php">&crarr; Go back home</a></p>
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
	if(isset($_POST['route'])){
		$did = $_POST['did'];
		$rout = $_POST['rout'];
		val($did); val($rout);
		$msg = true;
		if(valDropDown($rout) == 'false'){ $msg = false; }
		if($msg == true){
			$sql = mysqli_query($conn, 'UPDATE drivers_info SET Route = "'.$rout.'" WHERE Driver_id="'.$did.'"');
			if($sql){
				$_SESSION['reg_suces'] = " Route Assigned to Driver Succesfully";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			else{
				$_SESSION['reg_error'] = " Error Assigning Route to Driver<br>";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
		}
	}
	else if(isset($_POST['amb'])){
		$did = $_POST['did'];
		$amb_id = $_POST['amb_id'];
		val($did);
		$msg = true;
		if(valDropDown($amb_id) == 'false'){ $msg = false; }
		if($msg == true){
			$sql = mysqli_query($conn, 'UPDATE ambulance_info SET Driver_id = "'.$did.'" WHERE Amb_id="'.$amb_id.'"');
			if($sql){
				$_SESSION['reg_suces'] = " Ambulance Assigned to Driver Succesfully";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			else{
				$_SESSION['reg_error'] = " Error Assigning Ambulance to Driver<br>";
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