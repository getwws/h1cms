<?php

use system\Image;

require '../autoload.php';
$MAX_UPLOAD_SIZE = min(asBytes(ini_get('post_max_size')), asBytes(ini_get('upload_max_filesize')));

function indexAction(){
    $page = input('page',1);
    $thumb = input('thumb','');
    $target = input('target','');
    $selected = input('selected','fm_selected');
    $modal = input('modal','');
    $path = input('path','/');
    $path = trim($path,"\\\/\.");
    if(!empty($path)){$path.='/';}
    $upload_path = UPLOAD_PATH . DS . $path;
    $baseurl = get_option('upload.baseurl');
    if(empty($baseurl)){
        $baseurl = BASE_URL. '/storage/upload/';
    }

    if($upload_path && is_dir($upload_path)){
        $files = scandir($upload_path ,1) ;
    }else{
        $files = [];
    }
    $dir_files = [];
    if ($files) {
        $images = array_splice($files, ($page - 1) * 16, 16 - count($files));
        foreach ($images as $entry){
            if($entry=='.' || $entry=='..'){
                continue;
            }
            if(is_dir($upload_path.$entry)){
                $dir_files[] = [
                    'name' => $entry,
                    'path' => $path.$entry,
                    'url'=> $baseurl . $entry,
                    'type' => 'dir',
                    'href' => ''
                ];
            }else if(is_file($upload_path.$entry)){
                $entry_path_info = pathinfo($entry);
                $ext = $entry_path_info['extension'];
                $is_image = in_array($ext,['jpg','jpeg','png','gif']);
                $thumb_image = '';
                $entry_thumb_name = "{$entry_path_info['filename']}_100x100.{$ext}";
                $source_file_path = UPLOAD_PATH . DS .$path . $entry;
                $dist_file_path = UPLOAD_PATH . DS . 'cache/'.$path.$entry_thumb_name;
                if($is_image && !starts_with($path,'cache/') ){
                    @mkdir(UPLOAD_PATH . DS . 'cache/'.$path,0777,true);
                    if(filemtime($source_file_path) > @filemtime($dist_file_path)){
                        Image::make($source_file_path)->thumb(100,100)->save($dist_file_path);
                    }
                    $thumb_image = $baseurl.'cache/'.$path.$entry_thumb_name;
                }else if($is_image && starts_with($path,'cache/')){
                    $thumb_image = $baseurl.$path.$entry;
                }
                $dir_files[] = [
                    'name' => $entry,
                    'path' => $path . $entry,
                    'url'=> $baseurl . $entry,
                    'type' => 'file',
                    'href' => '',
                    'thumb' => $thumb_image,
                    'ext' => $ext,
                    'is_image' => $is_image
                ];
            }
        }

    }

    render('filemanager.dialog',[
        'dir_files'=>$dir_files,
        'modal'=>$modal,
        'parent_path'=>dirname($path),
        'path'=>$path,
        'thumb'=>$thumb,
        'target'=>$target,
        'selected'=>$selected
    ]);
}

function createDirAction(){
    $folder = input('folder');
    $folder = filter_var($folder, FILTER_SANITIZE_ENCODED);
    $path = input('path','/');
    $path = trim($path,"\\\/\.");
    if(!empty($path)){$path.='/';}
    $upload_path = UPLOAD_PATH . DS . $path;
    @mkdir($upload_path.$folder,0777,true);
    echo json_encode(['code'=>0,'message'=>'Success']);
}

function deleteAction(){
    $path = input('path','/');
    $fm_path = input_post('fm_path',[]);
    $path = trim($path,"\\\/\.");
    if(!empty($path)){$path.='/';}
    $upload_path = UPLOAD_PATH . DS . $path;
    if(empty($fm_path)){
        echo json_encode(['code'=>1,'message'=>'请选中需要删除的文件']);
        return;
    }
    foreach ($fm_path as $entry) {
        deleteDir($upload_path.$entry);
    }
    echo json_encode(['code'=>0,'message'=>'文件已删除']);
}


function deleteDir($dir) {
    if(is_dir($dir)) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file") && !is_link($dir)) ? deleteDir("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }else{
        unlink($dir);
    }
}


function rmrf($dir) {
    if(is_dir($dir)) {
        $files = array_diff(scandir($dir), ['.','..']);
        foreach ($files as $file)
            rmrf("$dir/$file");
        rmdir($dir);
    } else {
        unlink($dir);
    }
}
function is_recursively_deleteable($d) {
    $stack = [$d];
    while($dir = array_pop($stack)) {
        if(!is_readable($dir) || !is_writable($dir))
            return false;
        $files = array_diff(scandir($dir), ['.','..']);
        foreach($files as $file) if(is_dir($file)) {
            $stack[] = "$dir/$file";
        }
    }
    return true;
}

function asBytes($ini_v) {
    $ini_v = trim($ini_v);
    $s = ['g'=> 1<<30, 'm' => 1<<20, 'k' => 1<<10];
    return intval($ini_v) * ($s[strtolower(substr($ini_v,-1))] ?: 1);
}

?>

