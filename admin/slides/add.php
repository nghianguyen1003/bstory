<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
	function reloadTenTruyen(){
		if(isset($_POST['tenslide'])){
			echo $_POST['tenslide'];
		}
	}
	
	function reloadLink(){
		if(isset($_POST['link'])){
			echo $_POST['link'];
		}
	}
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Slide</h2>
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
                            <div class="col-md-12">
							<?php
							if(isset($_POST['submit'])){
								$tenSlide = $_POST['tenslide'];
								$link = $_POST['link'];
								if(isset($_FILES['hinhanh']['name']) != "") {
									$namef = $_FILES['hinhanh']['name'];
									$tmp_name = $_FILES['hinhanh']['tmp_name'];
									$myArray = explode('.', $namef);
									$duoiFile = end($myArray);
									$tenFile = 'HinhAnh-' . time(). '.' . $duoiFile;
									$path_root = $_SERVER['DOCUMENT_ROOT'];
									$path_upload = $path_root . "/slides/" . $tenFile;
									move_uploaded_file($tmp_name, $path_upload);
								}
								$queryValidateName = "SELECT name FROM slides WHERE name = '{$tenSlide}'";
								$resultValidateName = $mysqli->query($queryValidateName);
								if(mysqli_num_rows($resultValidateName)>0){
									echo '<script>alert("Tên slides đã tồn tại")</script>';
								}
								else if($_POST['tenslide'] == ''){
									echo '<script>alert("Không để trống tên slides")</script>';
								}
								else if(empty($_FILES['hinhanh']['name'])){
									echo '<script>alert("Hãy chọn ảnh")</script>';
								}
								else{
									$query = "INSERT INTO slides(name, link, picture) VALUES('{$tenSlide}','{$link}','{$tenFile}')";
									$result = $mysqli->query($query);
									if($result){
										header('location: index.php?msg=Thêm thành công!');
									}else{
										header('location: index.php?msg=Có lỗi trong quá trình xữ lý!');
									}
								}
								
							}
							?>
                                <form role="form" method="POST" action="" enctype="multipart/form-data" id="form">
                                    <div class="form-group">
                                        <label>Tên slide</label>
                                        <input type="text" name="tenslide" class="form-control" value="<?php reloadTenTruyen(); ?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Link</label>
                                        <input type="link" name="link" class="form-control" value="<?php reloadLink(); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" />
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
					"tenslide": {
						required: true,
					},
					"link": {
						required: true,
					},
				},
				messages: {
					"tenslide": {
						required: 'Không được để trống tên truyện',
					},
					"link": {
						required: 'Không được để trống đường dẫn',
					},
				},
			});
		});	
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>