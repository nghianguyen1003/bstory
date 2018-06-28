<?php
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php';
	$iduser = $_GET['iduser'];
	
	if(empty($iduser)){
		header('location: index.php');
		die();
	}
	
	$query = 'DELETE FROM contact WHERE contact_id = '.$iduser;
	$result = $mysqli->query($query);
	
	if($result){
		header("location:index.php?msg=Xóa thành công!");
		die();
	}else{
		header("location:index.php?msg=Xóa thất bại!");
		die();
	}
	
	ob_end_flush();
?>