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

$autoloader = require __DIR__ . '/../vendor/autoload.php';
require 'system/includes/hooks.php';

use getw\Config;

do_hooks('app_init');
define('H_ADMIN', true);
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', __DIR__);
define('STORAGE_PATH', ROOT_PATH . DS . 'storage');
define('THEMES_PATH', ROOT_PATH . DS . 'themes');
define('CONFIG_PATH', STORAGE_PATH . DS . 'config');
define('UPLOAD_PATH', STORAGE_PATH . DS . 'upload');
define('ADMIN_BASE_URL', base_url());
define('BASE_URL', dirname(ADMIN_BASE_URL));
define('ASSETS_URL', BASE_URL . '/assets');
define('ASSETS_ADMIN_URL', ADMIN_BASE_URL . '/assets');
define('THTMES_URL', BASE_URL . '/themes');
//SYSTEM
define('DEBUG', Config::get('config.debug', 'false'));
date_default_timezone_set(Config::get('config.timezone', 'PRC'));



$theme = get_option('site.theme');
define('THEME_URL', BASE_URL . '/themes/'.$theme);
define('THEME_PATH', ROOT_PATH . DS . 'themes' . DS . $theme);
app_set('loader',$autoloader);
app_set('theme',$theme);
$autoloader->addPsr4('theme\\', THEME_PATH);

// 多语言实现
//$langs = get_browser_language();
//load_language('admin',$langs);

require 'system/includes/common.php';
if (!defined('H_ADMIN_LOGIN')) {
    //登录检查
    if (!\system\Auth::isLogin(true)) {
        //add_flash("登录已过期，请重新登录", \getw\Session::ERROR);
        redirect_to('/system/login.php');
    }
    //权限检查
//    if (!\system\Auth::check()) {
//        redirect_to('/auth/access_denied.php');
//    }
}

do_hooks('app_start');
bootstrap();
do_hooks('app_end');
