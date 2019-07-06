<?php register_assets_plugins('jquery-validation'); ?>
<?php register_assets_plugins('flatpickr'); ?>
<?php add_breadcrumb('用户管理', url_for('/user/index.php'), ''); ?>
<?php get_header(); ?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/user/'); ?>" class="btn btn-space btn-default"
               data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
            <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip"><i class="fa fa-save"></i>保存
            </button>
        </div>
        <h1><?php echo $this->title;?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb){ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'];?> <?php echo $breadcrumb['title'];?></a></li>
            <?php } ?>
        </ol>
    </div>
</div>
<form action="" method="post" class="jquery-validate-form form-horizontal">


    <input type="hidden" id="uid" name="uid" value="<?php echo $id; ?>"/>
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="ibox">
                <div class="ibox-body text-center">
                    <div class="m-t-20">
                        <?php get_avatar($user->avatar, 64); ?>
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10"><?php echo $user->display_name; ?></h5>
                    <div class="m-b-20 text-muted"><?php $rs = $user->getUserRoleNames();
                        echo join(',', $rs); ?></div>

                    <div>
                        <button class="btn btn-info btn-rounded m-b-5"><i class="fa fa-plus"></i> Follow</button>
                        <button class="btn btn-default btn-rounded m-b-5">Message</button>
                    </div>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-body">
                    <div class="form-group">
                        <label class="col-form-label" for="example-hf-email">最后访问时间</label>

                            <?php echo format_date($user->lasttime, 'Y-m-d H:i'); ?>

                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="example-hf-email">最后登录IP</label>

                            <?php echo $user->lastip; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox ibox-default panel-border-color ">
                <div class="ibox-head ">账户信息</div>
                <div class="ibox-body">
                    <div class="form-group row">

                        <div class="col-lg-12">
                            <a class="block block-rounded block-link-shadow text-center" href="#">
                                <div class="block-content bg-gd-dusk">
                                    <div class="push">
                                        <?php get_avatar($user->avatar, 64); ?>
                                    </div>
                                    <div class="pull-r-l pull-b py-10 bg-black-op-25">
                                        <div class="font-w600 mb-5 text-white">
                                            <i class="fa fa-user text-warning"></i> <?php echo $user->display_name; ?>
                                        </div>
                                        <div class="font-size-sm text-white-op"><?php $rs = $user->getUserRoleNames();
                                            echo join(',', $rs); ?></div>
                                    </div>
                                </div>

                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="user-email">Email</label>
                        <div class="col-lg-7">
                            <input type="email" class="form-control" id="user-email" name="user[email]"
                                   value="<?php echo $user->email; ?>" placeholder="请输入Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="user-username">用户名</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="user-username" name="user[username]"
                                   value="<?php echo $user->username; ?>" placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="user-displayname">昵称</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="user-displayname" name="user[display_name]"
                                   value="<?php echo $user->display_name; ?>" placeholder="请输入昵称">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="user-status">账户状态</label>
                        <div class="col-lg-7">

                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="user-status"
                                       name="user[status]"
                                       value="1" <?php echo ifOr($user->status || is_null($user), 'checked'); ?> >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">启用</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="user-status-2"
                                       name="user[status]"
                                       value="0" <?php echo ifOr($user->status === 0, 'checked'); ?> >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">禁用</span>
                            </label>
                        </div>
                    </div>


                </div>
            </div>



        </div>
        <div class="col-md-6">
            <div class="ibox ibox-default">
                <div class="ibox-head">个人信息</div>
                <div class="ibox-body">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-last-name">姓氏</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-last-name" name="profile[last_name]"
                                   value="<?php echo $profile->last_name; ?>" placeholder="姓氏">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-first-name">名字</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-first-name"
                                   name="profile[first_name]"
                                   value="<?php echo $profile->first_name; ?>" placeholder="名字">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="example-hf-email">性别</label>
                        <div class="col-lg-7">

                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="profile-sex-1"
                                       name="profile[sex]"
                                       value="1" <?php echo $profile->sex ? 'checked' : ''; ?> >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">男</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="profile-sex-2"
                                       name="profile[sex]"
                                       value="0" <?php echo $profile->sex ? '' : 'checked'; ?> >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">女</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-birthday">生日</label>
                        <div class="col-lg-7">
                            <input type="text" class="ui-datepicker form-control" id="profile-birthday"
                                   name="profile[birthday]" value="<?php echo ifOr($profile->birthday=='0000-00-00',''); ?>"
                                   placeholder="请输入生日">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-company">公司</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-company" name="profile[company]"
                                   value="<?php echo $profile->company; ?>" placeholder="请输入公司">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-jobtitle">职位</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-job_title" name="profile[job_title]"
                                   value="<?php echo $profile->job_title; ?>" placeholder="请输入职位">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-office_phone">工作电话</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-office_phone"
                                   name="profile[office_phone]" value="<?php echo $profile->office_phone; ?>"
                                   placeholder="请输入工作电话">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="example-hf-email">私人电话</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="profile-phone" name="profile[phone]"
                                   value="<?php echo $profile->phone; ?>" placeholder="请输入手机号">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="profile-about">关于我</label>
                        <div class="col-lg-7">
                            <textarea rows="3" class="form-control" id="profile-about" name="profile[about]"
                                      value="<?php echo $profile->about; ?>" placeholder="个人简介"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

<script>
    $(function () {
        $('.ui-datepicker').flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "zh"
        });
        jquery_validator({
            rules: {
                'user[email]': {
                    required: true,
                    remote: '?action=checkemail',
                    minlength: 3,
                    email: true
                },
                "user[username]": {
                    required: true,
                    remote: '?action=checkusername',
                    minlength: 3
                },
                'user[password]': {
                    required: true,
                    minlength: 6
                },
                "user[repassword]": {
                    required: true,
                    equalTo: "#user-password"
                }
            },
            messages: {
                'user[email]': {
                    required: '请输入Email',
                    minlength: '请输入合法的Email',
                    email: '请输入合法的Email',
                    remote: 'Email 已被占用'
                },
                'user[username]': {
                    required: '请输入用户名',
                    minlength: '用户名至少3个字符',
                    remote: '用户名已被占用'
                },
                'user[password]': {
                    required: '请输入密码',
                    minlength: '密码至少6位'
                },
                "user[repassword]": {
                    required: '请再次输入密码',
                    equalTo: '两次输入的密码不相同'
                }
            }
        });
    });
</script>
<?php get_footer(); ?>

