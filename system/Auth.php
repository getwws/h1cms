<?php

// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>
// +----------------------------------------------------------------------

namespace system;

use Stash\Session;
use system\model\User;


class Auth
{

    const AUTH_SUPER_ADMINISTRATOR = '_admin_super_admin';
    const AUTH_ADMIN_USER_INFO = '_admin_user_info';
    const AUTH_USER_INFO = '_user_info';
    const AUTH_USER_ROLES = '_user_roles';

    /**
     *
     * @var \system\model\User
     */
    private static $user;

    /**
     *
     * @return \system\model\User
     */
    public static function user()
    {
        if (is_null(static::$user)) {
            if (defined('H_ADMIN')) {
                static::$user = session()->get(Auth::AUTH_ADMIN_USER_INFO);
            } else {
                static::$user = session()->get(Auth::AUTH_USER_INFO);
            }
        }
        return static::$user;
    }

    public static function userRoles($role_id = null)
    {
        $roles = session()->get(Auth::AUTH_USER_ROLES);
        if ($role_id != null) {
            return isset($roles[$role_id]);
        }
        return $roles;
    }

    /**
     * 判断是否登录，Admin登录传递 true
     * @param bool $isAdmin
     * @return bool
     */
    public static function isLogin($isAdmin = false)
    {
        $key = Auth::AUTH_USER_INFO;
        if (defined('H_ADMIN') && $isAdmin) {
            $key = Auth::AUTH_ADMIN_USER_INFO;
        }
        return session()->has($key);
    }

    public static function isAdministrator()
    {
        if (!defined('H_ADMIN')) {
            return false;
        }
        return session()->has(Auth::AUTH_SUPER_ADMINISTRATOR);
    }

    public static function login($user, $roles, $is_supser = false)
    {
        static::$user = $user;
        if (defined('H_ADMIN')) {
            session()->set(Auth::AUTH_ADMIN_USER_INFO, $user);
        } else {
            session()->set(Auth::AUTH_USER_INFO, $user);
        }
        session()->set(Auth::AUTH_USER_ROLES, $roles);
        if ($is_supser) {
            session()->set(Auth::AUTH_SUPER_ADMINISTRATOR, $roles);
        }
    }


    public static function logout()
    {
        if (defined('H_ADMIN')) {
            session()->remove(Auth::AUTH_ADMIN_USER_INFO);
        }
        session()->remove(Auth::AUTH_USER_INFO);
    }

    // +----------------------------------------------------------------------
    // | Auth
    // +----------------------------------------------------------------------
    public static function check($permission = null)
    {
        if (Auth::isAdministrator()) {
            return true;
        }
        if (is_null($permission)) {
            $page = trim(basename($_SERVER['SCRIPT_NAME']), '.php');
            $permission = 'admin.' . module_name() . '.' . $page;
            $action = input_get('action', 'index') . 'Action';
            if (function_exists($action . 'Action')) {
                $permission .= '.' . $action;
            }
        }
        $uid = Auth::user()->id;
        $query = 'select rp.permission from {user_roles} as ur ' .
            'left join {role_permissions} as rp on ur.role_id=rp.role_id ' .
            'where ur.uid=:uid and rp.permission=:permission';
        $params = ['uid' => $uid, 'permission' => $permission];
        $allow_perimission = db_fetchValue($query, $params);
        if ($allow_perimission == $permission) {
            return true;
        }
        return false;
    }

}
