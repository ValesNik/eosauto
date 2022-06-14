<?php
require_once "PHPMailerAutoload.php";
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'eosauto.test@bk.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'YBGU3mC0wUefvj3Rywpn'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('eosauto.test@bk.ru'); // от кого будет уходить письмо?
//$mail->addAddress('pebojaf267@game4hr.com');     // Кому будет уходить письмо
$mail->isHTML(true);                                  // Set email format to HTML
?>