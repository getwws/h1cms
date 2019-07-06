<?php


namespace system\admin;

/**
 * Class Status
 * @package system\admin
 */
class Status
{
    public static function user($status, $output = true)
    {
        $result = '';
        switch ($status) {
            case 1:
                $result = '<span class="badge badge-success">启用</span>';
                break;
            default:
                $result = '<span class="badge badge-danger">未启用</span>';
                break;
        }
        if (!$output) {
            return $result;
        }
        echo $result;

    }

    public static function common($status, $output = true)
    {
        $result = '';
        switch ($status) {
            case 1:
                $result = '<span class="badge badge-success">启用</span>';
                break;
            default:
                $result = '<span class="badge badge-danger">未启用</span>';
                break;
        }
        if (!$output) {
            return $result;
        }
        echo $result;

    }

    public static function node($status, $output = true)
    {
        $result = '';
        switch ($status) {
            case 'publish':
                $result = '<span class="badge badge-success">发布</span>';
                break;
            case 'trash':
                $result = '<span class="badge badge-danger">回收站</span>';
                break;
            case 'private':
                $result = '<span class="badge badge-info">私有</span>';
                break;
            case 'pending':
                $result = '<span class="badge badge-warning">待发布</span>';
                break;
            case 'open':
                $result = '<span class="badge badge-success">启用</span>';
                break;
            case 'close':
                $result = '<span class="badge badge-warning">关闭</span>';
                break;
            default:
                $result = '<span class="badge badge-danger">未启用</span>';
                break;
        }
        if (!$output) {
            return $result;
        }
        echo $result;

    }
}