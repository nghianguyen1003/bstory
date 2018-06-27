<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php';?>
<?php ob_start(); ?>
<?php
	if(empty($_GET['id'])){
		header('location: index.php');
	}else{
		$id = $_GET['id'];
		$query = "DELETE FROM cat WHERE cat_id = {$id}";
		$result = $mysqli->query($query);
		if($result){
			header('location: /admin/category/index.php?msg=Xóa thành công');
		}
	}
?>
<?php ob_end_flush(); ?>
