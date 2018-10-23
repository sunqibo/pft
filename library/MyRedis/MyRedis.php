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
        $redis = new \Redis();
        $redis->connect(DATABASE_CONFIG['redis']['host'], DATABASE_CONFIG['redis']['port']);
        $redis->auth(DATABASE_CONFIG['redis']['password']);
        $redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);
        self::$redis = $redis;
        return self::$redis;
    }

    /**
     * Desc: 不会主动关闭的链接
     * @return \Redis
     */
    public static function pinit(){
        $redis = new \Redis();
        $redis->pconnect(DATABASE_CONFIG['redis']['host'], DATABASE_CONFIG['redis']['port']);
        $redis->auth(DATABASE_CONFIG['redis']['password']);
        self::$redis = $redis;
        return self::$redis;
    }

    /**
     * @param $key
     * @param $value
     * @param int $timeout
     * @param string $unit
     * @return mixed
     */
    public static function set($key, $value, $timeout = 0, $unit = 's')
    {
        self::init();
        $result = self::$redis->set($key, $value);
        if ($timeout > 0) {
            switch ($unit) {
                case 's':   //秒
                    self::$redis->expire($key, $timeout);
                    break;
                case 'unix':    //unix时间戳(单位：秒)
                    self::$redis->expireAt($key, $timeout);
                    break;
                case 'ms':  //毫秒
                    self::$redis->pExpire($key, $timeout);
                    break;
                case 'munix':   //unix时间戳(单位：毫秒)
                    self::$redis->pExpireAt($key, $timeout);
                    break;
                default:
                    break;
            }

        }
        return $result;
    }

    /**
     * @param $key
     * @return string
     */
    public static function get($key)
    {
        self::init();
        return self::$redis->get($key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function delete($key)
    {
        self::init();
        return self::$redis->del($key);
    }

    /**
     * Desc: sub订阅回调
     * @param $instance redis
     * @param $channelName 频道名称
     * @param $message 频道信息
     */
    public static function callback($instance, $channelName, $message)
    {
        echo $channelName, "==>", $message, PHP_EOL;
        exit;
    }

}