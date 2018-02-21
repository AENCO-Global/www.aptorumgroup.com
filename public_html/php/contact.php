<?php

require_once 'PHPMailer/PHPMailerAutoload.php';

define('SUBJECT', "Aptorum Group new contact email");

require_once ('securimage/securimage.php');

class Mailer{
	
    private $_params;
    private $_errors;

    public function __construct(){
        $this->_params = $this->LoadParams();
        $this->_errors = array();
    }

    public function run(){	
        if($this->Validate()){
            $msgbody = $this->msgBody();
            $subject = SUBJECT;                   
            $res = $this->SendEmail($msgbody, $subject);
            if($res === true)
                $this->OnSuccess();
            else
                $this->OnError();	
        }else
            $this->OnError();		
    }

    private function LoadParams(){
        return $_POST['contact'];
    }

    private function msgBody(){
       
        $email_body = "You have received a new contact email from Aptorum Group website<BR>";
        
        if((isset($this->_params['name']))) 
            $email_body .= "Name: ".$this->_params['name']."<BR>";
        if((isset($this->_params['email'])))
            $email_body .= "Email: ".$this->_params['email']."<BR>";                           
        if((isset($this->_params['subject'])))
            $email_body .= "Subject: ".$this->_params['message']."<BR>";
        if((isset($this->_params['message'])))
            $email_body .= "Message: ".$this->_params['message']."<BR>";

        return $email_body;

    }

    private function Validate(){

        $securimage = new Securimage();
        
        if ($securimage->check($_POST['captcha']) == false) {
            // $errors['captcha_error'] = 'Incorrect security code entered';
            $this->_errors['captcha'] = 'invalid_captcha';
        }

        if(!(isset($this->_params['name']) && ($this->_params['name'] != '')))
            $this->_errors['name'] = 'empty_name';
        if(!(isset($this->_params['email']) && $this->_params['email'] != ''))
            $this->_errors['email'] = 'empty_email';
        else{
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if(!preg_match($email_exp,$this->_params['email']))
                $this->_errors['email'] = 'invalid';
        }
        if(!(isset($this->_params['subject']) && $this->_params['subject'] != ''))
            $this->_errors['subject'] = 'empty_subject';
        if(!(isset($this->_params['message']) && $this->_params['message'] != ''))
            $this->_errors['message'] = 'empty_message';
        
        return (count($this->_errors) == 0);
    }

    private function SendEmail($msgbody, $subject){
        
        $mail = new PHPMailer;
        // $headers = "Content-Type: text/html; charset=UTF-8";
        // $mail->MailerDebug = 1;
        // $mail->Debugoutput = 'html';	
        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
        $mail->Port = 465;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'aptorum.group@gmail.com';                // SMTP username
        $mail->Password = 'Abcd.!@#$';                  // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
        $mail->From = 'aptorum.group@gmail.com';
        $mail->FromName = 'Aptorum Group Investor Relations';
        $mail->AddAddress('investor.relations@aptorumgroup.com');               // Name is optional
        $mail->IsHTML(true);                                  // Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $msgbody;
    
        return $mail->Send();

    }

    private function OnSuccess(){        
        echo '{"success": true}';
    }

    private function OnError(){
        $response = '{';
        $response .= '"success": false, "errors": [';
        
        foreach($this->_errors as $key => $value) {  
            $response .= "{ \"field\": \"$key\", \"error\": \"$value\"},";
        }
        if(count($this->_errors) > 0)
            $response = substr($response, 0, -1);
        $response .= ']}';
        
        echo $response;
    }
    
}
$mailer = new Mailer();
$mailer->run();
?>