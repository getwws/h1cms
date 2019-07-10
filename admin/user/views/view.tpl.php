<?php get_header();
add_breadcrumb('账户信息', url_for('/user/'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/user/?action=edit',['id'=>intval($_GET['id'])]);?>" class="btn btn-secondary">
                <i class="fa fa-lock"></i> 修改密码
            </a>
            <a href="<?php echo url_for('/user/?action=edit',['id'=>intval($_GET['id'])]);?>" class="btn btn-space btn-primary">
                <i class="fa fa-pencil"></i> 编辑
            </a>
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
    <div class="content">
        <div class="row row-deck gutters-tiny">
            <!-- Billing Address -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">账户信息</div>
                    </div>
                    <div class="ibox-body">
                        <div class="form-group row">

                            <div class="col-lg-12">
                                <a class="text-center" href="#">
                                    <div class="block-content bg-gd-dusk">
                                        <?php get_avatar($user->avatar, 64); ?>
                                        <h5 class="font-strong m-b-10 m-t-10"><i class="fa fa-user text-warning"></i> <?php echo $user->display_name;?></h5>
                                        <div class="m-b-20 text-muted"><?php $rs = $user->getUserRoleNames(); echo join(',',$rs); ?></div>
                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">Email</label>
                            <div class="col-lg-7">
                                <?php echo $user->email;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">用户名</label>
                            <div class="col-lg-7">
                                <?php echo $user->username;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">显示名称</label>
                            <div class="col-lg-7">
                                <?php echo $user->display_name;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">最后访问时间</label>
                            <div class="col-lg-7">
                                <?php echo format_date($user->lasttime,'Y-m-d H:i');?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">最后登录IP</label>
                            <div class="col-lg-7">
                                <?php echo $user->lastip;?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END Billing Address -->

            <!-- Shipping Address -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">个人信息</div>
                    </div>
                    <div class="ibox-body">
                        <?php $profile = $user->getUserProfile();?>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">姓名</label>
                            <div class="col-lg-7">
                                <?php echo $profile->last_name;?> <?php echo $profile->first_name;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">性别</label>
                            <div class="col-lg-7">
                                <?php echo $profile->sex ? '男':'女';?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">生日</label>
                            <div class="col-lg-7">
                                <?php echo $profile->birthday;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">公司</label>
                            <div class="col-lg-7">
                                <?php echo $profile->company;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">职位</label>
                            <div class="col-lg-7">
                                <?php echo $profile->jobtitle;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">公司电话</label>
                            <div class="col-lg-7">
                                <?php echo $profile->office_phone;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">私人电话</label>
                            <div class="col-lg-7">
                                <?php echo $profile->phone;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="example-hf-email">关于我</label>
                            <div class="col-lg-7">
                                <?php echo $profile->about;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Shipping Address -->
        </div>
        <!-- END Addresses -->
    </div>
</form>

<script>
    $(function () {

    });
</script>
<?php get_footer(); ?>

