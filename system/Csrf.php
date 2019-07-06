<?php

// +----------------------------------------------------------------------
// | HMVC
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.hmvc.cn All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@hmvc.cn>
// +----------------------------------------------------------------------

namespace system;

use getw\Session;

/**
 * Csrf
 *
 * @author allen<allen@hmvc.cn>
 */
class Csrf {

    public static function token() {
        $max_time = 60 * 60 * 24; // token is valid for 1 day
        $csrf_token = Session::get('csrf_token');
        $stored_time = Session::get('csrf_token_time');

        if ($max_time + $stored_time <= time() || empty($csrf_token)) {
            session()->set('csrf_token', md5(uniqid(rand(), true)));
            session()->set('csrf_token_time', time());
        }

        return session()->get('csrf_token');
    }

    public static function isValid() {
        return $_POST['csrf_token'] === session()->get('csrf_token');
    }

    public static function formToken(){
        $token = static::token();
        echo '<input type="hidden" name="token" value="'.$token.'" />';
    }

}
