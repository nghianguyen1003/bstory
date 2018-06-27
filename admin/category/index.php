<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script> //-----------------------------------JS---------------------------------------
	function checkDelete(id){
		if(confirm('Bạn có thực sự muốn xóa ID '+id+' không!')){
			location.href = 'delete.php?id='+id,true;
		}
		return false;
	}
	
	function getStatus(status, cls){
		$.ajax({
			url: '/templates/admin/assets/ajax/result.php',
			type: 'POST',
			cache: false,
			data: {
				astatus: status, 
				acls: cls
			},
			success: function(result){
				$('#' + cls).html(result);
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
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
	
	function getImg($status){
		if($status == 1){
			echo '/templates/admin/assets/img/checked.png';
		}
		else{
			echo '/templates/admin/assets/img/cancel.png';
		}
	}
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

        <div class="row">
		<?php
			if(isset($_GET['msg'])){
				?>
					<h4><?php
						echo '<script>alert("'.$_GET['msg'].'")</script>';
					?></h4>
				<?php
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
                                        <input type="search" name="search" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php //------------------------------------đổ dữ liệu ra bảng trong QUẢN LÝ DANH MỤC------------------------------------------------
									$query = 'SELECT * FROM cat ORDER BY cat_id DESC';
									if(isset($_POST['submit'])){
										if(isset($_POST['search'])){
											$search = $_POST['search'];
											$query = "SELECT * FROM cat WHERE name LIKE '%".$search."%' OR cat_id LIKE '%".$search."%'";
										}
									}
									$result = $mysqli->query($query);
									while($row = mysqli_fetch_assoc($result)){
										$id = $row['cat_id'];
										$name = $row['name'];
										$status = $row['status'];
										$urlDelete = "/admin/category/delete.php?id={$id}";
										$urlEdit = "/admin/category/edit.php?id={$id}&name={$name}";
								?>
                                    <tr class="gradeX">
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $name; ?></td>
										<td id="<?php echo $id; ?>">
											<a href="javascript:void(0)" title="" onclick="return getStatus(<?php echo $status; ?>, '<?php echo $id; ?>')">
												<img src="<?php getImg($status); ?>" alt=""/>
											</a>
										</td>
                                        <td class="center">
                                            <a href="<?php echo $urlEdit; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a onClick="return checkDelete(<?php echo $id; ?>);" href="" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ 1 đến 5 của 24 truyện</div>
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
											for($i = 1; $i < $tongSoTrang; $i++){
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
												if($current_page < $tongSoTrang){
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
