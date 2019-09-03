<?php
require '../autoload.php';

function indexPOST()
{
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            $is_allow_upload = get_option('upload.status','enabled');
            if($is_allow_upload != 'enabled'){
                http_response_code(500);
                echo '系统禁止上传文件';
                die;
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
                    echo "权限不足，无法上传 . [$destination]" ;
                    die;
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
            http_response_code(500);
            echo 'Ooops!  文件上传遇到一个错误:  ' . $_FILES['file']['error'];
            die;
        }
    }
}