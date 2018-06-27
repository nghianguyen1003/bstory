<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa Thông Tin Truyện</h2>
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
							$idSlide = $_GET['id'];
							if(isset($_POST['submit'])){
								$tenslide = $_POST['tenslide'];
								$link = $_POST['link'];
								if(isset($_FILES['hinhanh']['name'])) {
									$namef = $_FILES['hinhanh']['name'];
									$tmp_name = $_FILES['hinhanh']['tmp_name'];
									$myArray = explode('.', $namef);
									$duoiFile = end($myArray);
									$tenFile = 'HinhAnh-' . time(). '.' . $duoiFile;
									$path_root = $_SERVER['DOCUMENT_ROOT'];
									$path_upload = $path_root . "/slides/" . $tenFile;
									move_uploaded_file($tmp_name, $path_upload);
								}
								$queryValidateName = "SELECT name FROM slides WHERE name = '{$tenslide}' AND name<>(SELECT name FROM slides WHERE id = {$idSlide})";
								$resultValidateName = $mysqli->query($queryValidateName);
								if(mysqli_num_rows($resultValidateName)>0){
									echo '<script>alert("Tên slide đã tồn tại")</script>';
								}
								else if($_POST['tenslide'] == ''){
									echo '<script>alert("Không để trống tên slide")</script>';
								}
								else{
									if($_FILES['hinhanh']['error'] <= 0){
										$queryDelete = "SELECT * FROM slides WHERE id = {$idSlide}";
										$resultDelete = $mysqli->query($queryDelete);
										$rowDelete = mysqli_fetch_assoc($resultDelete);
										unlink($_SERVER['DOCUMENT_ROOT']."/slides/" . $rowDelete['picture']);
										
										$queryUpdate = "UPDATE slides SET name = '{$tenslide}',link = '{$link}', picture = '{$tenFile}' WHERE id = {$idSlide}";
										$resultUpdate = $mysqli->query($queryUpdate);
										if($resultUpdate){
											//thực hiện thành công
											header("location:index.php?msg=Sửa thành Công !");
										}else {
											header("location:edit.php?msg=Sửa thất bại !");
										}
									}
									else{
										$queryUpdate = "UPDATE slides SET name = '{$tenslide}','{$link}', WHERE id = {$idSlide}";
										$resultUpdate = $mysqli->query($queryUpdate);
										if($resultUpdate){
											//thực hiện thành công
											header("location:index.php?msg=Sửa thành Công !");
										}else {
											header("location:edit.php?msg=Sửa thất bại !");
										}
									}
								}
								
							}
							if(empty($_GET['id'])){
								header('location: index.php');
							}else{
								$query = "SELECT * FROM slides WHERE id = {$idSlide}";
								$result = $mysqli->query($query);
								if($rows = mysqli_fetch_assoc($result)){
							?>
                            <div class="col-md-12">
                                <form role="form" method="POST" action="" enctype="multipart/form-data" id="form">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="tenslide" class="form-control" value="<?php echo $rows['name'];?>"/>
                                    </div>
									<div class="form-group">
                                        <label>Link</label>
                                        <input type="link" name="link" class="form-control" value="<?php echo $rows['link'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh"/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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