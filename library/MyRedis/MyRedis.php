<?php

namespace library\MyRedis;

/**
 * User: sunqibo
 * Date: 2018/10/22 下午3:37
 * Desc:
 */
class MyRedis
{
    protected static $redis;

    public static function init()
    {
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect(DATABASE_CONFIG['redis']['host'], DATABASE_CONFIG['redis']['port']);
        $redis->auth(DATABASE_CONFIG['redis']['password']);
        self::$redis = $redis;
        return self::$redis;
    }

}