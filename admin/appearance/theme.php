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

function indexGet()
{
    page()->setLeftMenuActive('appearance.theme');
    page()->setTitle('外观设置');
    render('appearance.theme' , [
        'themes' => \system\helpers\Appearance::scanThemes(),
        'current_theme' => get_option('site.theme','default')
    ]);
}

function settingAction(){
    $theme = input_get('active','default');
    update_option('site.theme',$theme);
    \getw\Cache::store()->deleteItem('system/option/site');
    add_flash("主题设置成功", SESSION_SUCCESS);
    redirect_to('/appearance/theme.php');
}
