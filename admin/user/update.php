<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php ob_start(); ?>
<?php //-----------------------------------------FUNCTION---------------------------
	/*function validationFullname(){
		if(isset($_POST['submit'])){
			if(empty($_POST['fullname'])){
				echo 'Không được để trống fullname';
			}
		}
	}*/
	//----------------------------------------------END----------------------------------
?>
<!----------------------------CSS-------------------------------->
<style>
	.errorValid{
		color: red;
		font-family: cursive;
		font-size: 12px;
	}
</style>
<!----------------------------END-------------------------------->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Cập nhật thông tin người dùng</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
						<?php					
							$idUser = $_GET['iduser'];
							$query2 = 'SELECT * FROM users WHERE id = '.$idUser;
							$result2 = $mysqli->query($query2);
							$arUser = mysqli_fetch_assoc($result2);
							if($arUser['username'] == 'admin' && $_SESSION['userinfo']['username'] != 'admin'){
								header('location: index.php?msg=Bạn không có quyền sửa Admin');
							}
							if(isset($_POST['submit'])){
								$username = $_POST['username'];
								$fullname = $_POST['fullname'];
								$password = $_POST['password'];
								//-----------------------------------------------------------------------------
								if(empty($_POST['fullname'])){
									echo "<script>alert('Không được để trống fullname')</script>";
								}else{
									if($password == ''){
									$query = "UPDATE users SET fullname = '{$fullname}' WHERE id = ".$idUser;//lệnh update
									$resutl = $mysqli->query($query);
									if($resutl){
										header('location: index.php?msg=Cập nhật thông tin người dùng thành công!');
										die();
									}
									header('location: index.php?msg=Cập nhật thông tin người dùng thất bại!');
									die();
									}
									else{
										$password = md5($_POST['password']);
										$queryPass = "UPDATE users SET password = '{$password}', fullname = '{$fullname}' WHERE id = ".$idUser;//lệnh update
										$resutlPass = $mysqli->query($queryPass);
										if($resutlPass){
											header('location: index.php?msg=Cập nhật thông tin người dùng thành công!');
											die();
										}
										header('location: index.php?msg=Cập nhật thông tin người dùng thất bại!');
										die();
									}
								}
							}

							
							if($idUser == null){
								header('location: index.php');
							}							
							else{
								$queryShow = 'SELECT * FROM users WHERE id = '.$idUser;
								$resultShow = $mysqli->query($queryShow);
								if($row = mysqli_fetch_assoc($resultShow)){
						?>
                            <div class="col-md-12">
                                <form role="form" action="" method="POST" id="form">
                                    <div class="form-group">
                                        <label>Username <span class='errorValid'></span></label>
                                        <input type="text" name="username" class="form-control" readonly value="<?php echo $row['username']; ?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"/>
                                    </div>
									<div class="form-group">
                                        <label>Fullname <span class='errorValid'></span></label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname']; ?>"/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                            </div>
						<?php
								}
							}
						?>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<style>
	.error{
		color: red;
	}
</style>
<!-- /. JS  -->
<script>
		$(document).ready(function (){
			$('#form').validate({
				ignore: [],
				rules: {
					"fullname": {
						required: true,
					},
				},
				messages: {
					"fullname": {
						required: "Vui lòng không để trống tên người dùng",
					},
				},
			});
		});	
</script>
<?php ob_end_flush(); ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>