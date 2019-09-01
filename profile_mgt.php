<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin']))
{
	$rank = mysqli_fetch_array(mysqli_query($conn, ' SELECT Rank FROM admin_login_details WHERE (Admin_id="'.$_SESSION['admin'].'") '));
	if($rank['Rank'] != "global"){
		$_SESSION['account'] = '<script>alert("Oops! You dont have permission"); location.reload();</script>';
		header('Location: admin_center.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Profile Management | Automated Ambulance System</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.content .box{
	width:550px; height:100px; border-radius:20px;
	padding:20px; background:#FB4448; text-align:center;
	margin-top:30px; margin-left:50px; margin-bottom:30px;
}
.content .box p{font:1.3em Tahoma, Geneva, sans-serif;}
.content .box a{text-decoration:none; font:1.0em Calibri;}
.content .box a div{width:100px; height:30px; background:#903; color:#CCC; margin-left:200px;}
.content .box a div:hover{background:#933;}
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
<div class="box"><p>ADMIN PROFILE MANAGEMENT</p><a href="adm_profile_mgt.php"><div>Go to Page</div></a></div>
<div class="box"><p>DRIVER PROFILE MANAGEMENT</p><a href="drv_profile_mgt.php"><div>Go to Page</div></a></div>
<div class="box"><p>AMBULANCE PROFILE MANAGEMENT</p><a href="amb_profile_mgt.php"><div>Go to Page</div></a></div>
<br />&nbsp;
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
	header('Location: login.php');
}
?>