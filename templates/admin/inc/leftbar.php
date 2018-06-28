<script type="text/javascript" src="/templates/admin/assets/js/chuyenMauMenu.js"></script>
<nav class="navbar-default navbar-side" role="navigation">

<script>
    $(document).ready(function() {
        var pathname = window.location.pathname;
        if (pathname == '/admin/contact/' || pathname == '/admin/contact/index.php'){
            $("#contact").css("background-color", "#fc8010");
        }else if(pathname == '/admin/category/' || pathname == '/admin/category/add.php' || pathname == '/admin/category/edit.php' || pathname == '/admin/category/index.php'){
            $("#cat").css("background-color", "#fc8010");
        }else if(pathname == '/admin/story/' || pathname == '/admin/story/index.php' || pathname == '/admin/story/add.php' || pathname == '/admin/story/edit.php'){
            $("#story").css("background-color", "#fc8010");
        }else if(pathname == '/admin/user/' || pathname == '/admin/user/add.php' || pathname == '/admin/user/update.php' || pathname == '/admin/user/index.php'){
            $("#user").css("background-color", "#fc8010");
        }else if(pathname == '/admin/slides/' || pathname == '/admin/slides/index.php' || pathname == '/admin/slides/add.php' || pathname == '/admin/slides/edit    .php'){
            $("#slide").css("background-color", "#fc8010");
        }else if(pathname == '/admin/' || pathname == '/admin/index.php'){
            $("#home").css("background-color", "#fc8010");
        }
    });
</script>
    <?php
		if(isset($_SESSION['userinfo'])){
			$arrUserInfo = $_SESSION['userinfo'];
            $fullName = $arrUserInfo['fullname'];
            $hinhAnh = $arrUserInfo['picture'];
        }
	?>
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="/files/userIMG/<?php echo $hinhAnh; ?>" style="width: 260px; height: 150px"/>
            </li>
            <li>
                <a id="home" href="/admin/"><i class="glyphicon glyphicon-home"></i> Trang chủ</a>
            </li>
            <li>
			
                <a id="cat" href="/admin/category/"><i class="fa fa-bars"></i> Quản lý danh mục</a>
            </li>
            <li>
                <a id="story" href="/admin/story/"><i class="glyphicon glyphicon-book"></i> Quản lý truyện</a>
            </li>
            <li>
                <a id="user" href="/admin/user/"><i class="glyphicon glyphicon-user"></i> Quản lý người dùng</a>
            </li>
			<li>
                <a id="slide" href="/admin/slides/"><i class="glyphicon glyphicon-picture"></i> Quản lý Slides</a>
            </li>
			<li>
                <a id="contact" href="/admin/contact/"><i class="glyphicon glyphicon-phone-alt"></i> Quản lý liên hệ</a>
            </li>
        </ul>

    </div>
</nav>
<!-- /. NAV SIDE  -->