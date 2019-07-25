<?php get_header();
add_breadcrumb('外观设置', url_for('/appearance/theme.php'), '<i class="fa fa-magic"></i>');
?>
<form action="" method="post">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">

        </div>
        <h1><?php echo $this->title;?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb){ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'];?> <?php echo $breadcrumb['title'];?></a></li>
            <?php } ?>
        </ol>
    </div>
</div>


<div class="container-fluid">
    <h1 class="display-heading text-center">外观设置</h1>
    <p class="display-description text-center">选择网站主题模板</p>


    <div class="row">

         <?php foreach ($themes as $themeDir => $theme) { ?>
            <div class="col-md-3">
                <div class="card <?php echo ifOr($current_theme == $themeDir , 'pricing-table-primary','pricing-table-default') ?>" >
                    <img src="<?php echo THTMES_URL; ?><?php echo '/',$themeDir ,'/' , $theme['screenshot']; ?>"  alt="<?php echo $theme['name'];?>" style="width: 384px" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $theme['name'];?></h5>
                        <div class="text-muted card-subtitle"></div>
                        <div></div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo url_for('/appearance/theme.php?action=setting&active='.$themeDir) ?>" class="btn btn-primary">应用</a>
                        <?php if($current_theme == $themeDir){ ?>
                            <a href="<?php echo url_for('/appearance/customizer.php') ?>" class="btn btn-info">定制主题</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
         <?php } ?>

    </div>


</div>


</form>
<?php get_footer(); ?>

