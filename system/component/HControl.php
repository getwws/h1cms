<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>   * Date: 2019/7/11 * Time: 16:54
// +----------------------------------------------------------------------


namespace system\component;


use getw\Singleton;
use system\model\Role;

/**
 * Class HControl
 * @package system\component
 *
 * @method static HControl instance()
 */
class HControl
{
    use Singleton;


    public function SELECT_Roles($without_select = true,$control_name = ''){
        $roles = Role::getAll();
        if(!$without_select){
            echo '<select class="form-control input-sm" id="',$control_name,'" name="',$control_name,'">';
        }
        foreach ($roles as $role) {
            echo "<option value=\"{$role->id}\">{$role->title}</option>";
        }
        if(!$without_select){
            echo '</select>';
        }
    }

}