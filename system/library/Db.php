<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/29
 * Time: 10:01
 */

namespace sys;

class Db
{

    /**
     * 继承 mysqli 类
     * @access public
     * @param  string $method 方法名
     * @param  array $params 参数
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([Mysql::getInstance(), $method], $params);
    }

    /**
     * 静态调用 mysqli 方法
     * @access public
     * @param  string $method 方法名
     * @param  array $params 参数
     * @return mixed
     */
    public static function __callStatic($method, $params)
    {
        return call_user_func_array([Mysql::getInstance(), $method], $params);
    }

}