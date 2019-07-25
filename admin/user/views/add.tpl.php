<?php
register_assets_plugins('jquery-validation');
register_assets_plugins('flatpickr');
?>
<?php get_header();
add_breadcrumb('用户信息', url_for('/user/index.php'), '');
?>
<form action="" method="post" class="jq-validate form-horizontal">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/user/'); ?>" class="btn btn-space btn-default" data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
            <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip"><i class="fa fa-save"></i> 保存</button>
        </div>
        <h1><?php echo $this->title;?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb){ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'];?> <?php echo $breadcrumb['title'];?></a></li>
            <?php } ?>
        </ol>
    </div>
</div>


  <div class="ibox ibox-default">
                <div class="ibox-body">
                    <ul class="nav nav-tabs tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-1" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog"></i> 账户设置</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-2" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> 个人信息</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-1" aria-expanded="true">

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-roles">角色</label>
                                <div class="col-lg-7">
                                    <select class="form-control input-sm" id="user-roles" name="role_id">
                                        <?php
                                        \system\component\HControl::instance()->SELECT_Roles();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-email">Email</label>
                                <div class="col-lg-7">
                                    <input type="email" class="form-control input-sm required" id="user-email"
                                           name="user[email]"
                                           value="<?php echo $user->email; ?>" placeholder="请输入Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-username">用户名</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm required" id="user-username"
                                           name="user[username]" value="<?php echo $user->username; ?>"
                                           placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-password">密码</label>
                                <div class="col-lg-7">
                                    <input type="password" class="form-control input-sm" id="user-password" name="user[password]"
                                           value="<?php echo $user->password; ?>" placeholder="请输入密码">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-repassword">再次输入密码</label>
                                <div class="col-lg-7">
                                    <input type="password" class="form-control input-sm" id="user-repassword"
                                           name="user[repassword]"
                                           value="<?php echo $user->repassword; ?>" placeholder="请再次输入密码">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-displayname">昵称</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="user-displayname"
                                           name="user[display_name]"
                                           value="<?php echo $user->display_name; ?>" placeholder="请输入昵称">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-status">账户状态</label>
                                <div class="col-lg-7  pt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="user-status" name="user[status]" class="custom-control-input" value="1"
                                            <?php echo ifOr($user->status || is_null($user), 'checked'); ?> />
                                        <label class="custom-control-label" for="user-status">启用</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="user-status-2" name="user[status]" class="custom-control-input" value="0"
                                            <?php echo ifOr($user->status === 0, 'checked'); ?> />
                                        <label class="custom-control-label" for="user-status-2">禁用</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-2" aria-expanded="false">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-last-name">姓氏</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-last-name"
                                           name="profile[last_name]"
                                           value="<?php echo $profile->last_name; ?>" placeholder="姓氏">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-first-name">名字</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-first-name"
                                           name="profile[first_name]" value="<?php echo $profile->first_name; ?>"
                                           placeholder="名字">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-sex-1">性别</label>
                                <div class="col-lg-7 pt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="profile-sex-1" name="profile[sex]" class="custom-control-input" value="1"
                                            <?php echo $profile->sex ? 'checked' : ''; ?> />
                                        <label class="custom-control-label" for="profile-sex-1">男</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="profile-sex-2" name="profile[sex]" class="custom-control-input" value="0"
                                            <?php echo $profile->sex ? '' : 'checked'; ?> />
                                        <label class="custom-control-label" for="profile-sex-2">女</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-birthday">生日</label>
                                <div class="col-lg-7">
                                    <input type="text" class="ui-datepicker form-control input-sm" id="profile-birthday"
                                           name="profile[birthday]"
                                           value="<?php echo $profile->birthday; ?>" placeholder="请输入生日">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-company">公司</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-company"
                                           name="profile[company]"
                                           value="<?php echo $profile->company; ?>" placeholder="请输入公司">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-jobtitle">职位</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-job_title"
                                           name="profile[job_title]"
                                           value="<?php echo $profile->job_title; ?>" placeholder="请输入职位">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-office_phone">工作电话</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-office_phone"
                                           name="profile[office_phone]" value="<?php echo $profile->office_phone; ?>"
                                           placeholder="请输入工作电话">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="example-hf-email">私人电话</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control input-sm" id="profile-phone" name="profile[phone]"
                                           value="<?php echo $profile->phone; ?>" placeholder="请输入手机号">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-about">关于我</label>
                                <div class="col-lg-7">
                                <textarea rows="3" class="form-control input-sm" id="profile-about"
                                          name="profile[about]"
                                          value="<?php echo $profile->about; ?>" placeholder="个人简介"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

</form>

<script>
    function page_end() {
        $('.ui-datepicker').flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "zh"
        });

        jquery_validator({
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
        }, {
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
        });


    }

</script>
<?php get_footer(); ?>

