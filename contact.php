<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/header.php'; ?>
<?php
	function reloadName(){
		if(isset($_POST['name'])){
			echo $_POST['name'];
		}
	}
	
	function reloadEmail(){
		if(isset($_POST['email'])){
			echo $_POST['email'];
		}
	}
	
	function reloadWebsitet(){
		if(isset($_POST['website'])){
			echo $_POST['website'];
		}
	}
	
	function reloadMessage(){
		if(isset($_POST['message'])){
			echo $_POST['message'];
		}
	}
?>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h2><span>Liên hệ</span></h2>
      <div class="clr"></div>
      <p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
    </div>
    <div class="article">
      <h2>Form liên hệ</h2>
      <div class="clr"></div>
       <?php
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$website = $_POST['website'];
			$message = $_POST['message'];
			$query = "INSERT INTO contact(name,email,website,content) VALUES('$name','$email','$website','$message')";
			$result = $mysqli->query($query);
			if($name == ''){
				echo '<script>alert("Không được bỏ trống tên")</script>';
			}
			else if($email == ''){
				echo '<script>alert("Không được bỏ trống email")</script>';
			}
			else if($website == ''){
				echo '<script>alert("Không được bỏ trống website")</script>';
			}
			else if($message == ''){
				echo '<script>alert("Không được bỏ trống message")</script>';
			}
			else{
				if($result){
					echo '<script>alert("OK !!!")</script>';
				}
				else{
					echo '<script>alert("Error !!!")</script>';
				}
			}
		}
		?>
      <form action="#" method="post" id="sendemail" class="sendemail">
        <ol>
          <li>
            <label for="name">Họ tên (required)</label>
            <input id="name" name="name" class="text" value="<?php reloadName();?>"/>
          </li>
          <li>
            <label for="email">Email (required)</label>
            <input id="email" name="email" class="text" value="<?php reloadEmail();?>" />
          </li>
          <li>
            <label for="website">Website</label>
            <input id="website" name="website" class="text" value="<?php reloadWebsitet();?>" />
          </li>
          <li>
            <label for="message">Nội dung</label>
            <textarea id="message" name="message" rows="8" cols="50"><?php reloadMessage();?></textarea>
          </li>
          <li>
             <input type="submit" name="submit" value="SEND">
            <div class="clr"></div>
          </li>
        </ol>
      </form>
	  
    </div>
  </div>
  <div class="sidebar">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<script>
		$(document).ready(function (){
			$('.sendemail').validate({
				ignore: [],
				rules: {
					"name": {
						required: true,
					},
					"email": {
						required: true,
						email: true,
					},
				},
				messages: {
					"name": {
						required: "Vui lòng không để trống",
					},
					"email": {
						required: "Vui lòng không để trống",
						email: "Nhập đúng định dạng",
					},
				},
			});
		});	
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstore/inc/footer.php'; ?>
