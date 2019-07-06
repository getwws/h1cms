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


namespace system;

/**
 * Class Mustache
 * @package system
 */
class Mustache
{
    protected static $engineInstance;
    public static function render($name, $data = [], $outputReturn = false){
        $mustache = static::engine();
        if($outputReturn){
            return $mustache->render($name,$data);
        }
        echo $mustache->render($name,$data);
    }

    public static function renderString($name, $data = [], $outputReturn = false){
        $mustache = static::engine()->loadTemplate($name);
        if($outputReturn){
            return $mustache->render($data);
        }
        echo $mustache->render($data);
    }

    public static function engine($singleton = true){
        if($singleton && !is_null(static::$engineInstance)){
            return static::$engineInstance;
        }
        $options = config('mustache');
        $mustache = new \Mustache_Engine($options);
        if($singleton){
            static::$engineInstance = $mustache;
        }
        return $mustache;
    }
}