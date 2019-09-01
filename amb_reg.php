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
if(!(isset($_POST['amb_reg'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Ambulance Registration</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/default.css" id="theme_base">
<link rel="stylesheet" href="css/default.date.css" id="theme_date">
<script src="js/jquery.2.0.js"></script>
<script src="js/picker.js"></script>
<script src="js/picker.date.js"></script>
<style type="text/css">
fieldset{
	background:#FFF; color:#900; border:1px #900 solid; width:450px; padding:10px; text-align:left;
	margin-left:100px; margin-top:50px; margin-bottom:50px; font:1.0em Arial;
}
legend{
	background:#900; color:#FFF; font:1.2em Cambria;
}
.txt_fld{border:1px #900 solid; width:200px; height:25px; color:#BD5B5B; border-radius:10px;}
</style>
<script type="text/javascript">
$(function(){
	$('#mDate, #pDate').pickadate({
		format: 'yyyy-mm-dd',
		selectYears: true,
		selectMonths: true,
	});
});
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
<legend>Ambulance Registration form</legend>
<div style="background:#0D870A; color:#EEE; font:0.9em Georgia;">
<?php if(isset($_SESSION['reg_suces'])){ echo $_SESSION['reg_suces']; unset($_SESSION['reg_suces']);} ?>
</div>
<div style="background:#F00; color:#000; font:0.9em Georgia; font-style:italic;">
<?php chk_session_error(); ?>
</div>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<table width="500" border="0" cellspacing="10" cellpadding="5" align="center">
  <tr>
    <td>Ambulance Model:</td>
    <td><input name="amb_model" type="text" class="txt_fld" required="required" /></td>
  </tr>
  <tr>
    <td>Manufactured Date: </td>
    <td><input name="man_date" type="text" class="txt_fld" id="mDate" required="required" /></td>
  </tr>
  <tr>
    <td>Engine No: </td>
    <td><input name="eng_no" type="text" class="txt_fld" required="required" /></td>
  </tr>
  <tr>
    <td>Driver in Charge: </td>
    <td><input name="drv_chrg" type="text" class="txt_fld" /></td>
  </tr>
  <tr>
    <td>Purchase Date: </td>
    <td><input name="pur_date" type="text" class="txt_fld" id="pDate" required="required" /></td>
  </tr>
</table>
<input type="hidden" name="amb_reg" />
<p align="center"><input type="submit" value="Register" class="btn" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="Clear Form" class="btn" /></p>
</form>
<p align="center">
<button class="btn" style="width:220px; height:30px;" onclick="window.location='amb_profile_mgt.php'">Cancel Registration</button></p>
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
	$amb_model		=	$_POST['amb_model'];
	$man_date		=	$_POST['man_date'];
	$eng_no			=	$_POST['eng_no'];
	$drv_chrg		=	$_POST['drv_chrg'];
	$pur_date		=	$_POST['pur_date'];
	$amb_id			=	'amb'.rndm(4);
	
	val($amb_model); val($eng_no); val($drv_chrg);
	
	$msg = true;
	if(valField($man_date) == 'false'){ $msg=false; }
	if(valField($pur_date) == 'false'){ $msg=false; }
	
	if($msg == true){
		$sql = mysqli_query($conn, 'INSERT INTO ambulance_info VALUES("'.$amb_id.'",
																"'.$amb_model.'",
																"'.$man_date.'",
																"'.$eng_no.'",
																"'.$drv_chrg.'",
																"'.$pur_date.'"
																) ');
		if($sql){
			$_SESSION['reg_suces'] = " Registration Complete<br> Ambulance ID is ".$amb_id;
			header('Location: '.$_SERVER['PHP_SELF']);
		}
		else{
			$_SESSION['reg_error'] = " Registration not Completed<br>";
			header('Location: '.$_SERVER['PHP_SELF']);
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