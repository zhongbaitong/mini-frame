<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 14:28
 */

namespace sys;


class Router
{
    /**
     * @var object 对象实例
     */
    private static $instance = null;

    // 控制器
    public $controller;
    // 方法
    public $action;

    /**
     * 构造函数
     * @access protected
     */
    protected function __construct()
    {
        $this->controller = config("app.default_controller");
        $this->action = config("app.default_action");

        $request = $_SERVER;
        // 路由处理
        if(isset($request["PATH_INFO"])){
            $str_path = $request["PATH_INFO"];
            $arr_path = explode("/",trim($str_path,"/"));
            $this->controller = $arr_path[0] ?? "Index";
            $this->action = $arr_path[1] ?? "index";

            // 转换参数
            unset($arr_path[0],$arr_path[1]);
            for ($idx = 2; $idx < count($arr_path) + 2; $idx += 2){
                if(isset($arr_path[$idx+1])){
                    $_GET[$arr_path[$idx]] = $arr_path[$idx+1];
                }
            }
        }
    }

    /**
     * 初始化
     * @access public
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }



}