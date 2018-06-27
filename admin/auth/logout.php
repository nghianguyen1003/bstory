<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php';
	ob_start();
	if(isset($_SESSION['userinfo'])){
		unset($_SESSION['userinfo']);
		header('location: /admin/auth/index.php');
	}
	ob_end_flush();
?>