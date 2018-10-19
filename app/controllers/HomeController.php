<?php
use library\PHPMailer\MyPHPMailer;

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
//        print_r($row);
        $this->render('home.home', array('data' => $row));
    }

    public function testMail(){
        $addAddress = array('1010889100@qq.com','981444067@qq.com');
        $subject = 'test';
        $body = '<h1>Hello World</h1>';
        $altBody = 'This is a plain-text message body';
        $addAttachment  =  APP.'/views/layout.html';
        $r = new MyPHPMailer($addAddress,$subject,$body,$altBody,$addAttachment);
    }

}