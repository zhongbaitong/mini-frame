<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 11:02
 */

namespace sys;

// 加载函数库
require_once SYSTEM_PATH . "function.php";

/**
 * App 应用管理
 * @author atong <991220405@qq.com>
 */
class App
{
    /**
     * 启动框架(实际上只是解析路由)
     */
    public static function run(){
        // 配置初始化
        Config::_init();

        // 获取并解析路由
        $router = Router::getInstance();
        $controller = $router->controller;
        $action = $router->action;


        // 调用: controller()->action();
        $ctl_class = "\app\controller\\" . $controller;
        print (new $ctl_class())->$action();

        return ;
    }

}