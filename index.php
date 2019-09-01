<?php
require_once('conn.php');
require_once('validate.php');
session_start();
if(!(isset($_POST['mthd'])))
{
	if(isset($_SESSION['suces'])){ echo $_SESSION['suces']; unset($_SESSION['suces']); }
	if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Automated Ambulance System</title>
<link rel="stylesheet" href="css/main.css" />
<style type="text/css">
.content{width:900px; height:500px; background:url(images/bg_amb0.jpg) center;}
table{margin-left:230px; margin-top:80px;}
fieldset{
	width:340px; background:#FB4448;
	font:17px Calibri; text-align:right;
	border:0px; box-shadow:1px 1px 3px 3px;
	border-top-left-radius:20px; border-bottom-left-radius:20px;
}
#adm{
	width:50px; height:360px; background:#FB4448; border:0px;
	box-shadow:1px 1px 3px 3px; border-top-right-radius:20px; border-bottom-right-radius:20px;
}
#adm a{
	width:180px; height:30px; position:absolute; transform:rotate(90deg); margin-top:150px; margin-left:-65px; border-radius:10px; 
	font:1.5em 'Courier New', Courier, monospace; color:#900; text-decoration:none; text-align:center; background:#000;
}
#adm a:hover{background:#0A0A0A; color:#D20000;}
</style>
</head>

<body>
<div class="container">

<!-- 	Head Section Starts here	 -->
<div class="header">
<img src="images/header.png"  />
</div>
<!-- 	Content Section Starts here	 -->
<div class="content">
<table width="" border="0" cellpadding="2" cellspacing="2">
<tr>
<td id="eRequest">
<fieldset>
<h2 align="center">Emergency Request</h2>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>Enter Names: <font color="#F00">*</font>
<input type="text" name="names" required="required" class="txt" placeholder="Enter your name" /></p>
<p>Enter Phone No: <font color="#F00">*</font>
<input type="text" name="phone" required="required" class="txt" placeholder="Enter your phone number" /></p>
<p>Enter Location: <input type="text" name="lctn" class="txt" placeholder="Enter your location" /></p>
<p>Message: <font color="#F00">*</font>
<textarea rows="3" cols="23" name="msg" required="required" placeholder="Enter detailed description of emergency and location">
</textarea></p>
<input type="hidden" name="mthd" value="Message" />
<p align="center"><input type="submit" value="Request" class="btn" /></p>
</form>
</fieldset>
</td>
<td id="admin_login">
<div id="adm">
<a href="login.php"><strong>ADMIN LOGIN</strong></a>
</div>
</td>
</tr>
</table>
</div>
<!-- 	Footer Section Starts here	 -->
<div class="footer">
<br />
ADMA &copy; 2015 | Project Developed by Sodik Owolabi
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
		$_SESSION['suces'] = '<script>alert("Message Sent and Ambulance Requested"); location.reload();</script>';
		header('Location: index.php');
	}
	else{
		$_SESSION['error'] = '<script>alert("Ambulance Request Error"); location.reload();</script>';
		header('Location: index.php');
	}
}
?>