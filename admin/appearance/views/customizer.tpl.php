<?php get_header(); ?>

<?php $theme = app_get('theme_customize');
$method = input('action','index');
if(empty($method)){
    $method = 'index';
}
if(method_exists($theme,$method)){
    call_user_func_array([$theme,$method],[]);
} else if(method_exists($theme,'dispatch')){
    $controller = input('controller','Index');
    call_user_func_array([$theme,'dispatch'],['controller'=>$controller,'method'=>$method]);
} else {
    app_get('theme_customize')->showMessage('模板不支持此功能!','info');
}
?>

<?php get_footer(); ?>

