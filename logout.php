<?php
session_start();
if(isset($_SESSION['admin'])){
	unset($_SESSION['admin']);
	session_destroy();
	session_start();
	$_SESSION['logout'] = 'You have successfully logged out';
	header('Location: login.php');
}
else{
	header('Location: login.php');
}
?>