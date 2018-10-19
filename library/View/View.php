<?php
namespace library\View;

/**
 * User: sunqibo
 * Date: 2018/10/18 上午10:32
 * Desc:
 */
class View
{
    static $telPath = array();

    public function __construct()
    {

    }

    /**
     * Desc: 获取模板路径
     * @param $path
     */
    public static function getTelPaths($filename)
    {
        if (strrchr($filename, '.')) {
            $filename = str_replace('.', '/', $filename);
//            self::$telPath['file_name'] = '/'.substr(strrchr($filename, '/'), 1) . '.html';
//            self::$telPath['file_name'] = '/' . $filename . '.html';
//            self::$telPath['twig_path'] = APP . '/views/' . substr($filename, 0, -strlen(strrchr($filename, '/')));
        }
        self::$telPath['file_name'] = '/'.$filename . '.html';
        self::$telPath['file_path'] = APP . '/views/' . $filename . '.html';
        self::$telPath['twig_path'] = APP . '/views';
//        echo "<pre>";
//        print_r(self::$telPath);
//        exit;
        return self::$telPath;
    }
}