<?php get_header(); ?>
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

<form action="" method="post">
            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ibox-default ">
                        <div class="ibox-head">
                            <div class="ibox-title">系统错误</div>
                        </div>
                        <div class="ibox-body">
                            <p class="text-danger"><?php echo $message; ?></p>
                        </div>
                    </div>


                </div>
            </div>

        </form>

<?php get_footer(); ?>

