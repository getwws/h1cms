<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>   * Date: 2018/5/7 * Time: 16:05
// +----------------------------------------------------------------------


namespace theme\customize;


use system\admin\ThemeController;

class Index extends ThemeController
{
    public $pageasiede;

    public function __construct()
    {
        $this->pageasiede  = new \system\admin\PageAside();
        $this->pageasiede->title = '主题设置';
        //$pageasiede->description = '主题设置';
        $this->pageasiede->addMenu('setting','常规设置','?action=setting');
        $this->pageasiede->addMenu('nav','导航','?action=nav');
    }
    public function index()
    {
        $this->setting();
    }

    public function setting()
    {
        $this->pageasiede->setMenuActive('setting');
        $this->pageasiede->render(function(){
            $this->render('customize.views.setting');
        });
    }

    public function nav()
    {
        $this->pageasiede->setMenuActive('nav');
        $this->pageasiede->render(function(){
            $this->render('customize.views.nav');
        });
    }
}