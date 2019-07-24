<div class="page-content">
    <form action="" method="post">
        <div class="row ">
            <div class="col-lg-2 col-md-3">
                <h6 class="m-t-10 m-b-10"><?php echo $title;?></h6>
                <p class="description"><?php echo $description;?></p>

                <ul class="list-group list-group-divider inbox-list">
                    <?php foreach($menus as $menu){ ?>
                    <li class="list-group-item <?php echo ifOr($menu['active'],'active','');?>">
                        <a href="<?php echo $menu['link']; ?>">
                            <i class="<?php echo $menu['icon']; ?>"></i> <?php echo $menu['title']; ?></a>
                    </li>
                    <?php } ?>


                </ul>
<!--                <div ><a class="btn btn-block btn-sm" target="_blank" href="--><?php //echo BASE_URL;?><!--">预览</a></div>-->



            </div>
            <div class="col-lg-10 col-md-9">
                <?php if(is_callable($content_callback)){
                    echo $content_callback();
                } ?>
            </div>
        </div>

    </form>
</div>


