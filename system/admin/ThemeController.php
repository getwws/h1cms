<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>   * Date: 2018/5/7 * Time: 13:31
// +----------------------------------------------------------------------


namespace system\admin;

defined('H_ADMIN') or die('Unauthorized');

abstract class ThemeController
{

    public function dispatch($controller,$method){
        $controller = 'theme\\customize\\'.$controller;
        if(class_exists($controller)){
            $c = new $controller();
            if(method_exists($c,$method)){
                call_user_func_array([new $controller(),$method],[]);
            }else{
                $this->showMessage("$controller::$method Undefined",'error');
            }
        }else{
            $this->showMessage("$controller Undefined",'error');
        }
    }

    public function showMessage($message,$type = 'info'){
        \getw\View::render(ROOT_PATH . DS . 'system/resources/admin_theme_error.php', [
            'message'=>$message,
            'type'=>$type
        ]);
    }


    public function render($name, $data = [], $outputReturn = false)
    {
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