<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php ob_start(); ?>
<?php //-------------------FUNCTION-------------------------
	function validationUsername(){
		if(isset($_POST['submit'])){
			if(empty($_POST['username'])){
				echo 'Nhập username';
			}
		}
	}
	function validationPassword(){
		if(isset($_POST['submit'])){
			if(empty($_POST['password'])){
				echo 'Nhập password';
			}
		}
	}
	function validationFullname(){
		if(isset($_POST['submit'])){
			if(empty($_POST['fullname'])){
				echo 'Nhập fullname';
			}
		}
	}
	
	function reloadUsername(){
		if(isset($_POST['username'])){
			echo $_POST['username'];
		}
	}
	
	function reloadPassword(){
		if(isset($_POST['password'])){
			echo $_POST['password'];
		}
	}
	
	function reloadFullname(){
		if(isset($_POST['fullname'])){
			echo $_POST['fullname'];
		}
	}
	
	//------------------------END--------------------------------
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
                <h2>Thêm người dùng</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
		<?php
			if(isset($_GET['msg'])){
				echo '<script>alert("'.$_GET['msg'].'")</script>';
			}
		?>
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
						<?php //-------------------------------thêm dữ liệu vào QUẢN LÝ NGƯỜI DÙNG---------------------------------
							if(isset($_POST['submit'])){
								$username = $_POST['username'];
								$password = md5($_POST['password']);
								$fullname = $_POST['fullname'];
								$query = "INSERT INTO users(username,password,fullname) VALUES('{$username}','{$password}','{$fullname}')";
								$dupesql = "SELECT username FROM users WHERE username = '{$username}'";
								$duperaw = $mysqli->query($dupesql);
								if(mysqli_num_rows($duperaw) > 0){
									echo '<script>alert("Username đã tồn tại")</script>';
								}
								else{
									if($username != null && $password != null && $fullname != null){
										$resutl = $mysqli->query($query);
										header('location: index.php?msg=Thêm thành công!');
									}
								}
								
							} //---------------------------------------KẾT THÚC---------------------------------------------------
						?>
                            <div class="col-md-12">
                                <form role="form" action="" method="POST" id="form">
                                    <div class="form-group">
                                        <label>Username <span class='errorValid'><?php //validationUsername(); ?></span></label>
                                        <input type="text" name="username" class="form-control" value="<?php reloadUsername();?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Password <span class='errorValid'><?php //validationPassword(); ?></label>
                                        <input type="password" name="password" class="form-control" value="<?php reloadPassword();?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Fullname <span class='errorValid'><?php //validationFullname(); ?></label>
                                        <input type="text" name="fullname" class="form-control" value="<?php reloadFullname();?>"/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                            </div>

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
					"username": {
						required: true,
					},
					"password": {
						required: true,
					},
					"fullname": {
						required: true,
					},
				},
				messages: {
					"username": {
						required: "Vui lòng không để trống tên username",
					},
					"password": {
						required: "Vui lòng không để trống tên password",
					},
					"fullname": {
						required: "Vui lòng không để trống tên fullname",
					},
				},
			});
		});	
</script>
<?php ob_end_flush(); ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>