<?php register_assets_plugins('font-awesome');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title; ?></title>
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="author" content="HMVC.CN">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_URL; ?>/css/main.css">
    <?php echo $this->printCSS('header'); ?>
    <?php echo $this->printJS('header'); ?>
    <style>

        .brand {
            font-size: 44px;
            text-align: center;
            margin: 20px 0;
        }

        .content {
            max-width: 400px;
            margin:0 auto;
        }
        .content form {
            padding: 15px 20px 20px 20px;
            background-color: #fff;
        }
        .login-header {margin:10px 0 20px 0;}
        .login-img {
            display: inline-block;
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 56px;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            border: 2px solid #6bd6db;
            font-size: 28px;
            color: #2CC4CB;
        }
        .login-header a{
            width: 50%;
            text-align: center;
            color: #fff;
            padding: 12px 0;
            background-color: #c7cccf;
        }
        .login-header a.active {
            background-color: #fff;
            color: inherit;
        }
        .login-title {
            margin-bottom: 25px;
            margin-top: 20px;
            text-align: center;
        }
        .social-auth-hr {
            text-align: center;
            height: 10px;
            margin-bottom: 21px;
            border-bottom: 1px solid #ccc;
        }
        .social-auth-hr span {
            background: #fff;
            padding: 0 10px;
        }
        .login-footer {
            padding: 15px;
            background-color: #ebedee;
            text-align: center;
        }


    </style>
</head>
<body class="bg-silver-300">
    <div class="content mt-5">
        <div class="brand">
            <img src="<?php echo ASSETS_ADMIN_URL; ?>/img/logo.png" alt="logo"  class="logo-img">
        </div>
        <form class="jquery-validate-loginform" id="login-form" action="<?php echo url_for('/system/login.php'); ?>"
                  method="post">
                    <h2 class="login-title">登录</h2>
                <div class="form-group <?php echo ifOr(form_has_error('username'), 'has-error'); ?>">
<!--                    <label for="username">用户名</label>-->
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                        <input id="username" name="username" type="text" placeholder="用户名" autocomplete="off"
                               class="form-control">
                    </div>
                    <span class="help-block"><?php echo form_error('username'); ?></span>
                </div>
                <div class="form-group <?php echo ifOr(form_has_error('password'), 'has-error'); ?>">
<!--                    <label for="password">密码</label>-->
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                        <input id="password" name="password" type="password" placeholder="密码"
                               class="form-control">
                    </div>
                    <span class="help-block"><?php echo form_error('password'); ?></span>
                </div>
                <?php
                if (has_flash('error')) {
                    ?>
                    <div class="form-group">
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <p class="mb-0"><?php foreach (get_flash('error') as $error) {
                                    echo $error, '<br/>';
                                } ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group login-submit text-right">
                    <button type="submit" class="btn btn-success">登 录 <i class="fa fa-check"></i> </button>
                </div>
            </form>

    </div>
                <p class="text-muted text-center"><small>Copyright © GETW 2018</small></p>


<script src="<?php echo ASSETS_URL; ?>/js/popper.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo ASSETS_ADMIN_URL; ?>/js/login_validate.js"></script>
</body>
</html>