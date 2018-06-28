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
								if(isset($_FILES['hinhanh']['name'])) {
									$namef = $_FILES['hinhanh']['name'];
									$tmp_name = $_FILES['hinhanh']['tmp_name'];
									$myArray = explode('.', $namef);
									$duoiFile = end($myArray);
									$tenFile = 'HinhAnh-' . time(). '.' . $duoiFile;
									$path_root = $_SERVER['DOCUMENT_ROOT'];
									$path_upload = $path_root . "/files/userIMG/" . $tenFile;
									move_uploaded_file($tmp_name, $path_upload);
								}
								//-----------------------------------------------------------------------------
								if(empty($_POST['fullname'])){
									echo "<script>alert('Không được để trống fullname')</script>";
								}else{
									if($password == '' && $_FILES['hinhanh']['name'] == ''){
										$queryDelete = "SELECT * FROM users WHERE id = {$idUser}";
										$resultDelete = $mysqli->query($queryDelete);
										$rowDelete = mysqli_fetch_assoc($resultDelete);
										unlink($_SERVER['DOCUMENT_ROOT']."/files/userIMG/" . $rowDelete['picture']);

										$query = "UPDATE users SET fullname = '{$fullname}' WHERE id = ".$idUser;//lệnh update
										$resutl = $mysqli->query($query);
										if($resutl){
											header('location: index.php?msg=Cập nhật thông tin người dùng thành công!');
											die();
									}
									header('location: index.php?msg=Cập nhật thông tin người dùng thất bại!');
									die();
									}else if($password != '' && $_FILES['hinhanh']['error'] <= 0){
										$password = md5($_POST['password']);
										$queryDelete = "SELECT * FROM users WHERE id = {$idUser}";
										$resultDelete = $mysqli->query($queryDelete);
										$rowDelete = mysqli_fetch_assoc($resultDelete);
										unlink($_SERVER['DOCUMENT_ROOT']."/files/userIMG/" . $rowDelete['picture']);

										$query = "UPDATE users SET password = '{$password}', fullname = '{$fullname}', picture = '{$tenFile}' WHERE id = ".$idUser;//lệnh update
										$resutl = $mysqli->query($query);
										if($resutl){
											header('location: index.php?msg=Cập nhật thông tin người dùng thành công!');
											die();
									}
									header('location: index.php?msg=Cập nhật thông tin người dùng thất bại!');
									die();
									}else if($password != '' && $_FILES['hinhanh']['name'] == ''){
										$password = md5($_POST['password']);
										$queryPass = "UPDATE users SET password = '{$password}', fullname = '{$fullname}' WHERE id = ".$idUser;//lệnh update
										$resutlPass = $mysqli->query($queryPass);
										if($resutlPass){
											header('location: index.php?msg=Cập nhật thông tin người dùng thành công!');
											die();
										}
										header('location: index.php?msg=Cập nhật thông tin người dùng thất bại!');
										die();
									}else{
										$queryDelete = "SELECT * FROM users WHERE id = {$idUser}";
										$resultDelete = $mysqli->query($queryDelete);
										$rowDelete = mysqli_fetch_assoc($resultDelete);
										unlink($_SERVER['DOCUMENT_ROOT']."/files/userIMG/" . $rowDelete['picture']);

										$query = "UPDATE users SET fullname = '{$fullname}', picture = '{$tenFile}' WHERE id = ".$idUser;//lệnh update
										$resutl = $mysqli->query($query);
										if($resutl){
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
                                <form role="form" action="" method="POST" enctype="multipart/form-data" id="form" id="form">
                                    <div class="form-group">
                                        <label>Username <span class='errorValid'></span></label>
                                        <input type="text" name="username" class="form-control" readonly value="<?php echo $row['username']; ?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"/>
                                    </div>
									<div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" id="profile-img"/><br>
										<img src="" id="profile-img-tag" width="150px" />
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
<?php ob_end_flush(); ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>