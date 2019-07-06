<?php get_header(); ?>
<form action="" method="post">
    <div class="be-content">
        <div class="main-content container-fluid">
            <h1 class="display-heading text-center">主题设置</h1>
            <p class="display-description text-center">选择网站主题模板</p>
            <div class="row">
                <?php foreach ($themes as $themeDir => $theme) { ?>
                <div class="col-md-4">
                    <div class="pricing-table <?php echo ifOr($current_theme == $themeDir , 'pricing-table-primary','pricing-table-default') ?>">
                        <div class="pricing-table-image">
                            <img src="<?php echo THTMES_URL; ?><?php echo '/',$themeDir ,'/' , $theme['screenshot']; ?>" width="348px" alt="<?php echo $theme['name'];?>"
                                 class="img-thumbnail">
                        </div>
                        <div class="pricing-table-title"><?php echo $theme['name'];?></div>
                        <div class="panel-divider panel-divider-xl"></div>
                        <ul class="pricing-table-features">
                        </ul>
                        <a href="<?php echo url_for('/appearance/theme.php?action=setting&active='.$themeDir) ?>" class="btn btn-primary">应用</a>
                        <?php if($current_theme == $themeDir){ ?>
                        <a href="<?php echo url_for('/appearance/customizer.php') ?>" class="btn btn-info">定制主题</a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>

    </div>
</form>
<?php get_footer(); ?>

