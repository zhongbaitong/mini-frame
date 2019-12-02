<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 16:03
 */

namespace app\controller;

use sys\Controller;

class Index extends Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/index/index
     *	- or -
     * 		http://example.com/
     * @see /system/library/Router.php
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://gitee.com/zhongbaitong/mini-frame.git
     *
     */
    public function index(){

        $this->assign("title","Welcome Page");

        return $this->fetch("welcome",[
            "content" => "hello world .. "
        ]);
    }

    /**
     * get the config value
     * url: http://example.com/index/test_config
     */
    public function test_config(){
        # /application/config.php
        $test = config("test");
        # /config/app.php
        $default_timezone = config("app.default_timezone");
        # refer /system/library/Config.php to CRUD config action
        $app = \sys\Config::_init()->get("app");

        return json(compact('test','default_timezone',"app"));
    }

    /**
     * get the data from mysql
     *
     * before you test this function
     * you should finish the config from '/config/database.php'
     *
     * URL: http://example.com/index.php/index/test_db
     */
    public function test_db(){

        // Db 类继承 Mysql 全部方法
        $rs1 = (new \sys\Db())->getFind("select * from test");
        // Mysql 继承 Mysqli 类全部方法
        $rs0 = \sys\Db::query("insert into test set name = 'hello world'");
        // 补充 db 操作方法到 Mysql 类即可
        $rs2 = \sys\Mysql::getInstance()->getSelect("select * from test");

        dump($rs0,$rs1,$rs2);
    }

    /**
     * test funciton
     */
    public function test_function(){
        /**
         * the dump() comes from /system/funtion.php
         * - and -
         * the test() comes from /application/common.php
         */
        dump(test());

        // apiSuccess comes from /system/library/Controller.php
        return $this->apiSuccess();
    }

}