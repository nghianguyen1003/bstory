<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/header.php'; ?>  
<div class="content_resize">
  <div class="mainbar">
  <?php
		$idTruyen = $_GET['id'];
		$query = "SELECT * FROM story WHERE story_id = {$idTruyen}";
		$result = $mysqli->query($query);
		if($row = mysqli_fetch_assoc($result)){
			$tenTruyen = $row['name'];
			$ngayDang = $row['created_at'];
			$luotDoc = $row['counter'];
			$chiTiet = $row['detail_text'];
			$catID = $row['cat_id'];
  ?>
    <div class="article">
      <h1><?php echo $tenTruyen; ?></h1>
      <div class="clr"></div>
      <p>Ngày đăng: <?php echo $ngayDang; ?>. Lượt đọc: <?php echo $luotDoc; ?></p>
      <div class="vnecontent">
          <p><?php echo $chiTiet; ?></p>
      </div>
    </div>
    
	<div class="article">
      <h2><span>3</span> Truyện liên quan</h2>
      <div class="clr"></div>
      <?php
		}
		$queryLienQuan = "SELECT * FROM story WHERE story_id <> {$idTruyen} AND cat_id = {$catID} LIMIT 3";
		$resultLienQuan = $mysqli->query($queryLienQuan);
		while($rowLienQuan = mysqli_fetch_assoc($resultLienQuan)){
			$tenTruyenLienQuan = $rowLienQuan['name'];
			$hinhAnhLienQuan = $rowLienQuan['picture'];
			$moTaLienQuan = $rowLienQuan['preview_text'];
			$idTruyenLienQuan = $rowLienQuan['story_id'];
			$urlSeo = "/chi-tiet/".utf8ToLatin($tenTruyenLienQuan)."-{$idTruyenLienQuan}.html";
		?>
		  <div class="comment"> <a href="#"><img src="<?php echo "/files/".$hinhAnhLienQuan; ?>" width="40" height="40" alt="" class="userpic" /></a>
			<h3><a href="<?php echo $urlSeo; ?>" title=""><?php echo $tenTruyenLienQuan; ?></a></h3>
			<p><?php echo $moTaLienQuan; ?></p>
		  </div>
		<?php
		}
		?>
		
		<?php
			$luotDoc += 1;
			$queryLuotDoc = "UPDATE story SET counter = {$luotDoc} WHERE story_id = {$idTruyen}";
			$resultLuotDoc = $mysqli->query($queryLuotDoc);
		?>
    </div>
  </div>
  <div class="sidebar">
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/footer.php'; ?>
  
