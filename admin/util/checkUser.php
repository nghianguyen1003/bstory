<?php
	if(!isset($_SESSION['userinfo'])){
		header('location: /admin/auth/index.php');
		return;
	}
?>