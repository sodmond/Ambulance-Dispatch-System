<?php
require_once('conn.php');
session_start();
if(isset($_SESSION['admin'])){
	if(isset($_POST['req_id'])){
		$req_id = $_POST['req_id'];
		$_SESSION['req_id'] = $req_id;
		header('Location: assign_drv.php');
	}
	else{
		header('Location: admin_center.php');
	}
}
else{
	header('Location: login.php');
}
?>