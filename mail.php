<?php
/**
 * @Author: Marte
 * @Date:   2017-07-21 09:38:51
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-07-21 10:41:48
 */ 
header('content-type:text/html;charset=utf-8');
require_once("./phpmail/functions.php");
$flag = sendMail('example@163.com','邮件测试','恭喜你测试成功，开启你的学习之旅吧！');
if($flag){
    echo "发送邮件成功！";
}else{
    echo "发送邮件失败！";
}
?>
