<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin'])){
	if(isset($_COOKIE['del_ID'])){
		$adm_id = $_COOKIE['del_ID'];
		$sql0 = mysqli_query($conn, 'DELETE FROM admin_info WHERE Admin_id="'.$adm_id.'"');
		$sql1 = mysqli_query($conn, 'DELETE FROM admin_login_details WHERE Admin_id="'.$adm_id.'"');
		if($sql0 && $sql1){
			$_SESSION['del_suces'] = '<script>alert("Admin Profile deleted successfully"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: adm_profile_mgt.php');
		}
		else{
			$_SESSION['del_error'] = '<script>alert("Admin Profile cannot be deleted"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: adm_profile_mgt.php');
		}
	}
	else{
		header('Location: amb_profile_mgt.php');
	}
}
else{
	header('Location: login.php');
}
?>