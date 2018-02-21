<?php 
    require_once 'securimage/securimage.php'; 
    if(isset($_POST['input_text'])){
        $input_text = $_POST['input_text'];
    }else{
        $input_text = 'ok';
    }
    echo Securimage::getCaptchaHtml(array('input_name' => 'ct_captcha','input_text' => $input_text)); 
?>