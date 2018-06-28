<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
	function reloadTenTruyen(){
		if(isset($_POST['tentruyen'])){
			echo $_POST['tentruyen'];
		}
	}
	
	function reloadMoTa(){
		if(isset($_POST['mota'])){
			echo $_POST['mota'];
		}
	}
	
	function reloadChiTiet(){
		if(isset($_POST['chitiet'])){
			echo $_POST['chitiet'];
		}
	}
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Truyện</h2>
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
								$tenTruyen = $_POST['tentruyen'];
								$catID = $_POST['cat_id'];
								//$hinhAnh = $_FILES['hinhanh'];
								$moTa = $_POST['mota'];
								$chiTiet = $_POST['chitiet'];
								
								if(isset($_FILES['hinhanh']['name']) != "") {
									$namef = $_FILES['hinhanh']['name'];
									$tmp_name = $_FILES['hinhanh']['tmp_name'];
									$myArray = explode('.', $namef);
									$duoiFile = end($myArray);
									$tenFile = 'HinhAnh-' . time(). '.' . $duoiFile;
									$path_root = $_SERVER['DOCUMENT_ROOT'];
									$path_upload = $path_root . "/files/" . $tenFile;
									move_uploaded_file($tmp_name, $path_upload);
								}
								
								$queryValidateName = "SELECT name FROM story WHERE name = '{$tenTruyen}'";
								$resultValidateName = $mysqli->query($queryValidateName);
								if(mysqli_num_rows($resultValidateName)>0){
									echo '<script>alert("Tên truyện đã tồn tại")</script>';
								}
								else if($_POST['tentruyen'] == ''){
									echo '<script>alert("Không để trống tên truyện")</script>';
								}
								else if(empty($_FILES['hinhanh']['name'])){
									echo '<script>alert("Hãy chọn ảnh")</script>';
								}
								else if($_POST['mota'] == ''){
									echo '<script>alert("Không để trống mô tả")</script>';
								}
								else if($_POST['chitiet'] == ''){
									echo '<script>alert("Không để trống nội dung truyện")</script>';
								}
								else{
									$query = "INSERT INTO story(name, preview_text, detail_text, picture, cat_id) VALUES('{$tenTruyen}','{$moTa}','{$chiTiet}','{$tenFile}',{$catID})";
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
                                        <label>Tên truyện</label>
                                        <input type="text" name="tentruyen" class="form-control" value="<?php reloadTenTruyen(); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat_id">
										
										<?php
											$queryDM = 'SELECT * FROM cat';
											$resultDM = $mysqli->query($queryDM);
											while($row = mysqli_fetch_assoc($resultDM)){
												$idcat = $row['cat_id'];
												$catname = $row['name'];
										?>
                                                <option value="<?php echo $idcat;?>"><?php echo $catname; ?></option>
										<?php
											}
										 ?>
                                         </select>	 
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" id="profile-img"/><br>
										<img src="" id="profile-img-tag" width="150px" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="mota"><?php echo reloadMoTa(); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="form-control" rows="5" name="chitiet"><?php echo reloadChiTiet(); ?></textarea>
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
	CKEDITOR.replace('chitiet',
		{
			filebrowserBrowseUrl : 'http://bstory.vne/library/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'http://bstory.vne/library/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'http://bstory.vne/library/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'http://bstory.vne/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'http://bstory.vne/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'http://bstory.vne/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		});
</script>
<script>
		$(document).ready(function (){
			$('#form').validate({
				ignore: [],
				rules: {
					"tentruyen": {
						required: true,
					},
					"hinhanh": {
						required: true,
					},
					"mota": {
						required: true,
					},
					"chitiet": {
						required: function() 
                        {
                         CKEDITOR.instances.chitiet.updateElement();
                        },
						minlength: 200
					},
				},
				messages: {
					"tentruyen": {
						required: 'Không được để trống tên truyện',
					},
					"hinhanh": {
						required: 'Không được để trống hình ảnh',
					},
					"mota": {
						required: 'Không được để trống mô tả truyện',
					},
					"chitiet": {
						required: 'Không được để trống nội dung truyện',
						minlength:"Viết nhiều hơn 200 từ"
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>