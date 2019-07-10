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

define('H_DEFAULT_LANGUAGE', 1);
//PDO FETCH
define('FETCH_OBJ', PDO::FETCH_OBJ);
define('FETCH_ASSOC', PDO::FETCH_ASSOC);
define('FETCH_BOTH', PDO::FETCH_BOTH);
define('FETCH_NUM', PDO::FETCH_NUM);


define('SESSION_INFO', 'info');
define('SESSION_SUCCESS', 'success');
define('SESSION_WARNING', 'warning');
define('SESSION_ERROR', 'error');


function base_url($url = null)
{
    $documentRoot = getw\Input::server('DOCUMENT_ROOT', '');
    $rootDirName = basename($documentRoot);
    $appDirName = basename(APP_PATH);
    if ($rootDirName == $appDirName) {
        return '';
    } else {
        return str_replace($documentRoot, '', str_replace('\\', '/', APP_PATH)) . $url;
    }
}

function url_for($url, $params = [], $baseUrl = false)
{
    $query_string = '';
    if (!empty($params) && is_array($params)) {
        $query_string = (strripos($url, '?') === false) ? '?' : '&';
        $query_string .= http_build_query($params);
    } else if (is_scalar($params)) {
        $query_string = $params;
    }
    if (defined('BASE_URL') && $baseUrl) {
        return BASE_URL . $url . $query_string;
    }
    return base_url($url . $query_string);
}

//Hooks
function add_hook($name, $callback = null, $args = [], $priority = 1)
{
    \system\Hook::addAction($name, $callback, $args, $priority);
}

function do_hooks($name, $args = [])
{
    \system\Hook::doAction($name, $args);
}

function get_option($option, $default = null)
{
    return \system\Option::get($option, $default);
}

/**
 * 更新属性组 (如果不存在则创建)
 * @param string $option
 * @param mixed $value
 */
function update_option($option, $value = false)
{
    \system\Option::set($option, $value);
}

/**
 * 删除Option
 * @param string $option 属性组|属性组.属性名
 */
function remove_option($option)
{
    \system\Option::remove($option);
}

/**
 *
 * @return \system\admin\Page
 */
function page()
{
    return \system\admin\Page::getInstance();
}


function render($name, $data = [], $outputReturn = false)
{
    if (defined('H_ADMIN')) {
        return \system\admin\Page::getInstance()->render($name, $data, $outputReturn);
    } else {
        $filename = str_replace('.', '/', $name);
        $maybe_in_views = preg_replace('/\//', '/views/', $filename, 1);
        if (is_file(THEME_PATH . DS . $filename . '.tpl.php')) {
            \getw\View::render(THEME_PATH . DS . $filename . '.tpl.php', $data, $outputReturn);
        } else if (is_file(THEME_PATH . DS . $maybe_in_views . '.tpl.php')) {
            \getw\View::render(THEME_PATH . DS . $maybe_in_views . '.tpl.php', $data, $outputReturn);
        } else if (is_file(THEME_PATH . DS . $filename . '.html.php')) {
            \getw\View::render(THEME_PATH . DS . $filename . '.html.php', $data, $outputReturn);
        } else if (is_file(THEME_PATH . DS . $maybe_in_views . '.html.php')) {
            \getw\View::render(THEME_PATH . DS . $maybe_in_views . '.html.php', $data, $outputReturn);
        } else if (is_file(THEME_PATH . DS . $filename . '.mustache')) {
            \system\Mustache::render($filename, $data, $outputReturn);
        }
    }
}

function form_error($field, $validate_name = 'validator')
{
    if (isset(page()->$validate_name) && page()->$validate_name instanceof \system\Validator) {
        return page()->$validate_name->first($field);
    }
    return NULL;
}

function form_errors($validate_name = 'validator')
{
    if (isset(page()->$validate_name) && page()->$validate_name instanceof \system\Validator) {
        return page()->$validate_name->errors();
    }
    return [];
}

function form_has_error($field, $validate_name = 'validator')
{
    if (isset(page()->$validate_name) && page()->$validate_name instanceof \system\Validator) {
        return page()->$validate_name->hasError($field);
    }
    return false;
}

function ifRedirect($condition, $url = NULL, $message = NULL, $msg_type = \getw\Session::SUCCESS)
{
    if (!empty($condition)) {
        if (!is_null($message)) {
            add_flash($message, $msg_type);
        }
        return redirect($url);
    }
}

function ifOrRedirect($condition, $one = NULL, $two = NULL, $message = NULL, $msg_type = \getw\Session::SUCCESS)
{
    if (!is_null($message)) {
        add_flash($message, $msg_type);
    }
    if (!empty($condition)) {
        return redirect($one);
    } else {
        return redirect($two);
    }
}

function array_get_format($format, $data, $key, $default = null)
{
    $args = [];
    if (is_string($key)) {
        $val = \getw\Arr::get($data, $key, null);
        if (!is_null($val)) {
            $args[] = $val;
        }
    } else if (is_array($key)) {
        foreach ($key as $k) {
            $val = \getw\Arr::get($data, $k, null);
            if (!is_null($val)) {
                $args[] = $val;
            }
        }
    }
    if (empty($args)) {
        return $default;
    }
    return vsprintf($format, $args);
}

function redirect_to($url, $status = 302, $headers = array())
{
    redirect(url_for($url), $status, $headers);
}


function h_log($message, $level = 'system', $uid = 0)
{
    db_insert('logs', [
        'level' => $level,
        'message' => $message,
        'uid' => $uid,
        'location' => $_SERVER['REQUEST_URI']
    ]);
}

function json_response($data, $code = 200)
{
    header("Content-Type: application/json; charset=UTF-8");
    if (is_object($data)) {
        $data = (array)$data;
    }
    $data['code'] = $code;
    $data['type'] = isset($data['type']) ? $data['type'] : 'success';
    echo json_encode($data);
    die;
}


/**
 * @return \system\web\App
 */
function app()
{
    return \system\web\App::instance();
}

function app_set($key , $value){
    \getw\Container::getInstance()->set($key,$value);
}

function app_get($key , $default = null){
    return \getw\Container::getInstance()->get($key,$default);
}
