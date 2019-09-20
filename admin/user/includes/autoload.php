<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>   * Date: 2019/9/19 * Time: 16:28
// +----------------------------------------------------------------------

// ---------------- check ------------------------------------- //
use system\model\User;
use getw\FormValidator;
use getw\Validator as v;

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
