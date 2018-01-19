<?php


/*
 * This file is part of PHP CS Fixer.
 * (c) kcloze <pei.greet@qq.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

// 定义项目路径
define('APP_PATH', __DIR__ . '/../application/');
define('SWOOLE_JOBS_ROOT_PATH', __DIR__.'/..');
define('RUNTIME_PATH', __DIR__ . '/../runtime/');

//ini_set('default_socket_timeout', -1);
date_default_timezone_set('Asia/Shanghai');
require SWOOLE_JOBS_ROOT_PATH . '/thinkphp/base.php';
require SWOOLE_JOBS_ROOT_PATH . '/vendor/autoload.php';

// 执行应用
\think\App::initCommon();
\think\Console::init(false);

$JobObject      = new \Kcloze\Jobs\JobObject('MyJob', 'test', '', [], []);
\think\Console::call($JobObject->jobClass,$JobObject->jobParams);
var_dump('done');