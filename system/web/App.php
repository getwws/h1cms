<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>   * Date: 2018/5/5 * Time: 15:42
// +----------------------------------------------------------------------


namespace system\web;



use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use getw\Input;

class App
{
    /**
     * @var \Composer\Autoload\ClassLoader
     */
    public static $loader;

    private static $_app;

    /**
     * @var Std
     */
    protected $routeParser;

    /**
     * @var GroupCountBased
     */
    protected $dataGenerator;

    /**
     * @var \FastRoute\Dispatcher\GroupCountBased
     */
    public $dispatcher;

    /**
     * @var RouteCollector
     */
    public $routeCollector;

    /**
     * @return App
     */
    public static function instance()
    {
        if (is_null(static::$_app)) {
            static::$_app = new App();
            static::$_app->routeParser = new Std();
            static::$_app->dataGenerator = new GroupCountBased();
            static::$_app->routeCollector = new RouteCollector(static::$_app->routeParser, static::$_app->dataGenerator);
        }
        return static::$_app;
    }


    public static function startup()
    {
        $app = App::instance();
        if(is_file(CONFIG_PATH . '/router.php')){
            require CONFIG_PATH . '/router.php';
        }

        return $app;
    }

    public static function run()
    {
        $app = App::instance();
        if(is_file(CONFIG_PATH . '/router.php')){
            require CONFIG_PATH . '/router.php';
        }
        $app->dispatcher();
        return $app;
    }

    public function dispatcher()
    {
        $this->dispatcher = new \FastRoute\Dispatcher\GroupCountBased($this->routeCollector->getData());
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routeInfo = $this->dispatcher->dispatch(Input::method(), str_replace(base_url(), '', $uri));
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                render('404');
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                render('405');
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                if(is_callable($handler)){
                    call_user_func_array($handler,$vars);
                }else if(class_exists($handler)){
                    call_user_func_array([new $handler,\getw\Input::method()],$vars);
                }else{
                    $class = explode('@',$handler);
                    if(is_array($class) && count($class) == 2 && class_exists($class[0])){
                        call_user_func_array([new $class[0],$class[1]],$vars);
                    }
                }
                break;
        }
    }
}
