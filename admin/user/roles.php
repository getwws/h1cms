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
use system\model\Role;
use system\component\Paginator;

function indexGet()
{
    page()->setTitle('角色管理');
    page()->setLeftMenuActive('user.roles');


    $query = Role::select();

    $pagehelper = Paginator::make(input_get('page', 1), 20, $_GET);
    $pagehelper->setTotal(Role::count($query));

    $query->limit($pagehelper->getLimit(),$pagehelper->getOffset());
    $users = Role::getAll($query);
    render('user.roles', ['roles' => $users, 'pagehelper' => $pagehelper]);
}

// ---------------- add  --------------------------------- //
function addGet()
{
    page()->setTitle('角色管理');
    page()->setLeftMenuActive('user.roles');

    render('user.roles_form', ['roles' => \system\model\Role::getAll()]);
}

function addPost()
{
    $role = input_post('role');

    $title = array_get($role, 'title');
    if (empty($title)) {
        add_flash('角色标题必须填写', Session::ERROR);
        redirect(url_for('/user/roles.php?action=add'));
    }
    $role_id = db_insert('roles', $role);
    if (!$role_id) { //添加失败
        add_flash('角色添加失败', Session::ERROR);
        redirect(url_for('/user/roles.php?action=add'));
    }
    add_flash('角色添加成功', Session::SUCCESS);
    redirect(url_for('/user/roles.php'));

}

// ---------------- 修改用户 ------------------------------------- //
function editGet()
{
    page()->setTitle('用户管理');
    page()->setLeftMenuActive('user.roles');
    $id = intval(input_get('id'));

    render('user.roles_form', ['role' => Role::findById($id), 'id' => $id]);
}

function editPost()
{
    $role = input_post('role');
    $id = intval(input_get('id'));
    $title = array_get($role, 'title');
    if (empty($title)) {
        add_flash('角色标题必须填写', Session::ERROR);
        redirect(url_for('/user/roles.php?action=edit&id=' . $id));
    }
    db_update('roles', $role, ['id' => $id]);
    add_flash('角色修改成功', Session::SUCCESS);
    redirect(url_for('/user/roles.php'));
}

function deleteAction()
{
    $id = intval(input_post('id'));
    if ($id == 1) {
        json_response(['type' => 'error', 'message' => '没有权限删除该角色']);
    }
    if (\getw\Input::isAjax() && $id) {
        db_delete('roles', ['id' => $id]);
        json_response(['type' => 'success', 'message' => '角色已删除']);
    }

}
