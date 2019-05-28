<?php

/* PHP Mailer */
use PHPMailer\PHPMailer\PHPMailer;

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $name = trim($_POST["name"]);
  $phone = trim($_POST["phone"]);
  $model = trim($_POST["model"]);
  $comment = trim($_POST["comment"]);

  $message = "Имя: $name \nТелефон: $phone \nМодель: $model \nОписание задачи: $comment";

  require './PHPMailer/PHPMailer.php';
  require './PHPMailer/SMTP.php';


  $mail = new PHPMailer();                              // Passing `true` enables exceptions
  try {
      $mail->CharSet = 'utf-8';
      //Server settings
      $mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'borisov-vadim-sites@yandex.ru';                 // SMTP username
      $mail->Password = 'NlyUU5ztQW0WDEaDQqxk';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('borisov-vadim-sites@yandex.ru', 'aussiewear.ru');
      $mail->addAddress('novator1005@gmail.com');     // Add a recipient
      //$mail->addAddress('ishutin-pavel@mail.ru');     // Add a recipient

      //Content
      $mail->isHTML(false);                                  // Set email format to HTML
      $mail->Subject = 'Заявка с сайта aussiewear.ru';
      $mail->Body    = $message;

      $mail->send();
      echo 'Сообщение успешно отправлено. Мы свяжемся с Вами в ближайшее время.';
  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }

}//POST