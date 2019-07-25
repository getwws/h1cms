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

require '../autoload.php';

use getw\Session;
use system\model\User;
use getw\FormValidator;
use getw\Validator as v;

function indexGet()
{
    page()->setTitle('用户管理');
    page()->setLeftMenuActive('user.index');

    $st = input_get('st', 'username');
    $s = $username = input_get('s', '');

    $query = User::select();
    if ($st == 'username' && $s) {
        $query->where('username=:username',['username' => $s]);
    } else if ($st == 'uid' && $s) {
        $query->where('id=:uid',['uid' => $s]);
    } else if ($st == 'email' && $s) {
        $query->where('email=:email',['email' => $s]);
    }
    $pagehelper = \system\component\Paginator::make(input_get('page', 1), 20, $_GET);
    $pagehelper->setTotal(User::count($query));

    $query->limit($pagehelper->getLimit(),$pagehelper->getOffset());
    $users = User::getAll($query);
    render('user.index', ['users' => $users, 'pagehelper' => $pagehelper]);
}

// ---------------- View ------------------------------------- //
function viewGet()
{
    page()->setTitle('用户管理');
    page()->setLeftMenuActive('user.index');
    $id = intval(input_get('id'));
    $user = User::findByUid($id);
    $profile = $user->getUserProfile();
    render('user.view', ['user' => $user, 'profile' => $profile]);
}

// ---------------- add User --------------------------------- //
function addGet()
{
    page()->setTitle('用户管理');
    page()->setLeftMenuActive('user.add');

    render('user.add');
}

function addPost()
{
    $user = input_post('user');
    $user_profile = input_post('profile');
    $display_name = array_get($user, 'display_name');
    if (empty($display_name)) {
        $user['display_name'] = array_get($user, 'username');
    }
    //password
    if (isset($user['password']) && $user['password'] == $user['repassword']) {
        $user['password'] = \system\Password::make($user['password']);
        unset($user['repassword']);
    }
    $uid = db_insert('users', $user);
    if (!$uid) { //添加失败
        add_flash('用户添加失败', Session::ERROR);
        redirect(url_for('/user/?action=add'));
    }
    $user_profile['uid'] = $uid;
    db_insert('users_profile', $user_profile);
    //添加角色
    $role_id = intval(input_post('role_id', 1));
    db_insert('users_roles', ['uid' => $uid, 'role_id' => $role_id]);
    add_flash('用户添加成功', Session::SUCCESS);
    redirect(url_for('/user/?action=view', ['id' => $uid]));

}

// ---------------- 修改用户 ------------------------------------- //
function editAction()
{
    $data = [];
    if(isMethod('POST')){
        $user = input_post('user');
        $profile = input_post('profile');
        $changepwd = input_post('changepwd');
        $id = intval(input_post('uid'));

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
    $id = intval(input_get('id'));
    $user = User::findByUid($id);
    $profile = $user->getUserProfile();
    $data['user'] = $user;
    $data['profile'] = $profile;
    $data['id'] = $id;
    render('user.edit', $data);
}


function deleteAction()
{
    $uid = intval(input_post('id'));
    if ($uid == 1) {
        json_response(['type' => 'error', 'message' => '没有权限删除该用户']);
    } else if (\system\Auth::user()->id == $uid) {
        json_response(['type' => 'error', 'message' => '没有权限删除该用户']);
    }
    if (\getw\Input::isAjax() && $uid) {
        User::instance()->remove($uid);
        json_response(['type' => 'success', 'message' => '用户已删除']);
    }

}

// ---------------- check ------------------------------------- //
function checkusernameAction()
{
    $user = input_get('user');
    $uid = intval(input_get('id',0));
    $username = array_get($user, 'username');
    if (empty($username)) {
        echo 'false';
    }
    $u = User::findByUsername($username);
    if($uid >=1 && User::findByUid($uid)->username == $username ){
        echo 'true';
    } else if ($u === false) {
        echo 'true';
    } else {
        echo 'false';
    }
}

function checkemailAction()
{
    $user = input_get('user');
    $uid = intval(input_get('id',0));
    $email = array_get($user, 'email');
    $u = User::findByEmail($email);
    if($uid >=1 && User::findByUid($uid)->email == $email ){
        echo 'true';
    } else if ($u === false) {
        echo 'true';
    } else {
        echo 'false';
    }
}

function checkUserNameExists($username){
    $u = User::findByUsername($username);
    if ($u === false) {
        return false;
    } else {
        return true;
    }
}
function checkEmailExists($email){
    $u = User::findByEmail($email);
    if ($u === false) {
        return false;
    } else {
        return true;
    }
}

function validateEdit($id){
    $orgin_user = User::findByUid($id);
    $changepwd = input_post('changepwd');
    FormValidator::addRule('checkemail',function($field, $value) use ($orgin_user) {
        if($orgin_user->email != $value && checkEmailExists($value)){
            return false;
        }return true;
    },'已存在');
    FormValidator::addRule('checkusername',function($field, $value) use ($orgin_user) {
        if($orgin_user->username != $value && checkUserNameExists($value)){
            return false;
        }return true;
    },'已存在');

    $v = FormValidator::make($_POST);
    $v->rule(FormValidator::RULE_REQUIRED, ['user.email', 'user.username']);
    $v->rule(FormValidator::RULE_LENGTH_BETWEEN,'user.username',3,30);
    $v->rule(FormValidator::RULE_EMAIL,'user.email');
    $v->rule('checkemail','user.email');
    $v->rule('checkusername','user.username');
    $v->labels(['user.email' => '用户名', 'user.username' => '密码']);
    if(isset($changepwd['password1']) && isset($changepwd['password2']) && $changepwd['password1']!=$changepwd['password2']){
        $v->error('changepwd.password1','两次输入的密码不相同');
    }
    if($v->validate()){
        return true;
    }
    return $v;
}



