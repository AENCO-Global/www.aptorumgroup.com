<?php

require_once 'PHPMailer/PHPMailerAutoload.php';

// $response=$_POST["captcha"];
// $name="";
$email="";
$company="";
$tel="";
$message="";
$lang="eng";
$captcha="";

if(isset($_POST["contact_name"])) $name=$_POST["contact_name"];
if(isset($_POST["contact_email"])) $email=$_POST["contact_email"];
if(isset($_POST["contact_company"])) $company=$_POST["contact_company"];
if(isset($_POST["contact_tel"])) $tel=$_POST["contact_tel"];
if(isset($_POST["contact_message"])) $message=strip_tags(htmlspecialchars($_POST["contact_message"]));
if(isset($_POST["lang"])) $lang=$_POST["lang"];
if(isset($_POST["captcha"])) $captcha=$_POST["captcha"];

// $secret="6LcKdSsUAAAAAMF-uUuTy-a0sBQMSOcfuAApt11D";

// $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");

// $captcha_success=json_decode($verify);

// if ($captcha_success->success==false) {
//   	//This user was not verified by recaptcha.
// 	// echo "Please verify recaptcha!";
// 	if($lang=='eng'){
// 		echo "Please verify recaptcha!";
// 	}elseif($lang=='chi'){
// 		echo "请验证!";
// 	}else{
// 		echo "Please verify recaptcha!";
// 	}
// 	return false;
// }

require_once ('securimage/securimage.php');
$securimage = new Securimage();

if ($securimage->check($captcha) == false) {
	// $errors['captcha_error'] = 'Incorrect security code entered';
	if($lang=='eng'){
		echo "Incorrect security code entered!";
	}elseif($lang=='chi'){
		echo "验证码错误!";
	}else{
		echo "Incorrect security code entered!";
	}
	return false;
}

// Create the email and send the message
// $to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Videns-life new contact email";
$email_body = "You have received a new contact email from videns website<BR>";
$email_body .= "Name: ".$name."<BR>";
$email_body .= "Email: ".$email."<BR>";
$email_body .= "Company: ".$company."<BR>";
$email_body .= "Contact: ".$tel."<BR>";
$email_body .= "Message: ".$message."<BR>";

// $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";   
// mail($to,$email_subject,$email_body,$headers);
$ok = sendEmail($email_subject,$email_body);
if($ok){
	echo "success";
	return true;
}else{
	echo "fail";
	return false;
}
function sendEmail($subject,$msgbody) {
	$mail = new PHPMailer;
	// $headers = "Content-Type: text/html; charset=UTF-8";
	// $mail->MailerDebug = 1;
	// $mail->Debugoutput = 'html';	
	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
	$mail->Port = 465;                                    // Set the SMTP port
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'videns.life@gmail.com';                // SMTP username
	$mail->Password = 'Abcd.!@#$';                  // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
	$mail->From = 'videns.life@gmail.com';
	$mail->FromName = 'Videns Investor Relations';
	$mail->AddAddress('edmund.wong@videns-life.com');               // Name is optional
	$mail->IsHTML(true);                                  // Set email format to HTML
	$mail->CharSet = 'UTF-8';
	$mail->Subject = $subject;
	$mail->Body    = $msgbody;

	return $mail->Send();

}


?>
