<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>   * Date: 2018/5/7 * Time: 21:23
// +----------------------------------------------------------------------


namespace system\admin;


use getw\View;
/**
 * Class PageAside
 * @package system\admin
 */
class PageAside
{
    public $title;
    public $description;
    public $menus = [];

    public function addMenu($id,$title,$link , $active = false , $icon = 'fa fa-angle-double-right')
    {
        if(is_array($id)){
            $this->menus[$id['id']] = $id;
        }else{
            $this->menus[$id] = [
                'id'=>$id,
                'title' => $title,
                'link' => $link,
                'icon' => $icon,
                'active'=> $active
            ];
        }
    }

    public function setMenuActive($id)
    {
        $this->menus[$id]['active'] = true;
    }
    public function render($data = [] ,$callback = null)
    {
        $page_aside_template = ROOT_PATH . DS . 'system/resources/page_aside.php';

        if(is_callable($data)){
            $data = ['content_callback'=>$data];
        }else{
            $data['content_callback'] = $callback;
        }
        $data['title'] = $this->title;
        $data['description'] = $this->description;
        $data['menus'] = $this->menus;
        View::render($page_aside_template,$data);

    }
}