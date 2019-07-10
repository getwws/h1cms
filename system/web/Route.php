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

namespace system\web;
use Whoops\Example\Exception;

/**
 * Class Route
 * @package system\web
 */
class Route
{
    public static function get($route, $handler)
    {
        app()->routeCollector->addRoute('GET', $route, $handler);
    }

    public static function post($route, $handler)
    {
        app()->routeCollector->addRoute('POST', $route, $handler);
    }

    public static function delete($route, $handler)
    {
        app()->routeCollector->addRoute('DELETE', $route, $handler);
    }

    public static function put($route, $handler)
    {
        app()->routeCollector->addRoute('PUT', $route, $handler);
    }

    public static function any($route, $handler)
    {
        app()->routeCollector->addRoute(['POST','GET','DELETE','PUT'], $route, $handler);
    }


    public static function resources()
    {
        throw new Exception('The function is not implemented');
    }
}