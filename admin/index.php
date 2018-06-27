<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
		<?php
			$queryQLDM = "SELECT\n"
			. "  (SELECT COUNT(*) FROM cat) as DDM, \n"
			. "  (SELECT COUNT(*) FROM story) as DT,\n"
			. "  (SELECT COUNT(*) FROM users) as DU,\n"
			. "  (SELECT COUNT(*) FROM slides) as DS, \n"
			. "  (SELECT COUNT(*) FROM contact) as DT";
			$resultQLDM = $mysqli->query($queryQLDM);
			if($rowDDM = mysqli_fetch_assoc($resultQLDM)){
		?>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/category/index.php" title="">Quản lý danh mục</a></p>
                        <p class="text-muted">Có <?php echo $rowDDM['DDM']; ?> danh mục</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="glyphicon glyphicon-book"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/story/index.php" title="">Quản lý truyện</a></p>
                        <p class="text-muted">Có <?php echo $rowDDM['DT']; ?> truyện</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                    <i class="glyphicon glyphicon-user"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/user/index.php" title="">Quản lý người dùng</a></p>
                        <p class="text-muted">Có <?php echo $rowDDM['DU']; ?> người dùng</p>
                    </div>
                </div>
            </div>
			 <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="glyphicon glyphicon-picture"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/slides/index.php" title="">Quản lý Slides</a></p>
                        <p class="text-muted">Có <?php echo $rowDDM['DS']; ?> Slides</p>
                    </div>
                </div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                    <i class="glyphicon glyphicon-phone-alt"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/contact/index.php" title="">Quản lý liên hệ</a></p>
                        <p class="text-muted">Có <?php echo $rowDDM['DT']; ?> liên hệ</p>
                    </div>
                </div>
            </div>
		<?php
			}
		?>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>