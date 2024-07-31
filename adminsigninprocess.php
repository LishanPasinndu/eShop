<?php

use PHPMailer\PHPMailer\PHPMailer; 
 
require 'Exception.php'; 
require 'PHPMailer.php'; 
require 'SMTP.php'; 
       
require "connection.php";

if(isset($_GET["e"])){

    $e = $_POST["e"];

    if(empty($e)){
        echo "please enter your email address";
    }else{

        $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$e."'; ");

        if($rs->num_rows == 1){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification`='".$code."' WHERE `email`='".$e."' ");
 
            $mail = new PHPMailer; 
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'lishanjava@gmail.com'; 
            $mail->Password = 'Java@123123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('lishanjava@gmail.com', 'lishan'); 
            $mail->addReplyTo('lishanjava@gmail.com', 'lishan'); 
            $mail->addAddress($e); 
            $mail->isHTML(true); 
            $mail->Subject = 'Eshop forgot password verification code'; 
            $bodyContent = '<h1 style="color:red;" >Your verification code : '.$code.' </h1>'; 
            $bodyContent .= '<p>Lishan Pasindu</p>'; 
            $mail->Body    = $bodyContent; 

            if(!$mail->send()) { 
                echo 'Message could not be sent. Mailer Error '.$mail->ErrorInfo; 
            } else { 
                echo 'success'; 
            } 

        }else{
            echo "Your are not a valid user !";
        }

    }


}else{
    echo "please enter email address!";

}

?>