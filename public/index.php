<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// 设置时区
date_default_timezone_set('PRC');

//根目录
define('MF', substr(getcwd(), 0, -7));

// MVC目录
define('APP', MF . '/app');

// 自动载入
require '../vendor/autoload.php';

// 异常捕获
require '../library/Exception/Exception.php';

// Eloquent ORM
$capsule = new Capsule;
$capsule->addConnection(require '../config/database.php');
$capsule->bootEloquent();

// 路由
require '../config/routes.php';