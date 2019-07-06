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
define('H_ADMIN_LOGIN', true);

require '../autoload.php';

use getw\Session;

function indexGet()
{
    page()->setLeftMenuActive('setting');
    $option_names = ['system', 'site', 'mail', 'image', 'upload'];
    $rs = db_prepare_array($option_names);
    $paramNames = join(',', array_keys($rs));
    $options = db_fetchPairs("select CONCAT(option_group,'.',option_name) as option_name,option_value 
                              from {options} where option_group IN ($paramNames)", $rs);
    page()->setTitle('系统设置');
    render('system.setting', ['options' => $options]);
}

function indexPost()
{
    $group_names = ['system', 'site', 'mail', 'image', 'upload'];
    $rs = db_prepare_array($group_names);
    $paramNames = join(',', array_keys($rs));
    $all_options = db_fetchPairs("select CONCAT(option_group,'.',option_name) as option_name,option_value 
                              from {options} where option_group IN ($paramNames)", $rs);
    foreach ($group_names as $option_group_name) {
        //获取当前组，所有属性名和属性值
        $group_options = input_post($option_group_name, []);
        if (is_scalar($group_options)) {
            continue;
        }
        foreach ($group_options as $key => $value) {

            if (isset($all_options["{$option_group_name}.{$key}"])) {
                db_update('options', ['option_value' => $value], ['option_group' => $option_group_name, 'option_name' => $key]);
            } else {
                db_insert('options', ['option_value' => $value, 'option_group' => $option_group_name, 'option_name' => $key]);
            }
        }

    }
    add_flash('保存成功', Session::SUCCESS);
    redirect_to('/system/setting.php');
}
