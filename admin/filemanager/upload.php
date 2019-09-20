<?php

use system\Image;
use system\Product;

require '../autoload.php';

function indexPOST()
{
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            $is_allow_upload = get_option('upload.status','enabled');
            if($is_allow_upload != 'enabled'){
                upload_error('系统禁止上传文件');
            }
            //自动生成或者使用源文件名
            $rand_or_orign = input('filename', 'rand');
            //原始文件名
            $orign_filename = $_FILES['file']['name'];
            //文件扩展
            $imageFileType = strtolower(pathinfo($orign_filename, PATHINFO_EXTENSION));
            //存储的文件名
            $name = ifOr($rand_or_orign == 'rand', \getw\UUID::uuid4(), $orign_filename);
            $filename = $name . '.' . $imageFileType;
            $date = date('Ymd');
            $fullName = '/' . $date . '/' . $filename;
            $upload_dir = get_option('upload.upload_dir', UPLOAD_PATH);
            if(empty($upload_dir)) {
                $upload_dir = UPLOAD_PATH;
            }
            $destination = $upload_dir . '/images/'. $date . '/'; //change this directory
            if(!is_dir($destination) ){
                mkdir($destination,0777,true);
                if(!is_dir($destination)){
                    upload_error("权限不足，无法上传 . [$destination]");
                }
            }

            $baseurl = get_option('upload.baseurl');
            if(empty($baseurl)){
                $baseurl = BASE_URL. '/storage/upload/images/';
            }
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination . $filename);
            echo rtrim($baseurl,'/') . $fullName;//change this URL
        } else {
            upload_error('Ooops!  文件上传遇到一个错误:  ' . $_FILES['file']['error']);
        }
    }
}


function product_uploadPOST()
{
    $is_allow_upload = get_option('upload.status','enabled');
    if($is_allow_upload != 'enabled'){
        upload_error('系统禁止上传文件');
    }
    if(isset($_FILES['file']['name']) && is_array($_FILES['file']['name'])){
        upload_multiple_product_image();
    }else if(is_string($_FILES['file']['name'])){
        upload_single_product_image();
    }else{
        upload_error('系统无法上传，请联系网站管理员!');
    }

}

function upload_single_product_image(){
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            //自动生成或者使用源文件名
            $rand_or_orign = input('filename', 'rand');
            //原始文件名
            $orign_filename = $_FILES['file']['name'];
            //文件扩展
            $imageFileType = strtolower(pathinfo($orign_filename, PATHINFO_EXTENSION));
            //存储的文件名
            $name = ifOr($rand_or_orign == 'rand', \getw\UUID::uuid4(), $orign_filename);
            $filename = $name . '.' . $imageFileType;
            $date = date('Ymd');
            $fullName = '/' . $date . '/' . $filename;
            $upload_dir = get_option('upload.upload_dir', UPLOAD_PATH);
            if(empty($upload_dir)) {
                $upload_dir = UPLOAD_PATH;
            }
            $destination = $upload_dir . '/images/'. $date . '/'; //change this directory
            if(!is_dir($destination) ){
                mkdir($destination,0777,true);
                if(!is_dir($destination)){
                    upload_error("权限不足，无法上传 . [$destination]");
                }
            }

            $baseurl = get_option('upload.baseurl');
            if(empty($baseurl)){
                $baseurl = BASE_URL. '/storage/upload/images/';
            }
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination . $filename);
            $thumb_path = Product::createThumb("images/{$date}/{$filename}",100,100);
            $image_list[] = [
                'image'=>rtrim($baseurl,'/') . $fullName,
                'thumb'=> $thumb_path
            ];
            echo json_encode($image_list);
        } else {
            upload_error('Ooops!  文件上传遇到一个错误:  ' . print_r($_FILES['file']['error'],true));
        }
    }
}

function upload_multiple_product_image(){
    $image_list = [];
    if (isset($_FILES['file']['name']) && is_array($_FILES['file']['name']) ) {
        $baseurl = get_option('upload.baseurl');
        if(empty($baseurl)){
            $baseurl = BASE_URL. '/storage/upload/';
        }
        $total = count($_FILES['file']['name']);
        for( $i=0 ; $i < $total ; $i++ ) {
            if (!$_FILES['file']['error'][$i]) {
                //自动生成或者使用源文件名
                $rand_or_orign = input('filename', 'rand');
                //原始文件名
                $orign_filename = $_FILES['file']['name'][$i];
                //文件扩展
                $imageFileType = strtolower(pathinfo($orign_filename, PATHINFO_EXTENSION));
                //存储的文件名
                $name = ifOr($rand_or_orign == 'rand', \getw\UUID::uuid4(), $orign_filename);
                $filename = $name . '.' . $imageFileType;
                $date = date('Ymd');
                $fullName = '/images/' . $date . '/' . $filename;
                $upload_dir = get_option('upload.upload_dir', UPLOAD_PATH);
                if(empty($upload_dir)) {
                    $upload_dir = UPLOAD_PATH;
                }
                $destination = $upload_dir . '/images/'. $date . '/'; //change this directory
                if(!is_dir($destination) ){
                    mkdir($destination,0777,true);
                    if(!is_dir($destination)){
                        upload_error("权限不足，无法上传 . [$destination]");
                    }
                }


                $location = $_FILES["file"]["tmp_name"][$i];
                move_uploaded_file($location, $destination . $filename);
                //echo rtrim($baseurl,'/') . $fullName;//change this URL
                //创建缩略图
                $thumb_path = Product::createThumb("images/{$date}/{$filename}",100,100);
                $image_list[] = [
                  'image'=>rtrim($baseurl,'/') . $fullName,
                  'thumb'=> $thumb_path
                ];
            } else {
                upload_error('Ooops!  文件上传遇到一个错误:  ' . print_r($_FILES['file']['error'][$i],true));
            }
        }
        echo json_encode($image_list);
    }
}

function upload_error($message){
    http_response_code(500);
    echo $message;
    die;
}

