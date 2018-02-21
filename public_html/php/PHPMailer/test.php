<?php
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.vg-pb.com';                 // Specify main and backup server
$mail->Port = 25;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'e.wong@vg-pb.com';                // SMTP username
$mail->Password = 'Ed780821';                  // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'e.wong@vg-pb.com';
$mail->FromName = 'Edmund';
// $mail->AddAddress('josh@example.net', 'Josh Adams');  // Add a recipient
$mail->AddAddress('e.wong@vg-pb.com');               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';

?>