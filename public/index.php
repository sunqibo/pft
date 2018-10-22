<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// 设置时区
date_default_timezone_set('PRC');

//根目录
define('MF', substr(getcwd(), 0, -7));

// MVC目录
define('APP', MF . '/app');

// config目录
define('CONFIG', MF . '/config');

// 自动载入
require '../vendor/autoload.php';

// 异常捕获
//require '../library/Exception/Exception.php';

//数据库配置文件
require CONFIG.'/database.php';

// Eloquent ORM
$capsule = new Capsule;
$capsule->addConnection(DATABASE_CONFIG['mysql']);
$capsule->bootEloquent();

// 路由
require '../config/routes.php';