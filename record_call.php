<?php
require_once('conn.php');
require_once('validate.php');
session_start();
if(isset($_SESSION['admin']))
{
	if(!(isset($_POST['mthd'])))
	{
		if(isset($_SESSION['suces'])){ echo $_SESSION['suces']; unset($_SESSION['suces']); }
		if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Call Record Section</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.content{height:500px;}
.aside{height:500px;}
fieldset{
	width:340px; background:#FB4448; font:17px Calibri; text-align:right;
	border:0px; box-shadow:1px 1px 3px 3px; border-radius:20px;
	margin-top:100px; margin-left:150px;
}
legend{	background:#C00; width:100px; height:25px; font:18px Cambria, "Cambria Math"; }
</style>
</head>

<body>
<div class="container">

<!--	Header Section Starts here	-->
<div class="header"><img src="images/header.png"  /></div>

<!--	Content Section Starts here	-->
<div class="content">
<fieldset>
<legend align="center">Record a Call</legend>
<form method="post" action="">
<p>Name: <font color="#F00">*</font> 
<input type="text" name="names" required="required" class="txt" placeholder="Enter Name" /></p>
<p>Phone No: <font color="#F00">*</font> 
<input type="text" name="phone" required="required" class="txt" placeholder="Enter Phone Number" /></p>
<p>Location: <input type="text" name="lctn" class="txt" placeholder="Enter Location" /></p>
<p>Message: <font color="#F00">*</font>
<textarea rows="3" cols="23" name="msg" required="required" placeholder="Enter detailed description of emergency and location">
</textarea></p>
<input type="hidden" name="mthd" value="Call" />
<p align="center"><input type="submit" value="Record" class="btn" /></p>
</form>
</fieldset>
</div>

<!--	Aside Section Starts here	-->
<div class="aside">
<div><a href="record_call.php">Record a Call</a></div>
<div><a href="profile_mgt.php">Profile Management</a></div>
<div><a href="admin_center.php">Admin Center</a></div>
<div><a href="deactivate_drv.php">Deactivate Driver</a></div>
<div><a href="logout.php">Logout</a></div>
</div>

<!--	Footer Section Starts here	-->
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
		$names		=	$_POST['names'];
		$phone		=	$_POST['phone'];
		$lctn		=	$_POST['lctn'];
		$msg		=	$_POST['msg'];
		$mthd		=	$_POST['mthd'];
		$req_id		=	'req'.rndm(4);
		
		val($names); val($lctn); val($msg); val($phone); val($mthd);
		
		$sql = mysqli_query($conn, 'INSERT INTO e_request(Req_id, Names, Mobile, rMethod, Message, Location) 
								VALUES("'.$req_id.'", "'.$names.'", "'.$phone.'", "'.$mthd.'", "'.$msg.'", "'.$lctn.'")');
		if($sql){
			$_SESSION['req_id'] = $req_id;
			header('Location: assign_drv.php');
		}
		else{
			$_SESSION['error'] = '<script>alert("Message not Sent"); location.reload();</script>';
			header('Location: record_call.php');
		}
	}
}
else{
	header('Location: login.php');
}
?>