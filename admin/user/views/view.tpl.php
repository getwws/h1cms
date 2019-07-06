<?php get_header(); ?>
<div class="be-content">
    <div class="main-content container-fluid">
<form action="" method="post">
    <div class="content">
        <!-- Customer -->
        <h2 class="content-heading">
            <a href="<?php echo url_for('/user/?action=changepassword',['id'=>intval($_GET['id'])]);?>" class="btn btn-sm btn-secondary float-right">
                <i class="fa fa-lock text-info mr-5"></i>修改密码
            </a>
            <a href="<?php echo url_for('/user/?action=edit',['id'=>intval($_GET['id'])]);?>" class="btn btn-sm btn-secondary float-right">
                <i class="fa fa-pencil text-info mr-5"></i>编辑
            </a>

            用户信息
        </h2>
        <div class="row row-deck gutters-tiny">
            <!-- Billing Address -->
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">账户信息</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">

                            <div class="col-lg-12">
                                <a class="block block-rounded block-link-shadow text-center" href="#">
                                    <div class="block-content bg-gd-dusk">
                                        <div class="push">
                                            <?php get_avatar($user->avatar, 64); ?>
                                        </div>
                                        <div class="pull-r-l pull-b py-10 bg-black-op-25">
                                            <div class="font-w600 mb-5 text-white">
                                                <i class="fa fa-user text-warning"></i> <?php echo $user->display_name;?>
                                            </div>
                                            <div class="font-size-sm text-white-op"><?php $rs = $user->getUserRoleNames(); echo join(',',$rs); ?></div>
                                        </div>
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
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">个人信息</h3>
                    </div>
                    <div class="block-content">
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
    </div>
</div>
<script>
    $(function () {

    });
</script>
<?php get_footer(); ?>

