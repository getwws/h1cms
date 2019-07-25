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

namespace system\admin;

/**
 * Class Page
 * @package system
 */
class Page
{
    /**
     * @var Data array
     */
    private $data = [];
    //系统菜单
    public $menus = [];
    public $name;
    public $title;
    public $full_title;
    public $assets_admin = '';
    public $assets = '';


    private $nav_html = '';
    private $left_menu_active = 'dashboard';

    protected $breadcrumbs = [];

    public $phpdebugbar;

    protected static $instance;

    /**
     * @return Page
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new Page();
            static::$instance->start();
        }
        return static::$instance;
    }

    public function dump($msg, $label = 'info', $isString = true){
        $this->phpdebugbar["messages"]->addMessage($msg, $label, $isString);
    }

    public function start()
    {
        $this->assets_admin = ADMIN_BASE_URL . '/assets';
        $this->assets = BASE_URL . '/assets';
        $this->name = get_option('site.sitename');
        $this->title = get_option('site.sitename');
        $this->theme = '';
    }

    public function addBreadCrumbLink($title,$link,$icon = ''){
        $this->breadcrumbs[] = ['title'=>$title,'link'=>$link,'icon'=>$icon];
    }

    public function addBreadCrumbLinks($links){
        $this->breadcrumbs[] = $links;
    }

    public function getBreadCrumbs(){
        return $this->breadcrumbs;
    }



    public function build_nav($nav_header = false, $nav_header_icons = false, $print = true)
    {
        $this->nav_html = '';
        //缓存菜单
        $this->build_nav_array($this->menus, $nav_header, $nav_header_icons);
        if ($print) {
            echo $this->nav_html;
        } else {
            return $this->nav_html;
        }
    }


    private function build_nav_array($nav_array, $nav_header, $nav_header_icons,$submenu=false)
    {
        foreach ($nav_array as $node) {
            // Get all vital link info
            $link_id = isset($node['id']) ? $node['id'] : '';
            $link_name = isset($node['name']) ? $node['name'] : '';
            $link_icon = isset($node['icon']) && (!$nav_header || ($nav_header && $nav_header_icons)) ? '<i class="sidebar-item-icon ' . $node['icon'] . '"></i>' : '<i class="fa fa-angle-double-right"></i>';
            $link_url = isset($node['url']) ? $node['url'] : '#';
            $link_sub = isset($node['sub']) && is_array($node['sub']) ? true : false;

            $sub_active = false;

            $link_active = $link_id == $this->left_menu_active ? true : false;

            // If link type is a header and
            if ($link_id == 'heading') {
                $this->nav_html .= "<li class=\"heading\">$link_name</li>\n";
            } else {
                // 查找选中项是否在该组
                if ($link_sub) {
                    $sub_active = $this->build_nav_array_search($node['sub']) ? true : false;
                }

                //父类选中class
                $li_prop = $sub_active ? ' class="active"' : ($link_sub ? ' class="" ' : '');
                //a 选中class
                $link_prop = $link_active ? ' class="active" ' : '';

                // Add the link
                $this->nav_html .= "<li$li_prop data-id='$link_id'>\n";
                $right_icon = $link_sub ? '<i class="fa fa-angle-right arrow"></i>':'';

                if(!$submenu){
                    $link_name = "<span class=\"nav-label\">$link_name</span>";
                }
                $this->nav_html .= "<a $link_prop href=\"$link_url\">$link_icon $link_name $right_icon</a>\n";
                $is_collapse = $sub_active ? 'collapse in' : 'collapse';
                // 如果有子菜单
                if ($link_sub) {
                    $this->nav_html .= "<ul class=\"nav-2-level $is_collapse\">\n";
                    $this->build_nav_array($node['sub'], $nav_header, $nav_header_icons,true);
                    $this->nav_html .= "</ul>\n";
                }

                $this->nav_html .= "</li>\n";
            }
        }
    }


    private function build_nav_array_search($nav_array)
    {
        foreach ($nav_array as $node) {
            if (isset($node['id']) && ($node['id'] == $this->left_menu_active)) {
                return true;
            } else if (isset($node['sub']) && is_array($node['sub'])) {
                if ($this->build_nav_array_search($node['sub'])) {
                    return true;
                }
            }
        }
    }

    public function addMenu($menu)
    {
        array_push($this->menus,$menu);
    }

    public function addSubMenu($menu,$menu_id){
        $ids = array_column($this->menus, 'id');
        $found_key = array_search($menu_id, $ids);
        if($found_key && is_array($menu)){
            $this->menus[$found_key]['sub'][] = $menu;
        }
    }

    public function setLeftMenuActive($id = 'dashboard')
    {
        $this->left_menu_active = $id;
        return $this;
    }

    public function setTitle($title)
    {
        $this->full_title = $title . ' - ' . $this->title;
        $this->title = $title;
        return $this;
    }

    public function addCss($cssFile, $pos = 'header', $baseUrl = NULL)
    {
        if ($pos == 'header') {
            $pos = 'stylesheet_header';
        } else if ($pos == 'footer') {
            $pos = 'stylesheet_footer';
        }
        if (is_null($baseUrl)) {
            $baseUrl = $this->assets_admin;
        }
        $this->data[$pos][] = "<link rel=\"stylesheet\" href=\"$baseUrl/$cssFile\">\n";
    }

    public function addJs($jsFile, $pos = 'header', $baseUrl = NULL)
    {
        if ($pos == 'header') {
            $pos = 'javascript_header';
        } else if ($pos == 'footer') {
            $pos = 'javascript_footer';
        }
        if (is_null($baseUrl)) {
            $baseUrl = $this->assets_admin;
        }
        $this->data[$pos][] = "<script src=\"$baseUrl/$jsFile\"></script>\n";
    }

    public function addCssBlock($content, $pos = 'header')
    {
        if ($pos == 'header') {
            $pos = 'stylesheet_header';
        } else if ($pos == 'footer') {
            $pos = 'stylesheet_footer';
        }
        $this->data[$pos][] = "<style type=\"text/css\">" . $content . "</style>\n";
    }

    public function addJsBlock($content, $pos = 'header')
    {
        if ($pos == 'header') {
            $pos = 'javascript_header';
        } else if ($pos == 'footer') {
            $pos = 'javascript_footer';
        }
        $this->data[$pos][] = "<script>" . $content . "</script>\n";
    }

    public function printCSS($pos = 'header')
    {
        if ($pos == 'header') {
            $pos = 'stylesheet_header';
        } else if ($pos == 'footer') {
            $pos = 'stylesheet_footer';
        }
        if (is_array($this->data[$pos])) {
            foreach ($this->data[$pos] as $script) {
                echo $script;
            }
        }
    }

    public function printJS($pos = 'header')
    {
        if ($pos == 'header') {
            $pos = 'javascript_header';
        } else if ($pos == 'footer') {
            $pos = 'javascript_footer';
        }
        if (is_array($this->data[$pos])) {
            foreach ($this->data[$pos] as $script) {
                echo $script;
            }
        }

    }

    public function render($name, $data = [], $outputReturn = false)
    {
        if (!empty($data)) {
            $this->data = array_merge($this->data, $data);
        }
        do_hooks('page_start');
        $name = $this->resolvePath($name);
        if ($name == false) {
            return NULL;
        }
        $obLevel = ob_get_level();
        $error_level = error_reporting();
        if (config('config.debug', false)) {
            error_reporting(E_ALL ^ E_NOTICE);
        } else {
            error_reporting(0);
        }
        ob_start();
        extract($data, EXTR_SKIP);
        try {
            include $name;
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }
            throw $e;
        }
        error_reporting($error_level);
        do_hooks('page_end');
        if ($outputReturn) {
            return ltrim(ob_get_clean());
        }
        echo ltrim(ob_get_clean());
    }

    public function fetch($name)
    {
        if (($path = $this->resolvePath($name)) != false) {
            include $path;
        }
    }

    protected function resolvePath($name)
    {
        $filename = str_replace('.', '/', $name);
        $maybe_in_views = preg_replace('/\//', '/views/', $filename, 1);
        if (is_file(APP_PATH . DS . $filename . '.tpl.php')) {
            return APP_PATH . DS . $filename . '.tpl.php';
        } else if (is_file(APP_PATH . DS . $maybe_in_views . '.tpl.php')) {
            return APP_PATH . DS . $maybe_in_views . '.tpl.php';
        } else if (is_file(APP_PATH . DS . $filename . '.html.php')) {
            return APP_PATH . DS . $filename . '.html.php';
        } else if (is_file(APP_PATH . DS . $maybe_in_views . '.html.php')) {
            return APP_PATH . DS . $maybe_in_views . '.html.php';
        }
        return false;
    }

    public function form_errors($validate_name = 'validator')
    {
        if (isset($this->$validate_name) && $this->$validate_name instanceof \system\Validator) {
            return $this->$validate_name->errors();
        }
        return [];
    }


    public function form_error($field, $validate_name = 'validator')
    {
        if (isset($this->$validate_name) && $this->$validate_name instanceof \system\Validator) {
            return $this->$validate_name->first($field);
        }
        return NULL;
    }

    public function form_has_error($field, $validate_name = 'validator')
    {
        if (isset($this->$validate_name) && $this->$validate_name instanceof \system\Validator) {
            return $this->$validate_name->hasError($field);
        }
        return false;
    }

    /**
     *
     * @param $key
     * @return mixed
     */
    public function &__get($key)
    {
        return $this->data[$key];
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Unsets an data by key
     *
     * @param string The key to unset
     * @access public
     */
    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @access public
     * @return mixed
     * @abstracting ArrayAccess
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

}
