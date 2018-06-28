<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
  <?php
	//Tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD 
	FROM story
	INNER JOIN cat ON story.cat_id = cat.cat_id
	WHERE status = 1";
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
  ?>
    <?php
		$query = "SELECT story.name AS name,created_at,counter,picture,preview_text,story_id 
		FROM story 
		INNER JOIN cat ON story.cat_id = cat.cat_id 
		WHERE status = 1 
		ORDER BY story_id DESC 
		LIMIT {$offset}, {$row_count}";
		
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

    <p class="pages"><small>Trang <?php echo $current_page; ?> của <?php echo $tongSoTrang; ?></small>
	<?php
		for($i = 1; $i <= $tongSoTrang; $i++){
			$urlSeo = "/page/".$i; // -> về xem lại cái này
	?>
		<?php
			if($i == $current_page){
		?>
			<span><?php echo $current_page; ?></span> 
		<?php
			}else{
		?>
		<a href="<?php echo $urlSeo; ?>"><?php echo $i; ?></a> 
		<?php
			}
		?>
	<?php
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
