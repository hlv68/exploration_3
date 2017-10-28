<?php
	error_reporting(0);
	require_once "Smtp.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "joyxu39@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $_POST['email'];//发送给谁
	$smtpuser = "joyxu39@163.com";//SMTP服务器的用户帐号(或填写new2008oh@126.com，这项有些邮箱需要完整的)
	$smtppass = "Aa123456";//SMTP服务器的用户密码
	$mailtitle = "Come form ".$_POST['name'];//邮件主题
	$mailcontent = $_POST['message'];//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state == ""){
		echo json_encode('email error?!');exit;
	}else{
		echo json_encode("Congratulations! Mail sent successfully!");exit;
	}
?>