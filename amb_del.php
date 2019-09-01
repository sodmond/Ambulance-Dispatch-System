<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin'])){
	if(isset($_COOKIE['del_ID'])){
		$amb_id = $_COOKIE['del_ID'];
		$sql = mysqli_query($conn, 'DELETE FROM ambulance_info WHERE Amb_id="'.$amb_id.'"');
		if($sql){
			$_SESSION['del_suces'] = '<script>alert("Ambulance Profile deleted successfully"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: amb_profile_mgt.php');
		}
		else{
			$_SESSION['del_error'] = '<script>alert("Ambulance Profile cannot be deleted"); location.reload();</script>';
			setcookie('del_ID', '');
			header('Location: amb_profile_mgt.php');
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