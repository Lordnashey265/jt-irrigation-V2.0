<nav class="sidebar">

    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index-2.html"><img src="img/logo.png" alt=""></a>
        <a class="small_logo" href="index-2.html"><img src="img/mini_logo.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li>
            <a href="home" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/21.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>JT Data</span>
                </div>
            </a>
        </li>
        <?php
        if($user_type==1){?>
            <li class="">
                <a   class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/4.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Users</span>
                </div>
                </a>
                <ul>
                <li><a href="admin-list">Users List</a></li>
                <li><a href="add-admin">Add New User</a></li>
                </ul>
            </li>
        <?php
        }

        ?>
        <li>
            <a href="analytics" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/21.svg" alt="">
                </div>
                <div class="nav_title">
                    <span> Data Chart Analytics </span>
                </div>
            </a>
        </li>
        <li>
            <a href="settings" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/18.svg" alt="">
                </div>
                <div class="nav_title">
                    <span> User Settings </span>
                </div>
            </a>
        </li>
      </ul>
</nav>