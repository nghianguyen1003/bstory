<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/DbConnectionUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BStory | VinaEnter Edu</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/templates/bstore/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/templates/bstore/css/coin-slider.css" />
<script type="text/javascript" src="/templates/admin/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/templates/admin/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/templates/bstore/js/script.js"></script>
<script type="text/javascript" src="/templates/bstore/js/coin-slider.min.js"></script>
<style>
	.error{
			color: red;
	}
</style>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="menu_nav">
        <ul>
            <li class="active"><a href="/"><span>Trang chủ</span></a></li>
            <li><a href="/lien-he"><span>Liên hệ</span></a></li>
        </ul>
      </div>
      <div class="logo">
        <h1><a href="/">BStory <small>Dự án khóa PHP tại VinaEnter Edu</small></a></h1>
      </div>
      <div class="clr"></div>
      <div class="slider">
        <div id="coin-slider"> 
			<?php
			$query = "SELECT * FROM slides ORDER BY id DESC LIMIT 3";
			$result = $mysqli->query($query);
			while($row = mysqli_fetch_assoc($result)){
				$hinhAnh = $row['picture'];
				$idSlide = $row['id'];
        $link = $row['link'];
        $ten = $row['name'];
			?>
			<a href="<?php echo $link; ?>"><img src="<?php echo "/slides/".$hinhAnh; ?>" width="940" height="310" alt="<?php echo $ten ?>" /> </a> 
		 <?php
			}
		?>
		</div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
       