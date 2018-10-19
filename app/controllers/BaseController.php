<?php
use library\View\View;

/**
 * Created by PhpStorm.
 * User: sunqibo
 * Date: 2018/10/15 下午5:08
 * Desc:
 */
class BaseController
{

    public function __construct()
    {

    }

    public function assign($name, $value)
    {
        $this->assign[$name] = $value;

    }

    public function display($filename)
    {
        $file = APP . '/views/' . $filename;
        if (is_file($file)) {
            $loader = new Twig_Loader_Filesystem(APP . '/views');
            $twig = new Twig_Environment($loader, array(
                'cache' => MF . '/cache/views',
            ));
            $template = $twig->loadTemplate($filename);
            $template->display($this->assign ? $this->assign : '');
        } else {
            echo "error";
            exit;
        }
    }

    public function render($filename, $ary)
    {
        $telPath = View::getTelPaths($filename);
        foreach ($ary as $k => $v) {
            $this->assign($k, $v);
        }
//        echo "<pre>";
//        print_r($telPath);
//        exit;
        if (is_file($telPath['file_path'])) {
            $loader = new Twig_Loader_Filesystem($telPath['twig_path']);
            $twig = new Twig_Environment($loader, array(
//                'cache' => MF . '/cache/views',
            ));
            echo $twig->render($telPath['file_name'], $this->assign ? $this->assign : '');
        } else {
            echo "error";
            exit;
        }
    }

}