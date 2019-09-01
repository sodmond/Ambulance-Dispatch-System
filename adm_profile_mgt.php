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
	if(isset($_SESSION['del_suces'])){ echo $_SESSION['del_suces']; unset($_SESSION['del_suces']); }
	if(isset($_SESSION['del_error'])){ echo $_SESSION['del_error']; unset($_SESSION['del_error']); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Admin Profile Management</title>
<link rel="stylesheet" href="css/main.css" />
<script src="js/script.js"></script>
<script src="js/cookie.js"></script>
<style type="text/css">
.tabs{width:520px; height:25px; background:#903; margin-left:100px; padding:2px; font:0.9em Arial; border-radius:5px;}
.tabs a{color:#CCC; text-decoration:none;}
.tabs a:hover{color:#FFF;}
#tbl{width:100%; height:700px; overflow:scroll; background:#FFF;}
#tbl table{border:1px #DDD ridge;}
</style>
</head>

<body onload="del_cookies();">
<div class="container">

<!-- 		Head Section Starts here	 -->
<div class="header">
<img src="images/header.png"  />
</div>

<!-- 		Content Starts here		 -->
<div class="content">
<p>&nbsp;</p>
<div align="center" class="tabs">
<a href="profile_mgt.php">&crarr; back</a>&nbsp;&nbsp; | &nbsp;&nbsp;
<a href="admin_reg.php">Register an Admin</a>&nbsp;&nbsp; | &nbsp;&nbsp;
<a href="javascript:admModProf();">Modify a Profile</a>&nbsp;&nbsp; | &nbsp;&nbsp;
<a href="javascript:admDelProf();">Delete a Profile</a>&nbsp;&nbsp; | &nbsp;&nbsp;
<a href="adm_more.php">More</a>
</div>
<hr />
<div id="tbl"><table width="800" border="1" bordercolor="#CCC" bgcolor="#FFF" cellpadding="0" cellspacing="0">
  <tr height="20" bgcolor="#000" style="color:#DDD; font:1.0em Cambria; text-align:center;">
    <td>Admin ID</td>
    <td>Lastname</td>
    <td>Othernames</td>
    <td>Date of Birth</td>
    <td>Gender</td>
    <td>Address</td>
    <td>Email</td>
    <td>Phone</td>
    <td>Qualification</td>
  </tr>
<?php
$sql = mysqli_query($conn, 'SELECT * FROM admin_info ORDER BY Lastname');
while($row = mysqli_fetch_array($sql)){
	echo '<tr style="color:#000; font:1.0em Calibri; text-align:center;">';
	echo '<td>'.$row['Admin_id'].'</td>';
	echo '<td>'.$row['Lastname'].'</td>';
	echo '<td>'.$row['Othernames'].'</td>';
	echo '<td>'.$row['Date_of_Birth'].'</td>';
	echo '<td>'.$row['Gender'].'</td>';
	echo '<td>'.$row['Address'].'</td>';
	echo '<td>'.$row['Email'].'</td>';
	echo '<td>'.$row['Phone'].'</td>';
	echo '<td>'.$row['Qualification'].'</td>';
	echo '</tr>';
}
?>
</table></div>
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