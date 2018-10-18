<?php

/**
 * Created by PhpStorm.
 * User: sunqibo
 * Date: 2018/10/15 下午5:08
 * Desc:
 */
class HomeController extends BaseController
{
    public function home()
    {
        $row = Article::first()->toArray();
        $this->render('home.home', array('data' => $row));
    }
}