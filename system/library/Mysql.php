<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/29
 * Time: 10:55
 */

namespace sys;

/**
 * 加载 Db 类实现调用此类
 * Class Mysql
 * @package sys
 */
class Mysql extends \mysqli
{
    protected static $_instance = null;

    /**
     * Db constructor.
     * @param string $host
     * @param string $username
     * @param string $passwd
     * @param string $dbname
     * @param int $port
     * @param string $socket
     */
    public function __construct(string $host, string $username, string $passwd, string $dbname, int $port, string $socket)
    {
        @parent::__construct($host, $username, $passwd, $dbname, $port, $socket);

        if($this->connect_errno){
            exit("mysql连接错误[{$this->connect_errno}]：{$this->connect_error}");
        }
        $this->set_charset(config("database.charset"));
    }

    /**
     * 数据库初始化，并取得数据库类实例
     * @access public
     * @param  array $options 连接配置
     * @param bool $is_force 连接标识 true 强制重新连接
     * @return Mysql
     */
    public static function getInstance($options = [])
    {
        if (self::$_instance == null) {
            $db_config = config("database");
            self::$_instance = new self(
                $options["host"] ?? $db_config["host"]
                ,$options["username"] ?? $db_config["username"]
                ,$options["password"] ?? $db_config["password"]
                ,$options["database"] ?? $db_config["database"]
                ,$options["hostport"] ?? $db_config["hostport"]
                , $options["socket"] ?? $db_config["socket"]
            );
        }
        return self::$_instance;
    }


    //
    public function getFind($sql)
    {
        $result = $this->query($sql); //mysqli_result对象
        if (!is_object($result)) {
            exit($sql . "语句错误 [{$this->errno}]：{$this->error}");
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    }

    //
    public function getSelect($sql)
    {
        //mysqli_result对象
        $result = $this->query($sql);
        if (!is_object($result)) {
            exit($sql . "语句错误 [{$this->errno}]：{$this->error}");
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}