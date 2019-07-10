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

use getw\Arr;
use getw\Cache;
use getw\DB;

/**
 * Class Option
 * @package system
 */
class Option
{

    /**
     *
     * @var array Options Item
     */
    private static $data = array();

    /**
     *
     * @param type $name
     */
    public static function load($name)
    {
        if (array_key_exists($name, static::$data)) {
            return;
        }
        $item = Cache::store()->getItem('system/option/' . $name);
        if ($item->isHit()) {
            static::$data[$name] = $item->get();
            return;
        }

        static::$data[$name] = db_fetchPairs("select option_name,option_value from {options} where option_group=:option_group", ['option_group' => $name]);
        if (is_array(static::$data[$name])) {
            $item->set(static::$data[$name]);
            $item->expiresAfter(3600);
            $item->save();
        }
    }

    /**
     *
     * @return array
     */
    public static function all()
    {
        return static::$data;
    }

    /**
     *
     * @param string $name
     * @param array|string $default
     * @return array|string
     */
    public static function get($name, $default = NULL)
    {
        $names = explode('.', $name);
        if (isset($names[0]) && !Arr::has(static::$data, $names[0])) {
            static::load($names[0]);
        }
        return Arr::get(static::$data, $name, $default);
    }

    /**
     *
     * @param string $option
     * @param mixed $value
     */
    public static function set($option, $value = false)
    {
        $segment = explode('.', $option);
        $group_name = current($segment);
        $option_name = end($segment);
        try {
            db_insert('options', ['option_group' => $group_name, 'option_value' => $value, 'option_name' => $option_name]);
        } catch (\PDOException $ex) {
            db_update('options', ['option_value' => $value], ['option_group' => $group_name, 'option_name' => $option_name]);
        }
    }

    /**
     *
     * @param string $name
     * @return array|string
     */
    public static function has($name)
    {
        return Arr::has(static::$data, $name);
    }

    public static function remove($option)
    {
        $segment = explode('.', $option);
        $group_name = current($segment);
        $option_name = end($segment);
        $where = ['option_group' => $group_name];
        if (!empty($option_name)) {
            $where['option_name'] = $option_name;
        }
        db_delete('options', $where);
    }

    public static function clear($group_name = null)
    {
        if ($group_name == null) {
            Cache::store()->deleteItem('system/option');
        }
        if (is_string($group_name)) {
            $group_name = [$group_name];
        }
        foreach ($group_name as $name) {
            Cache::store()->deleteItem('system/option/' . $name);
        }
    }

}
