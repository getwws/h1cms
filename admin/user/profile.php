<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>   * Date: 2019/9/19 * Time: 14:45
// +----------------------------------------------------------------------

require '../autoload.php';

// ---------------- 修改用户 ------------------------------------- //
use getw\Session;
use system\Auth;
use system\model\User;


function indexAction()
{
    $data = [];
    $id = Auth::user()->id; //获取用户ID
    if(isMethod('POST')){
        $user = input_post('user');
        $profile = input_post('profile');
        $changepwd = input_post('changepwd');

        $v = validateEdit($id);
        if ($v === true) {
            if(!empty($changepwd['password1'])){
                $user['password'] = \system\Password::make($changepwd['password1']);
            }
            db_update('users', $user, ['id' => $id]);
            db_update('users_profile', $profile, ['uid' => $id]);
            add_flash('修改成功', Session::SUCCESS);
            redirect(url_for('/user/?action=view', ['id' => $id]));
        }else{
            $data['validator'] = $v;
        }

    }
    page()->setTitle('用户管理');
    page()->setLeftMenuActive('user.index');
    $user = User::findByUid($id);
    $profile = $user->getUserProfile();
    $data['user'] = $user;
    $data['profile'] = $profile;
    $data['id'] = $id;
    render('user.edit', $data);
}