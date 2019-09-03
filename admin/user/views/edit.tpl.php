<?php register_assets_plugins('jquery-validation'); ?>
<?php register_assets_plugins('flatpickr'); ?>
<?php
get_header();
add_breadcrumb('用户管理', url_for('/user/index.php'), '');
?>
<form action="" method="post" class="jq-validate jq-validate form-horizontal">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo url_for('/user/'); ?>" class="btn btn-space btn-default" title="返回"
                   data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
                <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip" title="保存"><i class="fa fa-save"></i> 保存
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
                    <div class="form-group">
                        <label class="col-form-label">最后访问时间</label>
                        <?php echo format_date($user->lasttime, 'Y-m-d H:i'); ?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">最后登录IP</label>
                        <?php echo $user->lastip; ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9 col-md-8">
            <div class="ibox ibox-default">
                <div class="ibox-body">
                    <ul class="nav nav-tabs tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" href="#account-info" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> 账户信息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="false"><i class="fa fa-cogs"></i> 设置</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#chgpasswd" data-toggle="tab" aria-expanded="false"><i class="fa fa-lock"></i> 密码修改</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-info" aria-expanded="true">
                            <div class="form-group row  required <?php echo ifOr(form_has_error('user.email'),'has-error'); ?>">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-email">Email</label>
                                <div class="col-lg-7 ">
                                    <input type="email" class="form-control" id="user-email" name="user[email]"
                                           value="<?php echo $user->email; ?>" placeholder="请输入Email">
                                    <span class="help-block" ><?php echo form_error('user.email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group row required <?php echo ifOr(form_has_error('user.username'),'has-error'); ?>">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-username">用户名</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="user-username" name="user[username]"
                                           value="<?php echo $user->username; ?>" placeholder="请输入用户名">
                                    <span class="help-block"><?php echo form_error('user.username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="user-displayname">昵称</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="user-displayname" name="user[display_name]"
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
                        <div class="tab-pane fade" id="settings" aria-expanded="false">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-last-name">姓氏</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-last-name" name="profile[last_name]"
                                           value="<?php echo $profile->last_name; ?>" placeholder="姓氏">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-first-name">名字</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-first-name"
                                           name="profile[first_name]"
                                           value="<?php echo $profile->first_name; ?>" placeholder="名字">
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
                                    <input type="text" class="ui-datepicker form-control" id="profile-birthday"
                                           name="profile[birthday]" value="<?php echo ifOr($profile->birthday=='0000-00-00',''); ?>"
                                           placeholder="请输入生日">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-company">公司</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-company" name="profile[company]"
                                           value="<?php echo $profile->company; ?>" placeholder="请输入公司">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-jobtitle">职位</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-job_title" name="profile[job_title]"
                                           value="<?php echo $profile->job_title; ?>" placeholder="请输入职位">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-office_phone">工作电话</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-office_phone"
                                           name="profile[office_phone]" value="<?php echo $profile->office_phone; ?>"
                                           placeholder="请输入工作电话">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="example-hf-email">私人电话</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="profile-phone" name="profile[phone]"
                                           value="<?php echo $profile->phone; ?>" placeholder="请输入手机号">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label rigth-label" for="profile-about">关于我</label>
                                <div class="col-lg-7">
                            <textarea rows="3" class="form-control" id="profile-about" name="profile[about]"
                                      value="<?php echo $profile->about; ?>" placeholder="个人简介"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="chgpasswd" aria-expanded="false">
                            <div class="form-group row required">
                                <label class="col-lg-3 col-form-label rigth-label" for="changepwd-password1">新密码</label>
                                <div class="col-lg-7 rigth-label">
                                    <input type="password" class="form-control" id="changepwd-password1" name="changepwd[password1]"
                                           value="" placeholder="请输入新密码">
                                    <span class="help-block" ><?php echo form_error('changepwd.password1'); ?></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <label class="col-lg-3 col-form-label rigth-label" for="changepwd-password2">再次输入新密码</label>
                                <div class="col-lg-7 ">
                                    <input type="password" class="form-control" id="changepwd-password2" name="changepwd[password2]"
                                           value="" placeholder="请再次输入新密码">
                                </div>
                            </div>
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
                "user[email]": {
                    required: true,
                    remote: '?action=checkemail&id=<?php echo $user->id;?>',
                    minlength: 3,
                    email: true
                },
                "user[username]": {
                    required: true,
                    remote: '?action=checkusername&id=<?php echo $user->id;?>',
                    minlength: 3
                },
                'changepwd[password1]': {
                    minlength: 6
                },
                "changepwd[password2]": {
                    equalTo: "#changepwd-password1"
                }
            },
            {
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
                'changepwd[password1]': {
                    minlength: '密码至少6位'
                },
                "changepwd[password2]": {
                    equalTo: '两次输入的密码不相同'
                }
            }
        );
    }
</script>
<?php get_footer(); ?>

