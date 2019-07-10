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


page()->setLeftMenuActive('appearance.customizer');
page()->setTitle('主题设置');
if(!class_exists('theme\customize\Theme')){
    throw new Exception("该模板不支持该功能!!!");
}
render('appearance.customizer' , [
    'current_theme' => get_option('site.theme','default')
]);
