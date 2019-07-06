<?php
define('H_ADMIN_LOGIN', true);

require '../autoload.php';

function doGet()
{
    \system\Auth::logout();
    add_flash('您已安全退出', \getw\Session::ERROR);
    redirect_to('/system/login.php');
}