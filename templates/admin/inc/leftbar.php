<script type="text/javascript" src="/templates/admin/assets/js/chuyenMauMenu.js"></script>
<nav class="navbar-default navbar-side" role="navigation">

<script>
    $(document).ready(function() {
        var pathname = window.location.pathname;
        if (pathname == '/admin/'){
            $("#home").css("background-color", "#fc8010");
        }else if(pathname == '/admin/category/'){
            $("#cat").css("background-color", "#fc8010");
        }else if(pathname == '/admin/story/'){
            $("#story").css("background-color", "#fc8010");
        }else if(pathname == '/admin/user/'){
            $("#user").css("background-color", "#fc8010");
        }else if(pathname == '/admin/slides/'){
            $("#slide").css("background-color", "#fc8010");
        }else{
            $("#contact").css("background-color", "#fc8010");
        }
    });
</script>

    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="/templates/admin/assets/img/find_user.png" class="user-image img-responsive" />
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