<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>   * Date: 2018/5/5 * Time: 23:43
// +----------------------------------------------------------------------


namespace theme\customize;

use system\admin\ThemeController;

class Theme extends ThemeController {

   public function __construct()
   {
        $this->add_left_menu();
   }

   private function add_left_menu(){
//       page()->addMenu(['id'=>'heading','name' => '扩展']);
       page()->addSubMenu([
           'id' => 'appearance.customizer',
           'name' => '主题设置',
           'url' => url_for('/appearance/customizer.php')
       ],'appearance');

   }
}