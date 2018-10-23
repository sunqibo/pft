<?php

use library\MyRedis\MyRedis;

/**
 * User: sunqibo
 * Date: 2018/10/23 上午10:07
 * Desc:
 */
class RedisDemoController extends BaseController
{

    public function index()
    {
        $redis = MyRedis::init();
        //pub/sub消息发布/订阅
        echo $redis->publish('test','bbbbbb');exit;
        /**
         * Desc: sub订阅回调
         * @param $instance redis
         * @param $channelName 频道名称
         * @param $message 频道信息
         */
        $redis->subscribe(array('test'), function($instance, $channelName, $message)
        {
            echo $channelName, "==>", $message, PHP_EOL;
            die();
        });
        exit;
        //transaction事物
        $redis->watch('number'); // 用于监视一个(或多个) key ，如果在事务执行之前这个(或这些) key 被其他命令所改动，那么事务将被打断
        $redis->multi(); // 用于标记一个事务块的开始
        $redis->set('favorite_fruit', 'cherry');
        $redis->incrBy('number', 3);
        $redis->get('favorite_fruit');
        $redis->ping();
        $redis->discard(); // 取消事务, 取消后下面打印结果为null
        // 用于执行所有事务块内的命令:返回值为事务块内所有命令的返回值，按命令执行的先后顺序排列。 当操作被打断时，返回空值 null
        //array (size=4)
        //  0 => boolean true
        //  1 => int 3
        //  2 => string 'cherry' (length=6)
        //  3 => string '+PONG' (length=5)
        var_dump($redis->exec());
        $redis->unwatch(); // 用于取消 WATCH 命令对所有 key 的监视
        exit;
        //zset有序集合类型
        $redis->zAdd('zset1', 100, 'lisi');
        $redis->zAdd('zset1', 90, 'zhangsan');
        $redis->zAdd('zset1', 60, 'wangwu');
        $redis->zAdd('zset1', 'a', 'maliu'); // 字符串默认为0
        // 从低到高查询，0表示第一成员（也可以是1表示第二个成员）开始，-1表示最后一个成员（-2表示倒数第二个成员）结束，true不加返回键，加上返回键值
        $array = $redis->zRange('zset1', 0, -1, true);
        // 从高到低查询，参数同上
        $array1 = $redis->zRevRange('zset1', 0, -1, true);
        echo "<pre>";
        print_r($array1);
        exit;
        //hash散列值（hash的key必须是唯一的）
        $redis->hSet('hash1', 'name', 'lisi');
        $redis->hSet('hash1', 'age', 20);
        $redis->hSet('hash1', 'sex', 'man');
        echo $redis->hGet('hash1', 'name') . "<br>";
        $arr1 = $redis->hMGet('hash1', array('name', 'sex', 'age'));
        echo "<pre>";
        print_r($arr1);
        exit;
        //set集合类型（各不相同的元素）
        $redis->sAdd('set1', 'A');
        $redis->sAdd('set1', 'B');
        $redis->sAdd('set1', 'C');
        $redis->sAdd('set1', 'D');
        $redis->sAdd('set1', 'E');
        echo $redis->sCard('set1') . "<br>"; // 统计元素个数
        $arr = $redis->sMembers('set1'); // 以数组形式统计元素个数
        echo "<pre>";
        print_r($arr);
        exit;
        //list列表类型（实现队列,元素不唯一，先入先出原则）
        $redis->lPush('list1', 'A'); //A
        $redis->lPush('list1', 'B'); //BA
        $redis->lPush('list1', 'C'); //CBA
        $redis->lPush('list1', 'D'); //DCBA
        echo $redis->lPop('list1') . "<br>";// 先进后出 DCBA
        echo $redis->rPop('list1') . "<br>";// 先进先出 ABCD
        exit;
        $redis->rPush('list2', 'A'); //A
        $redis->rPush('list2', 'B'); //AB
        $redis->rPush('list2', 'C'); //ABC
        $redis->rPush('list2', 'D'); //ABCD
        echo $redis->rPop('list2'); // 先进后出 DCBA
        echo $redis->lPop('list2'); // 先进先出 ABCD
        exit;
        //String字符串类型，可以为整形、浮点型和字符串，统称为元素（set\get\decr\incr）
        $redis->set('str', 100);
        while ($redis->get('str') < 110) {
            $this->incrDemo($redis);
        }
    }

    /**
     * Desc: 减值
     * @param $redis
     */
    public function decrDemo($redis)
    {
        echo $redis->get('str') . "<br>";
        $redis->decr('str', 1);
        echo $redis->get('str') . "<br>";
    }

    /**
     * Desc: 增值
     * @param $redis
     */
    public function incrDemo($redis)
    {
        echo $redis->get('str') . "<br>";
        $redis->incr('str', 1);
        echo $redis->get('str') . "<br>";
    }


}