<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>   * Date: 2019/9/18 * Time: 20:30
// +----------------------------------------------------------------------


namespace system;

use system\Image;

class Product
{
    public static function createThumb($path,$width=100,$height=100){
        $path_parts = pathinfo($path);
        $imageFileType = strtolower($path_parts['extension']);
        $filename_without_ext = $path_parts['filename'];
        $file_path = $path_parts['dirname'];
        $entry_thumb_name = "{$filename_without_ext}_{$width}x{$height}.{$imageFileType}";
        $source_file_path = UPLOAD_PATH . DS .$path;
        $dist_file_path = UPLOAD_PATH . DS . 'cache/'.$file_path.'/'.$entry_thumb_name;
        $baseurl = get_option('upload.baseurl');
        if(empty($baseurl)){
            $baseurl = BASE_URL. '/storage/upload/';
        }
        if( !is_file($dist_file_path) ){
            @mkdir(UPLOAD_PATH . DS . 'cache/'.$file_path,0777,true);
            if(filemtime($source_file_path) > @filemtime($dist_file_path)){
                Image::make($source_file_path)->thumb($width,$height)->save($dist_file_path);
            }
            $thumb_image = $baseurl.'cache/'.$file_path.'/'.$entry_thumb_name;
        }else{
            $thumb_image = $baseurl.'cache/'.$file_path.'/'.$entry_thumb_name;
        }
        return $thumb_image;
    }
}