<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
  <?php
		$idDanhMuc = $_GET['id'];
		$queryCat = "SELECT * FROM cat WHERE cat_id = {$idDanhMuc}";
		$resultCat = $mysqli->query($queryCat);
		$rowCat = mysqli_fetch_assoc($resultCat);
		$nameCat = $rowCat['name'];
  ?>
	<h1><?php echo $nameCat; ?></h1>
    <?php
		//Phân trang
		$queryTSD = "SELECT COUNT(*) AS TSD FROM story WHERE cat_id = {$idDanhMuc}";
		$resultTSD = $mysqli->query($queryTSD);
		$arTmp = mysqli_fetch_assoc($resultTSD);
		$tongSoDong = $arTmp['TSD'];
		//Số truyện trên 1 trang.
		$row_count = ROW_COUNT;
		//Tổng số trang
		$tongSoTrang = ceil($tongSoDong/$row_count);
		//trang hiện tại
		$current_page = 1;
		if(isset($_GET['page'])){
			$current_page = $_GET['page'];
		}
		$offset = ($current_page - 1) * $row_count;
		//Kết thúc phân trang--------------------------------------------------
	?>
	<?php
		$query = "SELECT * FROM story WHERE cat_id = {$idDanhMuc} ORDER BY story_id DESC LIMIT {$offset}, {$row_count}";
		$result = $mysqli->query($query);
		
		while($row = mysqli_fetch_assoc($result)){
			$tenTruyen = $row['name'];
			$ngayDang = $row['created_at'];
			$luotDoc = $row['counter'];
			$hinhAnh = $row['picture'];
			$moTa = $row['preview_text'];
			$idTruyen = $row['story_id'];
			$urlSeoChiTiet = "/chi-tiet/".utf8ToLatin($tenTruyen)."-{$idTruyen}.html";	
	?>
    <div class="article">
	 
		<a style = 'text-decoration: none;' href="<?php echo $urlSeoChiTiet; ?>"><h2><?php echo $tenTruyen; ?></h2></a>
      <p class="infopost">Ngày đăng: <?php echo $ngayDang; ?>. Lượt đọc: <?php echo $luotDoc; ?></p>
      <div class="clr"></div>
      <div class="img"><a style = 'text-decoration: none;' href="<?php echo $urlSeoChiTiet; ?>"><img src="<?php echo "/files/".$hinhAnh; ?>" width="161" height="192" alt="" class="fl" /></a></div>
      <div class="post_content">
        <p><?php echo $moTa; ?></p>
        <p class="spec"><a href="<?php echo $urlSeoChiTiet; ?>" class="rm">Chi tiết</a></p>
      </div>
      <div class="clr"></div>
    </div>
	<?php
		}
	?>
    <p class="pages"><small>Trang 1 / 2</small> 
	<?php
		for($i = 1; $i <= $tongSoTrang; $i++){
			$urlSeoCat = "/danh-muc/".utf8ToLatin($nameCat)."-{$idDanhMuc}-{$i}.html";
			if($i == $current_page){
	?>
				<span><?php echo $current_page; ?></span> 
	<?php
			}else{
	?>
			<a href="<?php echo $urlSeoCat; ?>"><?php echo $i; ?></a> 
	<?php
			}
		}
	?>
	</p>
  </div>
  <div class="sidebar">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/footer.php'; ?>
