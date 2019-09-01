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
if(isset($_COOKIE['mod_ID']))
{
	$id = $_COOKIE['mod_ID'];
	$amb = mysqli_fetch_array(mysqli_query($conn, 'SELECT * FROM ambulance_info WHERE Amb_id="'.$id.'"'));
if(!(isset($_POST['amb_mod'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Ambulance Profile Modification</title>
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
<legend>Modify Profile</legend>
<div style="background:#0D870A; color:#EEE; font:0.9em Georgia;">
<?php if(isset($_SESSION['reg_suces'])){ echo $_SESSION['reg_suces']; unset($_SESSION['reg_suces']);} ?>
</div>
<div style="background:#F00; color:#000; font:0.9em Georgia; font-style:italic;">
<?php chk_session_error(); ?>
</div>
<form method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">
<table width="500" border="0" cellspacing="10" cellpadding="5" align="center">
  <tr>
  	<td>Ambulance ID:</td>
    <td><input type="text" class="txt_fld" readonly="readonly" value="<?php echo $amb['Amb_id'] ?>" /></td>
  </tr>
  <tr>
    <td>Ambulance Model:</td>
    <td><input name="amb_model" type="text" class="txt_fld" required="required" value="<?php echo $amb['Amb_model'] ?>" /></td>
  </tr>
  <tr>
    <td>Manufactured Date: </td>
    <td><input name="man_date" type="text" class="txt_fld" id="mDate" required="required" value="<?php echo $amb['Manufacture_date'] ?>" /></td>
  </tr>
  <tr>
    <td>Engine No: </td>
    <td><input name="eng_no" type="text" class="txt_fld" required="required" value="<?php echo $amb['Engine_num'] ?>" /></td>
  </tr>
  <tr>
    <td>Driver in Charge: </td>
    <td><input name="drv_chrg" type="text" class="txt_fld" value="<?php echo $amb['Driver_id'] ?>" /></td>
  </tr>
  <tr>
    <td>Purchase Date: </td>
    <td><input name="pur_date" type="text" class="txt_fld" id="pDate" required="required" value="<?php echo $amb['Purchase_date'] ?>" /></td>
  </tr>
</table>
<input type="hidden" name="amb_mod" />
<p align="center"><input type="submit" value="Save Changes" class="btn" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Clear Form" class="btn" /></p>
</form>
<p align="center"><a href="amb_profile_mgt.php">&crarr; Go back home</a></p>
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
}// End if [Checking Form submition]
else{
	$amb_model		=	$_POST['amb_model'];
	$man_date		=	$_POST['man_date'];
	$eng_no			=	$_POST['eng_no'];
	$drv_chrg		=	$_POST['drv_chrg'];
	$pur_date		=	$_POST['pur_date'];
	
	val($amb_model); val($eng_no); val($drv_chrg);
	
	$msg = true; 
	if(valField($man_date) == 'false'){ $msg=false; }
	if(valField($pur_date) == 'false'){ $msg=false; }
	
	if($msg == true){
		$sql = mysqli_query($conn, 'UPDATE ambulance_info SET Amb_model = "'.$amb_model.'",
														Manufacture_date = "'.$man_date.'",
														Engine_num = "'.$eng_no.'",
														Driver_id = "'.$drv_chrg.'",
														Purchase_date = "'.$pur_date.'"
														WHERE Amb_id = "'.$id.'"
														');
		if($sql){
			$_SESSION['reg_suces'] = " Profile Modification Succesful";
			header('Location: '.$_SERVER['PHP_SELF']);
		}
		else{
			$_SESSION['reg_error'] = " Error Modifying Profile<br>";
			header('Location: '.$_SERVER['PHP_SELF']);
		}
	}
	else{
		header('Location: amb_mod.php');
	}
}
}// End if [Checking for cookie]
else{
	header('Location: amb_profile_mgt.php');
}
}// End if [Checking for admin session]
else{
	header('Location: login.php');
}
?>