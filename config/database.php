<?php
/**
 * User: sunqibo
 * Date: 2018/10/16 下午4:07
 * Desc:
 */
$database_config = array(
    'mysql' => array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'my_framework',
        'username' => 'root',
        'password' => '111111',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => ''
    ),
    'redis' => array(
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'password' => '111111',
        'port' => 6379,
        'database' => 0
    )
);
define('DATABASE_CONFIG', $database_config);
?>