<?php
// INIT
error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("SMTP","smtp.gmail.com");
ini_set('sendmail_from', 'kresimir.ivkovic@gmail.com'); 

//smtp_server = mail.example.com
//smtp_port = 25
ini_set('smtp_port', '25');
ini_set('auth_username', 'kresimir.ivkovic@gmail.com');
ini_set('auth_password', 'kK<>55$$10');

// the message
$msg = "First line of text\nSecond line of text\n789 00 987";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
//mail("kresimir.ivkovic@windowslive.com","My subject",$msg);
mail("kresimir.ivkovic@gmail.com","My subject",$msg);
echo "send mail";
?>