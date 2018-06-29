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
							$idTruyen = $_GET['id'];
							if(isset($_POST['submit'])){
								$tenTruyen = $_POST['tentruyen'];
								$catID = $_POST['cat_id'];
								//$hinhAnh = $_FILES['hinhanh'];
								$moTa = $_POST['mota'];
								$chiTiet = $_POST['chitiet'];
								if(isset($_FILES['hinhanh']['name'])) {
									$namef = $_FILES['hinhanh']['name'];
									$tmp_name = $_FILES['hinhanh']['tmp_name'];
									$myArray = explode('.', $namef);
									$duoiFile = end($myArray);
									$tenFile = 'HinhAnh-' . time(). '.' . $duoiFile;
									$path_root = $_SERVER['DOCUMENT_ROOT'];
									$path_upload = $path_root . "/files/" . $tenFile;
									move_uploaded_file($tmp_name, $path_upload);
								}
								$queryValidateName = "SELECT name FROM story WHERE name = '{$tenTruyen}' AND name<>(SELECT name FROM story WHERE story_id = {$idTruyen})";
								$resultValidateName = $mysqli->query($queryValidateName);
								if(mysqli_num_rows($resultValidateName)>0){
									echo '<script>alert("Tên truyện đã tồn tại")</script>';
								}
								else if($_POST['tentruyen'] == ''){
									echo '<script>alert("Không để trống tên truyện")</script>';
								}
								else if($_POST['mota'] == ''){
									echo '<script>alert("Không để trống mô tả")</script>';
								}
								else if($_POST['chitiet'] == ''){
									echo '<script>alert("Không để trống chi tiết")</script>';
								}
								else{
									if($_FILES['hinhanh']['error'] <= 0){
										$queryDelete = "SELECT * FROM story WHERE story_id = {$idTruyen}";
										$resultDelete = $mysqli->query($queryDelete);
										$rowDelete = mysqli_fetch_assoc($resultDelete);
										unlink($_SERVER['DOCUMENT_ROOT']."/files/" . $rowDelete['picture']);
										
										$queryUpdate = "UPDATE story SET name = '{$tenTruyen}', preview_text = '{$moTa}', detail_text = '{$chiTiet}', picture = '{$tenFile}', cat_id = {$catID} WHERE story_id = {$idTruyen}";
										$resultUpdate = $mysqli->query($queryUpdate);
										if($resultUpdate){
											//thực hiện thành công
											header("location:index.php?msg=Sửa thành Công !");
										}else {
											header("location:edit.php?msg= Sửa thất bại !");
										}
									}
									else{
										$queryUpdate = "UPDATE story SET name = '{$tenTruyen}', preview_text = '{$moTa}', detail_text = '{$chiTiet}', cat_id = {$catID} WHERE story_id = {$idTruyen}";
										$resultUpdate = $mysqli->query($queryUpdate);
										if($resultUpdate){
											//thực hiện thành công
											header("location:index.php?msg=Sửa thành Công !");
										}else {
											header("location:edit.php?msg= Sửa thất bại !");
										}
									}
								}
								
							}
							if(empty($_GET['id'])){
								header('location: index.php');
							}else{
								$query = "SELECT * FROM story WHERE story_id = {$idTruyen}";
								$result = $mysqli->query($query);
								if($rows = mysqli_fetch_assoc($result)){
							?>
                            <div class="col-md-12">
                                <form role="form" method="POST" action="" enctype="multipart/form-data" id="form">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="tentruyen" class="form-control" value="<?php echo $rows['name'];?>"/>
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
                                            <option value="<?php echo $idcat; ?>"><?php echo $catname; ?></option>
										<?php
											}
										 ?>
                                        </select>	 
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh"  id="profile-img"/><br>
										<img src="/files/<?php echo $rows['picture']; ?>" id="profile-img-tag" width="150px"  />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="mota"><?php echo $rows['preview_text'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="form-control" rows="5" name="chitiet"><?php echo $rows['detail_text'];?></textarea>
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
					"tentruyen": {
						required: true,
					},
					"mota": {
							required: function() 
							{
							CKEDITOR.instances.mota.updateElement();
							},
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
					"mota": {
						required: 'Không được để trống mô tả',
					},
					"chitiet": {
						required: 'Không được để trống nội dung truyện',
						minlength:"Viết nhiều hơn 200 từ"
					},
				},
			});
		});	
	CKEDITOR.replace('mota');
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