<?php
header('content-type:text/html;charset=utf-8');
require_once 'vendor/autoload.php';
/**
 * 发送邮件方法
 * @param $to ：接收者数组 $title：标题 $content：邮件内容
 */
function sendMail(array $to,$title,$content){
    //配置（强烈建议写进配置文件，这里我仅是为了方便）
    $config = array(
        // 配置邮件发送服务器
        'MAIL_DEBUG'     =>  0,   // 是否启用smtp的debug进行调试
        'MAIL_HOST'      =>  'smtp.qq.com',   // SMTP服务器地址
        'MAIL_HOSTNAME'  =>  'www.lijunxian.com',   // 设置发件人的主机域
        'MAIL_PORT'      =>  465,  //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
        'MAIL_SMTPAUTH'  =>  TRUE, //启用smtp认证
        'MAIL_USERNAME'  =>  '527723190@qq.com',  // 用户名
        'MAIL_FROM'      =>  '527723190@qq.com',  // 邮箱地址
        'MAIL_FROMNAME'  =>  '小贤',  // 发件人姓名
        'MAIL_PASSWORD'  =>  'zwnhhavadnzcbjge',  //smtp登录的密码 使用生成的授权码
        'MAIL_CHARSET'   =>  'UTF-8',   // 字符集
        'MAIL_ISHTML'    =>  TRUE, // 是否HTML格式邮件
        'MAIL_REPLYTO'   =>  '527723190@qq.com',   //用户回复邮件时的接收邮箱，可以与原始邮箱分开
        //抄送就是 你写的这封邮件除了传送给收件人，还会传送给你在抄送一栏里写的邮箱地址，并且收件人>知道你把这封邮件发给了他和抄送一栏里输入的邮件地址的人
        //密送就是 你写的这封邮件除了传送给收件人，还会传送给你在暗送一栏里写的邮箱地址，但是收件人>不知道你把这封邮件发给了暗送一栏里输入的邮件地址的人
        'MAIL_CC'        =>  '',    //抄送者
        'MAIL_BCC'       =>  '',    //密送着
    );

    //实例化PHPMailer核心类
    //这里由于 index.php 文件中已经 include "vendor/autoload.php"，这里就不用引入了
    $mail = new PHPMailer;
    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    //链接qq域名邮箱的服务器地址
    $mail->Host = $config['MAIL_HOST'];
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = $config['MAIL_SMTPAUTH'];
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = $config['MAIL_USERNAME'];
    //smtp登录的密码 使用生成的授权码
    $mail->Password = $config['MAIL_PASSWORD'];
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = $config['MAIL_PORT'];
    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = $config['MAIL_CHARSET'];
    $mail->setFrom($config['MAIL_FROM'], $config['MAIL_FROMNAME']);
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','晶晶在线用户');
    foreach($to as $val){
        $mail->addAddress($val);
    }

    //设置用户回复的邮箱
    $mail->addReplyTo($config['MAIL_REPLYTO']);

    //设置抄送人
    $mail->addCC($config['MAIL_CC']);
    //密送者，Mail Header不会显示密送者信息
    $mail->addBCC($config['MAIL_BCC']);

//    $mail->addAttachment('/var/tmp/file.tar.gz');         // 添加附件
    $mail->addAttachment('./img/girl.jpg', 'nice.jpg');    // Optional name
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML($config['MAIL_ISHTML']);

    //添加该邮件的主题
    $mail->Subject = $title;
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数>读取本地的html文件
    $mail->Body = $content;
    //添加邮件正文 上方将isHTML设置成了false时调用
    $mail->AltBody = strip_tags($content);

    if (!$mail->send()) {
        throw new \Exception('邮件发送失败！请检查相关配置！');
    }
}

try{
    $users = array('15520475015@163.com');
    $title = '测试附件';
    $content = file_get_contents('index.html');
    sendMail($users,$title,$content);
    echo "发送成功";
}catch(Exception $e){
    var_dump($e->getMessage());
}

?>