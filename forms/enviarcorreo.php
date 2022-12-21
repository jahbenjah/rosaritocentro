<?php

require("../assets/vendor/PHPMailer/src/PHPMailer.php");
require("../assets/vendor/PHPMailer/src/SMTP.php");

 $mail = new PHPMailer\PHPMailer\PHPMailer();
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true; // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
 $mail->Host = "mail.rosaritocentro.com";
 $mail->Port = 465; //465  or 587
 $mail->IsHTML(true);
 $mail->Username = "contacto@rosaritocentro.com";
 $mail->Password = "RosaritoCentroBC";
 $mail->SetFrom("contacto@rosaritocentro.com");
 $mail->Subject = "Contacto Desde : Rosarito Centro";
 
 $name = $_POST['name'];
 $email = $_POST['email'];
 $subject = $_POST['subject'];
 $message = $_POST['message'];

 
 $mail->Body = "Nombre: {$name}  <br> Correo Electronico: {$email} <br> Asunto : {$subject} <br> Mensaje : {$message}";
 $mail->AddAddress("contacto@rosaritocentro.com");
 if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
 echo "OK";
 }
if(isset($_POST['g-recaptcha-response'])) {
   // RECAPTCHA SETTINGS
   $captcha = $_POST['g-recaptcha-response'];
   $ip = $_SERVER['REMOTE_ADDR'];
   $key = '6Lfwi24gAAAAAN_yYd6f2hBlFDZA7AKHfFli3eWt';
   $url = 'https://www.google.com/recaptcha/api/siteverify';

   // RECAPTCH RESPONSE
   $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
   $data = json_decode($recaptcha_response);

   if(isset($data->success) &&  $data->success === true) {
   }
   else {
      die('Your account has been logged as a spammer, you cannot continue!');
   }
 }
 ?>