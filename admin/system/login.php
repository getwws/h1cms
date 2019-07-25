<?php

// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>
// +----------------------------------------------------------------------
define('H_ADMIN_LOGIN', true);

require '../autoload.php';

use getw\Session;
use getw\FormValidator as v;
use getw\Validator as vv;
use system\model\User;

function doGet()
{
    page()->title = 'H1CMS - 系统登录';
    render('system.login');
}

function doPost()
{
    $v = v::make($_POST);
    $v->rule(v::RULE_REQUIRED, ['username', 'password']);
    $v->labels(['username' => '用户名', 'password' => '密码']);
    if (!$v->validate()) {
        render('system.login', ['validator' => $v]);
        exit;
    }
    if (vv::email()->validate(input_post('username'))) {
        $user = User::findByEmail(input_post('username'));
    } else {
        $user = User::findByUsername(input_post('username'));
    }
    if (!$user || \system\Password::verify(input_post('password'), $user->password) == false) {
        add_flash('用户名或密码错误', Session::ERROR);
        redirect(url_for('/system/login.php'));
    }
    db_update('users', ['lasttime' => time(), 'lastip' => \getw\Input::realIpAddress()], ['id' => $user->id]);
    $roles = db_fetchCol('select role_id from {users_roles} where uid=:uid', ['uid' => $user->id]);
    \system\Auth::login($user, $roles, in_array(1, $roles));
    //登录成功
    add_flash('登录成功', Session::SUCCESS);
    redirect(url_for('/dashboard/'));
}
