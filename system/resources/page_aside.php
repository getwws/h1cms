<div class="be-content  be-no-padding be-aside">
    <form action="" method="post">
        <aside class="page-aside">
            <div class="be-scroller">
                <div class="aside-content">
                    <div class="content">
                        <div class="aside-header">
                            <button data-target=".aside-nav" data-toggle="collapse" type="button"
                                    class="navbar-toggle"><span class="fa fa-caret-down"></span></button>
                            <span class="title"><?php echo $title;?></span>
                            <p class="description"><?php echo $description;?></p>
                        </div>
                    </div>
                    <div class="aside-nav collapse">
                        <ul class="nav">
                            <?php foreach($menus as $menu){ ?>
                            <li class="<?php echo ifOr($menu['active'],'active','');?>">
                                <a href="<?php echo $menu['link']; ?>">
                                    <i class="<?php echo $menu['icon']; ?>"></i> <?php echo $menu['title']; ?></a>
                            </li>
                            <?php } ?>


                        </ul>
                        <div class="aside-compose"><a class="btn btn-lg btn-primary btn-block" target="_blank" href="<?php echo BASE_URL;?>">预览</a></div>
                    </div>

                </div>
            </div>
        </aside>
        <div class="main-content container-fluid">
            <?php if(is_callable($content_callback)){
                echo $content_callback();
            } ?>

        </div>
    </form>
</div>

