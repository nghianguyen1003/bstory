<?php
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php';
	$iduser = $_GET['iduser'];
	
	$query2 = 'SELECT * FROM users WHERE id = '.$iduser;
	$result2 = $mysqli->query($query2);
	$arUser = mysqli_fetch_assoc($result2);
	if($arUser['username'] == 'admin' && $_SESSION['userinfo']['username'] != 'admin'){
		header('location: index.php?msg=Bạn không có quyền xóa Admin');
		die();
	}
	
	if(empty($iduser)){
		header('location: index.php');
		die();
	}
	
	$query = 'DELETE FROM users WHERE id = '.$iduser;
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