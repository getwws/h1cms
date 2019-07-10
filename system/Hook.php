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

namespace system;

class Hook {

    protected $callbacks = [];
    protected $actions = ['count' => 0];
    protected static $current = false;
    private static $_instance;

    public static function getInstance() {
        if (isset(static::$_instance)) {
            return static::$_instance;
        }
        return static::$_instance = new static;
    }

    public static function addAction($name, $callback, $args = [], $priority = 8) {
        $that = static::getInstance();
        $that->callbacks[$name][$priority][] = [
            'function' => $callback,
            'arguments' => $args
        ];

        return true;
    }

    public static function addActions($actions) {
        foreach ($actions as $arguments) {
            call_user_func_array([__CLASS__, 'addAction'], $arguments);
        }
        return true;
    }

    public static function doAction($name, $args = [], $remove = true) {
        $that = self::getInstance();
        self::$current = $name;
        $that->actions['count'] ++;
        if (!array_key_exists($name, $that->actions)) {
            $that->actions[$name] = 0;
        }
        $that->actions[$name] ++;
        $actions = $that->_getActions($name, $remove);
        asort($actions);
        foreach ($actions as $priority) {
            foreach ($priority as $action) {
                $action = $that->_runAction($action, $args);
            }
        }
        self::$current = false;
        return (isset($action)) ? $action : false;
    }

    public static function current() {
        return self::$current;
    }

    private function _runAction($action, $args) {
        $callbacktion = $action['function'];
        $defaultArgs = $action['arguments'];
        if (is_array($callbacktion)) {
            $class = (isset($callbacktion[0])) ? $callbacktion[0] : false;
            $method = (isset($callbacktion[1])) ? $callbacktion[1] : false;
        }
        if (!is_array($args)) {
            $args = [$args];
        }
        if (!is_array($defaultArgs)) {
            $defaultArgs = [$defaultArgs];
        }       
        $args = array_merge($defaultArgs, $args);
        if (is_string($callbacktion) && function_exists($callbacktion)) {
            return call_user_func($callbacktion, $args);
        } else if ($callbacktion instanceof \Closure) {
            return call_user_func($callbacktion, $args);
        } else if (isset($class) && class_exists($class)) {
            $instance = new $class;
            return call_user_func_array([$instance, $method], $args);
        }
    }

    private function _getActions($name, $remove) {
        if (isset($this->callbacks[$name])) {
            $actions = $this->callbacks[$name];
            if ($remove) {
                unset($this->callbacks[$name]);
            }
        }
        return (isset($actions)) ? $actions : [];
    }

}
