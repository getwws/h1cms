<?php
ini_set('display_errors','On');
use system\web\Route;

Route::get('/',function(){
    render('index');
});
Route::get('/users', \app\controllers\UserController::class);

Route::get('/{pagename:[0-9a-zA-Z-_.]+}',function($pagename){
    echo $pagename;
});




