<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 14:37
 */

if (!function_exists('input')) {
    /**
     * 接收参数 TODO::filter
     * @param $param
     * @param bool $is_must
     * @return mixed
     */
    function input($param, $is_must = false)
    {
        if(strpos($param,',')){
            $data = [];
            $array =  explode(",", $param);
            foreach ($array as $val){
                $data[$val] = $_REQUEST[$val] ??
                    (!$is_must ? NULL : exit($val . "参数必须.."));
            }
        }
        else{
            $data = $_REQUEST[$param] ??
                (!$is_must ? NULL : exit($param . "参数必须.."));
        }
        return $data;
    }
}

if (!function_exists('dump')) {
    /**
     * 格式化输出
     * @param $var
     * @param mixed ...$extra
     */
    function dump(...$extra)
    {
        echo "<pre>";
        if (count($extra) == 1) {
            var_dump($extra[0]);
        } else {
            var_dump($extra);
        }
        echo "</pre>";
    }
}

if (!function_exists('json')) {
    /**
     * 获取Json对象实例
     * @param mixed   $data 返回的数据
     * @param array $extra 额外参数
     * @return false|string
     */
    function json($data, $extra = [])
    {
        header($extra['header']
            ?? 'Content-Type:application/json; charset=utf-8');

        return json_encode($data, $extra['type']
            ?? JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('config')) {
    /**
     * 获取配置值
     * @param $key
     * @return mixed
     */
    function config($key){
        return sys\Config::_init()->get($key);
    }
}

if (!function_exists('__require_file')) {
    /**
     * require
     * @param  string $file 文件路径
     * @return mixed
     */
    function __require_file($file, $is_die = false)
    {
        if (is_file($file)) {
            return require $file;
        }

        return true === $is_die ? die($file . "文件不存在!") : false;
    }
}

__require_file(APP_PATH . "common.php");

