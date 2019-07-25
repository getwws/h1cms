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
if (DEBUG) {
    $debugbar = new \DebugBar\StandardDebugBar();
    $debugbarRenderer = $debugbar->getJavascriptRenderer();
    $debugbarRenderer->setBaseUrl(BASE_URL . $debugbarRenderer->getBaseUrl());
    page()->phpdebugbar = $debugbar;
}


function module_name()
{
    return basename(dirname(getw\Input::server('SCRIPT_NAME')));
}

function get_header()
{
    register_assets_plugins('font-awesome');
    add_breadcrumb('首页', url_for('/dashboard/'), '<i class="fa fa-home"></i>');
    page()->fetch('system/views/header');
}

function get_footer()
{
    page()->fetch('system/views/footer');
}

function system_abort($data){
    if(!is_array($data)){
        $data = ['message'=>$data];
    }
    render('system.abort', $data);
}

function get_avatar($avatar = 'default.jpg', $size = 16, $thumb = false, $class = '')
{
    $class_f = '';
    $width = '';
    if ($size == 16) {
        $class_f = ' profile-img';
        $width = ' width="16px" ';
    } else if ($size == 32) {
        $class_f = ' profile-img';
        $width = ' width="32px" ';
    } else if ($size == 45) {
        $class_f = ' profile-img';
        $width = ' width="45px" ';
    } else if ($size == 96) {
        $class_f = ' profile-img';
        $width = ' width="96px" ';
    } else if ($size == 128) {
        $class_f = ' profile-img';
        $width = ' width="128px" ';
    }

    if ($thumb) {
        $class_f .= ' img-avatar-thumb';
    }

    if ($class) {
        $class_f .= ' ' . $class;
    }
    $path = page()->assets_admin . '/img/avatars/' . $avatar;
    if (!file_exists($path)) {
        $path = page()->assets_admin . '/img/avatars/default.jpg';
    }
    echo '<img class="img-circle ' . $class_f . '" '.$width.' src="' . $path . '" alt="">' . "\n";
}

function add_js($file, $pos = 'footer', $baseUrl = NULL)
{
    page()->addJs($file, $pos, $baseUrl);
}

function add_css($file, $pos = 'header', $baseUrl = NULL)
{
    page()->addCss($file, $pos, $baseUrl);
}

function add_breadcrumb($title,$link = '',$icon = ''){
    if(is_array($title)){
        page()->addBreadCrumbLinks($title);
    }else{
        page()->addBreadCrumbLink($title,$link,$icon);
    }
}

function register_assets_plugins($name , $callback = null)
{
    if($callback instanceof \Closure){
        $callback();
    }
    switch ($name) {
        case 'bootstrap':
            add_css('vendor/bs3/css/bootstrap.min.css', 'header', ASSETS_URL);
            add_js('vendor/bs3/js/bootstrap.min.js', 'footer', ASSETS_URL);
            break;
        case 'flatpickr':
            add_css('vendor/flatpickr/flatpickr.min.css', 'header', ASSETS_URL);
            add_js('vendor/flatpickr/flatpickr.min.js', 'footer', ASSETS_URL);
            break;
        case 'jquery-validation':

            add_js('vendor/jquery-validation/jquery.validate.js', 'footer', ASSETS_URL);
            add_js('js/jqvalidate.methods.js', 'footer', ASSETS_ADMIN_URL);
            break;
        case 'summernote':
            add_css('vendor/summernote/summernote-bs4.css', 'header', ASSETS_URL);
            add_js('vendor/summernote/summernote-bs4.js', 'footer', ASSETS_URL);
            break;
        case 'font-awesome':
            add_css('vendor/font-awesome/css/font-awesome.min.css', 'header', ASSETS_URL);
            break;
        case 'themify-icons':
            add_css('vendor/themify-icons/css/themify-icons.css', 'header', ASSETS_URL);
            break;
    }
}


//Module autoload
if (file_exists(APP_PATH . '/' . module_name() . '/includes/autoload.php')) {
    include APP_PATH . '/' . module_name() . '/includes/autoload.php';
}
