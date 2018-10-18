<?php
/**
 * 屏蔽错误提示
 * 自动捕捉错误和异常
 */
error_reporting(0);
register_shutdown_function("fatal_handler");
set_error_handler("error_handler");

define('E_FATAL', E_ERROR | E_USER_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR | E_PARSE);

//获取 fatal error
function fatal_handler()
{
    $error = error_get_last();
    if ($error && ($error["type"] === ($error["type"] & E_FATAL))) {
        $errno = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr = $error["message"];
        error_handler($errno, $errstr, $errfile, $errline);
    }
}

//获取所有的 error
function error_handler($errno, $errstr, $errfile, $errline)
{
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $str = "\r\n***********************************\r\n" . $date . " " . $time . "\r\nerror-level " . $errno . " : " . $errstr . "\r\n" . $errfile . ":" . $errline . "\r\n***********************************\r\n";
//    $str = <<<EOF
//	     "errno":$errno
//	     "errstr":$errstr
//	     "errfile":$errfile
//	     "errline":$errline
//EOF;
    //处理错误
    $file = dirname(__FILE__) . '/logs/' . $date . '.txt';
    if (!file_exists($file)) {
        fopen($file, "w");
    }
    file_put_contents($file, $str, FILE_APPEND);
    exit;
}

?>