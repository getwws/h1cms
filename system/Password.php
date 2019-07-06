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

/**
 * Description of Password
 *
 * @author allen <allen@hmvc.cn>
 */
class Password {

    public static function make($password, $algo = PASSWORD_BCRYPT, $options = []) {
        return password_hash($password, $algo, $options);
    }

    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }

}
