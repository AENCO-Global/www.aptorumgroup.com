<?php

require 'PHPMailer/PHPMailerAutoload.php';

// $response=$_POST["captcha"];
// $quote = strip_tags(htmlspecialchars($_POST['quote']));
// $secret="6Ld0rh8UAAAAAOdNV8etrtcJpU8R_S1ruLxyEu";
// $name = "ABC";
// $email_address = "abc@abc.com";
// $phone = "33333333";
// $message = "HELLO";
$quote = "TESTING";

// $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");

// $captcha_success=json_decode($verify);

// if ($captcha_success->success==false) {
  	//This user was not verified by recaptcha.
	// echo "Please verify recaptcha!";
	// echo "Please verify recaptcha!";
	// return false;
// }
// else if ($captcha_success->success==true) {
  	//This user is verified by recaptcha

// }

// Create the email and send the message
// $to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Quote Request";
$email_body = "You have received a new message from your website quote form.\n\n"."Here are the details:\n\nQuote: ".$quote;
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
	$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';	
	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
	$mail->Port = 465;                                    // Set the SMTP port
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'aptorum.group@gmail.com';                // SMTP username
	$mail->Password = 'Abcd.!@#$';                  // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
	$mail->From = 'aptorum.group@gmail.com';
	$mail->FromName = 'aptorum.group web';
	$mail->AddAddress('test@gmail.com');               // Name is optional
	$mail->IsHTML(true);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $msgbody;

	
	if(!$mail->Send()) {
		echo $mail->ErrorInfo;
		return false;
	}else{
		return true;
	}

}

?>
