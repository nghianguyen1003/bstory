<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php ob_start(); ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
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
							//--------------------------------------Xữ lý nút INSERT trong QUẢN LÝ DANH MỤC---------------------------
								if(isset($_POST['submit'])){
									$name = $_POST['tendanhmuc'];
									$queryValid = "SELECT * FROM cat WHERE name = '{$name}'";
									$resultValid = $mysqli->query($queryValid);
									if(mysqli_num_rows($resultValid) > 0){
										echo '<script>alert("Tên danh mục đã tồn tại")</script>';
									}else if(empty($name)){
										echo '<script>alert("Không được để trống danh mục")</script>';
									}else{
										$queryDM = "INSERT INTO cat(name) VALUES('{$name}')";
										$result = $mysqli->query($queryDM); //insert, update, delete -> false 0 hoặc true 1
										if($result){
											header('location: index.php?msg=Thêm thành công!');
										}else{
											header('location: index.php?msg=Có lỗi trong quá trình xữ lý!');
										}
									}
								}
								//-------------------------------------------------KẾT THÚC-----------------------------------------------
							?>
                                <form role="form" action="" method="POST" id="form">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="tendanhmuc" class="form-control" />
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
<!-- /. CSS  -->
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
					"tendanhmuc": {
						required: true,
					},
				},
				messages: {
					"tendanhmuc": {
						required: "Vui lòng không để trống tên danh mục",
					},
				},
			});
		});	
</script>
<?php ob_end_flush(); ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>