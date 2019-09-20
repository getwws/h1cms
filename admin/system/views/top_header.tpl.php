<header class="header">
    <div class="page-brand">
        <a class="link" href="<?php echo url_for('/dashboard/');?>">
                    <span class="brand">H1
                        <span class="brand-tip">CMS</span>
                    </span>
            <span class="brand-mini">H1</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar ">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="fa fa-bars"></i></a>
            </li>
            <li>
                <form class="navbar-search  d-none d-sm-none" action="javascript:;">
                    <div class="rel">
                        <span class="search-icon"><i class="fa fa-search"></i></span>
                        <input class="form-control" placeholder="Search here...">
                    </div>
                </form>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">

            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <?php echo get_avatar(\system\Auth::user()->avatar,32); ?>
                    <span></span><?php echo \system\Auth::user()->display_name ; ?></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo url_for('/user/profile.php');?>"><i class="fa fa-user"></i>个人信息</a>
                    <a class="dropdown-item" href="<?php echo url_for('/system/setting.php');?>"><i class="fa fa-cog"></i>系统设置</a>
<!--                    <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>-->
                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="<?php echo url_for('/system/logout.php');?>"><i class="fa fa-power-off"></i>退出</a>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
