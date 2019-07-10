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


//add_hook('app_init', 0, $callback);
//add_hook('app_start', 0, $callback);
//add_hook('page_start', function () {});
add_hook('left_sidebar_begin', function(){
    \system\admin\Page::getInstance()->menus = [
        [
            'id'=>'heading',
            'name' => 'NAVIGATION'
        ],
        [
            'id' => 'dashboard',
            'name' => '控制面板',
            'icon' => 'fa fa-dashboard',
            'url' => url_for('/dashboard/')
        ],
        [
            'id' => 'node',
            'name' => '内容管理',
            'icon' => 'fa fa-clone',
            'sub' => [
                [
                    'id' => 'node.index',
                    'name' => '文章管理',
                    'url' => url_for('/node/index.php')
                ],
                [
                    'id' => 'node.category',
                    'name' => '分类',
                    'url' => url_for('/node/category.php')
                ],
                [
                    'id' => 'node.page',
                    'name' => '单页管理',
                    'url' => url_for('/node/page.php')
                ],
            ]
        ],
        [
            'id' => 'user',
            'name' => '用户管理',
            'icon' => 'fa fa-user',
            'sub' => [
                [
                    'id' => 'user.index',
                    'name' => '用户管理',
                    'url' => url_for('/user/')
                ],
                [
                    'id' => 'user.add',
                    'name' => '添加用户',
                    'url' => url_for('/user/?action=add')
                ],
                [
                    'id' => 'user.roles',
                    'name' => '角色管理',
                    'url' => url_for('/user/roles.php')
                ]
            ]
        ],
        [
            'id' => 'appearance',
            'name' => '外观设置',
            'icon' => 'fa fa-magic',
            'sub' => [
                [
                    'id' => 'appearance.theme',
                    'name' => '外观设置',
                    'url' => url_for('/appearance/theme.php')
                ],
                [
                    'id' => 'appearance.menu',
                    'name' => '网站菜单',
                    'url' => url_for('/appearance/menu.php')
                ]
            ]
        ],
        [
            'id' => 'setting',
            'name' => '系统设置',
            'icon' => 'fa fa-cog',
            'url' => url_for('/system/setting.php')
        ]
    ];
});
add_hook('left_sidebar_begin', function(){
//    $theme = app_get('theme','default');
    if(class_exists('theme\\customize\\Theme')){
        app_set('theme_customize', new theme\customize\Theme);
    }
});
//add_hook('header', function(){});
//add_hook('left_sidebar_begin', function () {});
//add_hook('footer', 0, $callback);
add_hook('footer', function () {
    if (has_flash()) {
        echo '<script>jQuery(function(){';
        foreach (get_flash() as $type => $messages) {
            if($type=='error'){
                $type = 'danger';
            }
            $msg = array_get($messages, 0, '');
            echo <<<EOF
        jQuery.notify({
            icon: 'fa fa-check',
            message: '$msg',
            url: ''
            },
            {
                element: 'body',
                type: '{$type}',
                allow_dismiss: true,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                offset: 20,
                spacing: 10,
                z_index: 1033,
                delay: 5000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeIn',
                    exit: 'animated fadeOutDown'
                }
            });
    

EOF;
        }
        echo '});</script>';
    }


});
//add_hook('page_end', 0, $callback);
//add_hook('app_end', 0, $callback);