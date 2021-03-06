<?php session_start();?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php'; ?>
<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/templates/admin/assets/css/main.css">
</head>
<body>
	<?php
		if(isset($_GET['msg'])){
		?>
			<h4><?php
			echo '<script>alert("'.$_GET['msg'].'")</script>';
			?></h4>
		<?php
			}
	?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			<?php
				if(isset($_POST['submit'])){
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					$query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
					$result = $mysqli->query($query);
					$arLogin = mysqli_fetch_assoc($result);
					if($arLogin){
						$_SESSION['userinfo'] = $arLogin;
						header('location:/admin/story/');
					}else{
						header('location:/admin/auth/index.php?msg=Tên đăng nhập hoặc mật khẩu sai!!!');
					}
				}
			?>
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-26">
						Login
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<input class="login100-form-btn" name="submit" type="submit" value="Login"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
<?php ob_end_flush();?>