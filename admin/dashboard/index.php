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

require '../autoload.php';

function indexGet()
{
    page()->setTitle('控制面板');
    page()->setLeftMenuActive('dashboard');
    $db_info = db()->info();
    page()->render('dashboard.dashboard', ['db_info' => $db_info]);
}
