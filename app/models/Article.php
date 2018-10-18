<?php
/**
 * Article Model
 */
class Article extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
//    public static function first()
//    {
//        $dbms = 'mysql';     //数据库类型
//        $host = 'localhost'; //数据库主机名
//        $dbName = 'my_framework';    //使用的数据库
//        $user = 'root';      //数据库连接用户名
//        $pass = '111111';          //对应的密码
//        $dsn = "$dbms:host=$host;dbname=$dbName";
//        $db = new PDO($dsn, $user, $pass);
//        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $result = $db->query("SELECT * FROM articles limit 0,1");
//
//        if ($row = $result->fetch()) {
//            return $row;
//        }
//        $db = null;
//
//
//    }
}
