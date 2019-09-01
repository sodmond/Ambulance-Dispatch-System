<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin']))
{
	if(isset($_SESSION['account'])){ echo $_SESSION['account']; unset($_SESSION['account']); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Admin Center | Automated Ambulance System</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.content{
	height:700px; overflow:scroll;
}
.content #box{
	width:550px; height:auto; border-radius:10px;
	padding:10px; background:#FB4448;
	margin-top:20px; margin-left:60px;
	font:0.9em Arial;
}
#div{
	font:italic 1.0em Cambria; height:25px;
	text-align:center; background:#000; color:#DDD;
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
<?php
$today = date('Y-m-d').'%';
$sql0 = mysqli_query($conn, 'SELECT * FROM e_request WHERE Date LIKE "'.$today.'" ORDER BY Date DESC');
$sql1 = mysqli_fetch_array(mysqli_query($conn, 'SELECT COUNT(*) FROM e_request WHERE Date LIKE "'.$today.'" ORDER BY Date DESC'));
if($sql1[0] > 0){
while($req = mysqli_fetch_array($sql0)){
	$sql2 = mysqli_fetch_array(mysqli_query($conn, 'SELECT Driver_id, Admin_id FROM dispatch_status WHERE Req_id="'.$req['Req_id'].'" LIMIT 0,1'));
	echo '<div id="box"><table>';
	echo '<tr><td><b>Name:</b> </td><td>'.$req['Names'].'</td>';
	echo '<tr><td><b>Phone:</b> </td><td>'.$req['Mobile'].'</td>';
	echo '<tr><td><b>Location:</b> </td><td>'.$req['Location'].'</td>';
	echo '<tr><td><b>Message:</b> </td><td>'.$req['Message'].'</td>';
	echo '</table>';
	if(!(empty($sql2))){
		echo '<div id="div"><b>Driver in Charge:</b> '.$sql2['Driver_id'].'&nbsp;&nbsp;&nbsp; <b>Admin in Charge:</b> '.$sql2['Admin_id'].'</div>';
	}
	else{
		echo '<div id="div"><form method="post" action="req_script.php"><input type="hidden" name="req_id" value="'.$req['Req_id'].'"/><input type="submit" value="Assign Driver"/></form></div>';
	}
	echo '</div>';
}
}
else{
	echo '<p style="font:1.2em georgia;" align="center"><i>** No request found for today **</i></p>';
}
?>
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
Automated Ambulance System | &copy; 2015
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