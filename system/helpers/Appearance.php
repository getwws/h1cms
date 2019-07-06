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

namespace system\helpers;


class Appearance
{

    public static function scanThemes()
    {
        $themes = [];
        $themedirs = static::scanThemesDir();
        foreach ($themedirs as $dirName) {
            if(!is_file(THEMES_PATH . '/' . $dirName . '/info.json')){
                continue;
            }
            $info = json_decode(file_get_contents(THEMES_PATH . '/' . $dirName . '/info.json'),true);
            if($info == null || json_last_error() !== JSON_ERROR_NONE){
                continue;
            }

            if(isset($info[$dirName],$info[$dirName]['name'],$info[$dirName]['screenshot'])){
                continue;
            }
            $themes[$dirName] = $info;
        }
        return $themes;
    }

    public static function scanThemesDir()
    {
        $dirList = scandir(THEMES_PATH, 1);
        $themes = [];
        foreach ($dirList as $dirName) {
            if ($dirName == '.' || $dirName == '..') {
                continue;
            } else if(!is_dir(THEMES_PATH . '/' . $dirName)){
                continue;
            }
            $themes[] = $dirName;
        }
        return $themes;
    }

}