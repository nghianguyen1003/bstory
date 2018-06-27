<?php require $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script> //-----------------------------------JS---------------------------------------
	function checkDelete(id){
		if(confirm('Bạn có thực sự muốn xóa ID '+id+' không!')){
			location.href = 'delete.php?iduser='+id,true;
		}
		return false;
	}
	//----------------------------------------END----------------------------------------
</script>
<?php
	$queryTSD = "SELECT COUNT(*) AS TSD FROM users";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	$row_count = ROW_COUNT;
	$tongSoTrang = ceil($tongSoDong/$row_count);
	$current_page = 1;
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	$offset = ($current_page - 1) * $row_count;
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý người dùng</h2>
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
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="">
                                        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="search" class="form-control input-sm" placeholder="Nhập tên người dùng" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Content</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php //------------------------------------đổ dữ liệu ra bảng trong QUẢN LÝ NGƯỜI DÙNG------------------------------------------------
									$query = "SELECT * FROM contact ORDER BY contact_id DESC LIMIT {$offset}, {$row_count}";
									if(isset($_POST['submit'])){
										if(isset($_POST['search'])){
											$search = $_POST['search'];
											$query = "SELECT * FROM contact WHERE contact_id LIKE '%".$search."%' OR name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR website LIKE '%".$search."%' OR content LIKE '%".$search."%'";
										}
									}
									$result = $mysqli->query($query);
									while($row = mysqli_fetch_assoc($result)){
								?>
                                    <tr class="gradeX">
                                        <td><?php echo $row['contact_id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['website']; ?></td>
                                        <td><?php echo $row['content']; ?></td>
                                        <td class="center">
                                        <a href="update.php?iduser=<?php echo $row['contact_id']; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                        <a onClick="return checkDelete(<?php echo $row['contact_id']; ?>);" href="" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
	
										</td>
                                    </tr>
								<?php
									}
									//-----------------------------------------kết thúc-----------------------------------------------------------
								?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ 1 đến 5 của <?php echo $tongSoDong; ?> truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                        <?php
											if($current_page > 1){
										?>
                                           <li class="paginate_button previous" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="index.php?page=<?php echo $current_page - 1; ?>">Trang trước</a></li>
										<?php
											}else{
										?>
										<li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a>Trang trước</a></li>
										<?php
											}
										?>
										
                                        <?php
											for($i = 1; $i <= $tongSoTrang; $i++){
												$active = '';
												if($i == $current_page){
													$active = 'active';
												}
										?>
											<li class="paginate_button <?php echo $active; ?>" aria-controls="dataTables-example" tabindex="0"><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php
											}
										?>  
										
										  <?php
												if($current_page < $tongSoTrang ){
											?>
                                            <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="index.php?page=<?php echo $current_page + 1; ?>">Trang tiếp</a></li>
											<?php
												}else{
											?>
											<li class="paginate_button next disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a>Trang tiếp</a></li>
											<?php
												}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
