<?php

namespace library\PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * User: sunqibo
 * Date: 2018/10/19 下午1:56
 * Desc:
 */
class MyPHPMailer
{
    public $mailInfo = array();

    /**
     * MyPHPMailer constructor.
     * @param $addAddress  收件人
     * @param $subject 主题
     * @param $body 内容
     * @param null $altBody 附加内容
     * @param null $addAttachment 附件地址
     * @throws \Exception
     */
    public function __construct($addAddress, $subject, $body, $altBody = null, $addAttachment = null)
    {
        $this->mailInfo['addAddress'] = $addAddress;
        $this->mailInfo['Subject'] = $subject;
        $this->mailInfo['Body'] = $body;
        $this->mailInfo['addAttachment'] = $addAttachment;
        $this->mailInfo['AltBody'] = $altBody;
        $this->mailConfig();
        $this->verifyInfo();
        $this->sendMail();
    }

    /**
     * Desc: 验证必要参数
     * @throws \Exception
     */
    public function verifyInfo()
    {
        if (!empty($this->mailInfo['addAddress'])) {
            if (is_array($this->mailInfo['addAddress'])) {
                foreach ($this->mailInfo['addAddress'] as $k => $v) {
                    $this->mail['addAddress'][] = $v;
                }
            } else {
                $this->mail['addAddress'][] = $this->mailInfo['addAddress'];
            }
        } else {
            throw new \Exception('addAddress is null');
        }
        if (!empty($this->mailInfo['Subject'])) {
            $this->mail['Subject'] = $this->mailInfo['Subject'];
        } else {
            throw new \Exception('Subject is null');
        }
        if (!empty($this->mailInfo['Body'])) {
            $this->mail['Body'] = $this->mailInfo['Body'];
        } else {
            throw new \Exception('Body is null');
        }
        if (!empty($this->mailInfo['addAttachment'])) {
            if (is_array($this->mailInfo['addAttachment'])) {
                foreach ($this->mailInfo['addAttachment'] as $v) {
                    if (!is_file($v)) {
                        throw new \Exception($v . ' not find');
                    }
                    $this->mail['addAttachment'][] = $v;
                }
            } else {
                if (!is_file($this->mailInfo['addAttachment'])) {
                    throw new \Exception($this->mailInfo['addAttachment'] . ' not find');
                }
                $this->mail['addAttachment'][] = $this->mailInfo['addAttachment'];
            }
        }
        if (!empty($this->mailInfo['AltBody'])) {
            $this->mail['AltBody'] = $this->mailInfo['AltBody'];
        }
    }

    /**
     * Desc: 邮件配置
     */
    public function mailConfig()
    {
        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认0关闭debug调试模式
        // $mail->SMTPDebug = 0;
        $this->mail['SMTPDebug'] = 0;
        // 使用smtp鉴权方式发送邮件
        // $mail->isSMTP();
        // smtp需要鉴权 这个必须是true
        // $mail->SMTPAuth = true;
        $this->mail['SMTPAuth'] = "true";
        // 链接qq域名邮箱的服务器地址
        // $mail->Host = 'smtp.qq.com';
        $this->mail['Host'] = 'smtp.qq.com';
        // 设置使用ssl加密方式登录鉴权
        // $mail->SMTPSecure = 'ssl';
        $this->mail['SMTPSecure'] = 'ssl';
        // 设置ssl连接smtp服务器的远程服务器端口号
        // $mail->Port = 465;
        $this->mail['Port'] = 465;
        // 设置发送的邮件的编码
        // $mail->CharSet = 'UTF-8';
        $this->mail['CharSet'] = 'UTF-8';
        // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
        // $mail->FromName = 'test';
        $this->mail['FromName'] = 'sqb';
        // smtp登录的账号 QQ邮箱即可
        // $mail->Username = 'sunqibo666@qq.com';
        $this->mail['Username'] = 'sunqibo666@qq.com';
        // smtp登录的密码 使用生成的授权码
        // $mail->Password = 'drztzazyzwlqbajj';
        $this->mail['Password'] = 'drztzazyzwlqbajj';
        // 设置发件人邮箱地址 同登录账号
        // $mail->From = 'sunqibo666@qq.com';
        $this->mail['From'] = 'sunqibo666@qq.com';
        // 邮件正文是否为html编码 注意此处是一个方法
        // $mail->isHTML(true);
    }

    /**
     * Desc: 邮件发送
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendMail()
    {
        $mail = new PHPMailer();
        // 使用smtp鉴权方式发送邮件
        $mail->isSMTP();
        // 邮件正文是否为html编码 注意此处是一个方法
        $mail->isHTML(true);
        foreach ($this->mail as $k => $v) {
            if ($k == 'addAttachment') {
                foreach ($v as $file) {
                    $mail->addAttachment($file);
                }
            } else if ($k == 'addAddress') {
                foreach ($v as $tomail) {
                    $mail->addAddress($tomail);
                }
            } else {
                $mail->$k = $v;
            }
        }
        if (!$mail->send()) {
            throw new \Exception('send error');
        }
    }
}
