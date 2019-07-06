<?php get_header(); ?>
<div class="be-content  be-no-padding be-aside">
    <form action="" method="post">
        <aside class="page-aside">
            <div class="be-scroller">
                <div class="aside-content">
                    <div class="content">
                        <div class="aside-header">
                            <button data-target=".aside-nav" data-toggle="collapse" type="button"
                                    class="navbar-toggle"><span class="fa fa-caret-down"></span></button>
                            <span class="title">网站菜单</span>
                            <p class="description">网站导航菜单设置</p>
                        </div>
                    </div>
                    <div class="aside-nav collapse">
                        <ul class="nav">
                            <li class="active"><a href="<?php echo '?action=setting' ?>"><i class="fa fa-magic"></i> 网站主题</a></li>
                            <li><a href="<?php echo '?action=' ?>"><i class="fa fa-list-ul"></i> 导航菜单</a></li>

                        </ul>

                    </div>
                </div>
            </div>
        </aside>
        <div class="main-content container-fluid">
            <div class="email-head">
                <div class="email-head-subject">
                    <div class="title"><span class="fa fa-magic"></span> <span>网站主题</span>

                    </div>
                </div>

            </div>
            <div class="email-body">
                <p>设置主题</p>
                <h1><?php echo time();?></h1>
            </div>

        </div>
    </form>
</div>


<?php get_footer(); ?>

