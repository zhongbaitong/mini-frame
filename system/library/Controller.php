<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 16:13
 */

namespace sys;

class Controller
{
    public $assign = [];

    /**
     * view::参数传递
     * @param $key
     * @param $value
     */
    public function assign($key,$value){
        $this->assign[$key] = $value;
    }

    /**
     * view::页面渲染
     * @param $file
     * @param array $assign
     * @param bool $is_make
     * @return null
     */
    public function fetch($file = "",$assign = [],$is_make = true){

        $route = Router::getInstance();
        // 目录
        $view_dir = APP_PATH . "view" . DS . $route->controller . DS;

        // 默认路径
        $view_path = ! $file
            ? $view_dir . $route->action . ".php"
            : $view_dir . $file . ".php";

        // 创建 view 文件
        if(!is_file($view_path) && $is_make){
            $path_info = pathinfo($view_path);

            !is_dir($path_info["dirname"]) && mkdir(iconv("UTF-8", "GBK", $path_info["dirname"])
                , 0777, true);

            file_put_contents($view_path, $view_path);
        }

        // 视图参数
        isset($assign) && $this->assign = array_merge($this->assign,$assign);
        extract($this->assign);

        is_file($view_path) ? require ($view_path) : exit($view_path . "文件不存在");

        return null;
    }

    /**
     * API::统一的返回结果
     * @param array $params
     * @return false|string|\think\response\Json
     */
    public function apiReturn($params = [])
    {
        if(is_array($params) && isset($params['code'],$params['msg'])){
            $result = $params;
        } else if( $params !== '' ) {
            $result = ['code' => 1, 'msg' => '操作成功!','data'=>$params];
        } else {
            $result = ['code' => 0, 'msg' => '操作失败!'];
        }
        return json($result);
    }

    /**
     * API::成功时返回
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return false|string|\think\response\Json
     */
    public function apiSuccess($msg = '操作成功!', $data = [],$code = 1)
    {
        $result = compact('code','msg');
        $data && $result['data'] = $data;

        return $this->apiReturn($result);
    }

    /**
     * API::失败时返回
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return false|string|\think\response\Json
     */
    public function apiError($msg = "操作失败！",$data = [], $code = 0){
        $result = compact('code','msg');
        $data && $result['data'] = $data;

        return $this->apiReturn($result);
    }


}