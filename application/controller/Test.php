<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/29
 * Time: 16:42
 */

namespace app\controller;


use sys\Controller;

class Test extends Controller
{
    public function index(){

        $this->assign("aaa","this sis aaa");
        return $this->fetch();
    }
}