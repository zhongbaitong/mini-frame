<?php
/**
 * Created by PhpStorm.
 * User: zhongbaitong
 * Date: 2019/11/28
 * Time: 10:01
 */

# 版本
define('SYSTEM_VERSION', '1.0.0');
# 分隔符 /
define('DS', DIRECTORY_SEPARATOR);
# 系统路径 /system/
define('SYSTEM_PATH', __DIR__ . DS);
# 根目录
define('ROOT_PATH', dirname(__DIR__) . DS);
// 应用目录路径
define('APP_PATH', ROOT_PATH . DS . 'application' . DS);
// 扩展目录路径 /vendor
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);

// 载入composer 自动加载类
require VENDOR_PATH . 'autoLoad.php';
