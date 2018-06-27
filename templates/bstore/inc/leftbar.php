<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
  <?php
	$query = "SELECT * FROM cat WHERE status = 1";
	$result = $mysqli->query($query);
	while($row = mysqli_fetch_assoc($result)){
		$tenDanhMuc = $row['name'];
		$catID = $row['cat_id'];
		$urlSeo = "/danh-muc/".utf8ToLatin($tenDanhMuc)."-{$catID}.html";
  ?>
    <li><a href="<?php echo $urlSeo; ?>"><?php echo $tenDanhMuc; ?></a></li>
	<?php
	}
	?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
  <?php
	$queryTruyenMoi = "SELECT story.name AS name,preview_text,story_id
	FROM story
	INNER JOIN cat ON story.cat_id = cat.cat_id 
	WHERE status = 1 	
	ORDER BY story_id DESC LIMIT 6";
	$resultTruyenMoi = $mysqli->query($queryTruyenMoi);
	while($rowTruyenMoi = mysqli_fetch_assoc($resultTruyenMoi)){
		$tenTruyenMoi = $rowTruyenMoi['name'];
		$moTaTruyenMoi = $rowTruyenMoi['preview_text'];
		$idTruyenMoi = $rowTruyenMoi['story_id'];
		$urlSeoChiTiet = "/chi-tiet/".utf8ToLatin($tenTruyenMoi)."-{$idTruyenMoi}.html";
  ?>
    <li><a href="<?php echo $urlSeoChiTiet;?>"><?php echo $tenTruyenMoi; ?></a><br />
      <?php echo $moTaTruyenMoi; ?></li>
  <?php
	}
  ?>
  </ul>
</div>