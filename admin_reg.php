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
if(!(isset($_POST['adm_reg'])))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::.. Admin Registration</title>
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
	$('#dob').pickadate({
		format: 'yyyy-mm-dd',
		selectYears: true,
		selectMonths: true,
		min: [1979,1,1],
		max: [1996,12,31]
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
<legend>Admin Registration form</legend>
<div style="background:#0D870A; color:#EEE; font:0.9em Georgia; font-style:italic;">
<?php if(isset($_SESSION['reg_suces'])){ echo $_SESSION['reg_suces']; unset($_SESSION['reg_suces']);} ?>
</div>
<div style="background:#F00; color:#000; font:0.9em Georgia; font-style:italic;">
<?php chk_session_error(); ?>
</div>
<form method="post" action="<?php $_SERVER['PHP_SELF'];  ?>" onsubmit="validate()">
<table width="500" border="0" cellspacing="10" cellpadding="5" align="center">
  <tr>
    <td>Lastname:</td>
    <td><input name="lname" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Othernames: </td>
    <td><input name="onames" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Password: </td>
    <td><input name="pwd" type="password" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Retype Password: </td>
    <td><input name="rPwd" type="password" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Date of Birth: </td>
    <td><input name="dob" type="text" class="txt_fld" id="dob" readonly="readonly" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Gender: </td>
    <td><input type="radio" name="sex" value="Male" />Male <input type="radio" name="sex" value="Female" />Female <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Address: </td>
    <td><input name="addr" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input name="email" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Phone: </td>
    <td><input name="tel" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
    <td>Qualification: </td>
    <td><input name="qual" type="text" class="txt_fld" required="required" /> <font color="#F00">*</font></td>
  </tr>
  <tr>
  	<td>Rank: </td>
    <td><select name="rank" class="txt_fld" style="height:30px; width:205px;">
    	<option value="0">- - - - - - - Select a Rank</option>
        <option value="global">- - - Global</option>
        <option value="user">- - - User</option>
    </select> <font color="#F00">*</font></td>
   </tr>
</table>
<input type="hidden" name="adm_reg" />
<p align="center"><input type="submit" value="Register" class="btn" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="Clear Form" class="btn" /></p>
</form>
<p align="center">
<button class="btn" style="width:220px; height:30px;" onclick="window.location='adm_profile_mgt.php'">Cancel Registration</button>
</p>
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
	$lname 		= 	$_POST['lname'];
	$onames 	= 	$_POST['onames'];
	$addr 		= 	$_POST['addr'];
	$qual 		= 	$_POST['qual'];
	$tel		=	$_POST['tel'];
	$pwd		=	$_POST['pwd'];
	$rpwd		=	$_POST['rPwd'];
	$email		=	$_POST['email'];
	$sex		=	$_POST['sex'];
	$dob		=	$_POST['dob'];
	$rank		=	$_POST['rank'];
	$admin_id 	= 	'adm'.rndm(4);
	
	val($lname); val($onames); val($addr); val($qual); val($dob);
	
	$msg = true;
	if(valPwd($pwd) == 'false'){ $msg = false;} 
	if(pwdMatch($pwd, $rpwd) == 'false'){ $msg = false;} 
	if(valMail($email) == 'false'){ $msg = false;} 
	if(valRadio($sex) == 'false'){ $msg = false;}
	if(valField($dob) == 'false'){ $msg = false; } 
	if(valNum($tel) == 'false'){ $msg = false;}
	if(valDropDown($rank) == 'false'){ $msg = false; } 
	
	if($msg == true){
		$sql0 = mysqli_query($conn, 'INSERT INTO admin_info VALUES("'.$admin_id.'",
																"'.$lname.'", "'.$onames.'",
																"'.$dob.'", "'.$sex.'",
																"'.$addr.'", "'.$email.'",
																"'.$tel.'", "'.$qual.'"
																) ');
		$sql1 = mysqli_query($conn, 'INSERT INTO admin_login_details(Admin_id, Password, Rank) 
																	VALUES(
																		"'.$admin_id.'",
																		"'.$pwd.'",
																		"'.$rank.'"
																		) ');
		if($sql0 && $sql1){
			$_SESSION['reg_suces'] = " Registration Complete<br> Your ID is ".$admin_id;
			header('Location: '.$_SERVER['PHP_SELF']);
		}
		else{
			$_SESSION['reg_error'] = " Registration not Completed<br>";
			header('Location: '.$_SERVER['PHP_SELF']);
		}
	}
	else{
		header('Location: admin_reg.php');
	}
}
}
else{
	header('Location: login.php');
}
?>