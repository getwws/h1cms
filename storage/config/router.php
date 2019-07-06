<?php

use system\web\Route;

Route::get('/',function(){
    render('index');

});




Route::get('/users', \app\controllers\UserController::class);
