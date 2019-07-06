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

$autoloader = require 'vendor/autoload.php';

use getw\Config;

define('ROOT_PATH', __DIR__);
define('APP_PATH', __DIR__);
define('STORAGE_PATH', ROOT_PATH . DS . 'storage');
define('THEMES_PATH', ROOT_PATH . DS . 'themes');
define('CONFIG_PATH', STORAGE_PATH . DS . 'config');
define('UPLOAD_PATH', STORAGE_PATH . DS . 'upload');
define('BASE_URL', base_url());
define('DEBUG', Config::get('config.debug', 'false'));
date_default_timezone_set(Config::get('config.timezone', 'PRC'));

$theme = get_option('site.theme');
define('THEME_URL', base_url('/themes/'.$theme));
define('THEME_PATH', ROOT_PATH . DS . 'themes' . DS . $theme);
\system\web\App::$loader = $autoloader;
$autoloader->addPsr4('theme\\', THEME_PATH);
