<?php
require_once('conn.php');
require_once('validate.php');
session_start();
if(isset($_SESSION['admin']))
{
	if(!(isset($_POST['drv'])))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Assign a Driver</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.aside{height:500px;}
#box{
	width:350px; height:300px; background:#FFF; border:1px #900 solid; text-align:center;
	margin-left:175px; margin-top:100px; margin-bottom:100px; font:1.0em Arial;
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
<div id="box"><br />
<span style="font:1.5em Tahoma, Geneva, sans-serif; color:#900;">Assign Driver</span>
<hr />
<div style="background:#000; color:#F00;">
<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);} ?>
<?php if(isset($_SESSION['drv_error'])){ echo $_SESSION['drv_error']; unset($_SESSION['drv_error']);} ?>
</div>
<div style="background:#0D870A; color:#DDD;">
<?php if(isset($_SESSION['suces'])){ echo $_SESSION['suces']; unset($_SESSION['suces']);} ?>
</div>
<p align="justify" style="color:#F00;"><b>Note:</b> <span style="font-size:0.9em">Drivers listed in the menu below are Inactive</span></p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Select Driver: <select name="drv" class="txt" style="height:30px; font:1.1em Calibri; color:#933; text-align:center;">
<option value="0">- - - Select Driver - - -</option>
<?php
$sql = mysqli_query($conn, 'SELECT Driver_id FROM drivers_status WHERE Status="Inactive"');
while($drv = mysqli_fetch_array($sql)){
	$sql1 = mysqli_query($conn, 'SELECT Route FROM drivers_info WHERE Driver_id="'.$drv['Driver_id'].'"');
	while($rout = mysqli_fetch_array($sql1)){
		echo '<option value="'.$drv['Driver_id'].'">'.$drv['Driver_id'].'['.$rout['Route'].']</option>';
	}
}
?>
</select></p>
<p><input type="submit" value="Check IN" class="btn" /></p>
</form>
<a href="admin_center.php">Go back home</a>
</div>
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
		if(empty($_POST['drv'])){
			$_SESSION['drv_error'] = 'Select a Driver';
			header('Location: assign_drv.php');
		}
		else{
			$driver_id = $_POST['drv'];
			$sql0 = mysqli_query($conn, 'INSERT INTO dispatch_status(Driver_id, Admin_id, Req_id, Status)
										VALUES("'.$driver_id.'", "'.$_SESSION['admin'].'", "'.$_SESSION['req_id'].'", "Active")');
			$sql1 = mysqli_query($conn, 'UPDATE drivers_status SET Status="Active" WHERE Driver_id="'.$driver_id.'"');
			if($sql0 && $sql1){
				unset($_SESSION['req_id']);
				$_SESSION['suces'] = 'Driver Checked IN Succesful';
				header('Location: assign_drv.php');
			}
			else{
				$_SESSION['error'] = 'Driver Check IN failed';
				header('Location: assign_drv.php');
			}
		}
	}
}
else{
	header('Location: login.php');
}
?>