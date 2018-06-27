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
								$iddm = $_GET['id'];
								$nameDm = $_GET['name'];
								if(empty($iddm) || empty($nameDm)){
										header('location: index.php');
								}else{	
									if(isset($_POST['submit'])){
										$name_cat = $_POST['tendanhmuc'];
										$queryValid = "SELECT * FROM cat WHERE name = '{$name_cat}' AND name<>(SELECT name FROM cat WHERE cat_id = {$iddm})";
										$resultValid = $mysqli->query($queryValid);
										
										if(mysqli_num_rows($resultValid) > 0){
											echo '<script>alert("Tên danh mục đã tồn tại")</script>';
										}else if(empty($name_cat)){
											echo '<script>alert("Không được để trống tên danh mục")</script>';
										}else{
											$queryDM = "UPDATE cat SET name='{$name_cat}' WHERE cat_id={$iddm}";
											$result = $mysqli->query($queryDM);
											if($result){
												//thực hiện thành công
												header("location:index.php?msg=Sửa Thành Công !");
											}else{
												header("location:update.php?msg=Thất bại !");
											}
										}
									} 	
								}
								
								//-------------------------------------------------KẾT THÚC-----------------------------------------------
							?>
                                <form role="form" action="" method="POST" id="form">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="tendanhmuc" value ="<?php echo $nameDm; ?>" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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