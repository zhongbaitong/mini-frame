<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 12:09
 */

namespace sys;


class Config
{
    /**
     * @var object 对象实例
     */
    private static $instance = null;

    protected $config = [];

    /**
     * 构造函数
     * @access protected
     */
    protected function __construct()
    {
        // 加载配置
        $this->config = self::loadConfig();

        $this->execute();
    }

    /**
     * 初始化
     * @access public
     */
    public static function _init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 加载配置文件（PHP格式）
     * @access protected
     * @return mixed
     */
    protected static function loadConfig(){
        # application/config.php
        $config = __require_file(APP_PATH . "config.php");

        # config/*.php
        $bc_dir = ROOT_PATH . "config" . DS;
        $bc_files = scandir($bc_dir);
        foreach ($bc_files as $value) {
            $file_path = $bc_dir . DS . $value;
            if (is_file($file_path)) {
                $file_info = pathinfo($value);
                $file_name = $file_info["filename"];
                $config[$file_name] = __require_file($file_path);
            }
        }

        return $config;
    }

    /**
     * 获取配置值
     * @access public
     * @return mixed
     */
    public function get($key){
        if(true === $key){
            return $this->config;
        }

        if (strpos($key, ".")) {
            $arr_key = explode(".", $key);
            $value = $this->config[$arr_key[0]][$arr_key[1]] ?? exit($key . "配置不存在");
        } else {
            $value = $this->config[$key] ?? exit($key . "配置不存在");
        }

        return $value;
    }

    /**
     * 执行配置
     */
    public function execute(){

        // 调试模式
        ini_set("display_errors"
            , $this->get("app.app_debug") ? "On": "Off");

        // 时区
        ini_set('date.timezone'
            , $this->get("app.default_timezone"));

        // ..
    }

}
