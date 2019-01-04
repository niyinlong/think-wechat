<?php

// [ 应用入口文件 ]

// 设置ajax访问请求可跨域
header('Access-Control-Allow-Origin:*');//允许所有来源访问
header('Access-Control-Allow-Method:POST,GET');//允许访问的方式
// 设置编码格式问题
header("Content-type: text/html; charset=utf-8"); 

// 配置当前路径
define('SCRIPT_DIR', rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/\\')); 

// 定义扩展目录&插件目录
define('EXTEND_PATH', __DIR__ . '/extend/');
define('VENDOR_PATH', __DIR__ . '/vendor/');
define('RUNTIME_PATH', __DIR__ . '/runtime/');

// 定义应用目录
define('APP_PATH', __DIR__ . '/app/');
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';

?>