<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin'])){
	if(isset($_COOKIE['del_ID'])){
		$drv_id = $_COOKIE['del_ID'];
		$sql0 = mysqli_query($conn, 'DELETE FROM drivers_info WHERE Driver_id="'.$drv_id.'"');
		$sql1 = mysqli_query($conn, 'DELETE FROM drivers_status WHERE Driver_id="'.$drv_id.'"');
		if($sql0 && $sql1){
			$_SESSION['del_suces'] = '<script>alert("Driver Profile deleted successfully"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: drv_profile_mgt.php');
		}
		else{
			$_SESSION['del_error'] = '<script>alert("Driver Profile cannot be deleted"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: drv_profile_mgt.php');
		}
	}
	else{
		header('Location: drv_profile_mgt.php');
	}
}
else{
	header('Location: login.php');
}
?>