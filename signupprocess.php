<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if(empty($fname)){
    echo "Please enter your First Name";
}else if(strlen($fname) > 50){
    echo "First Name must be less than 50 characters";
}else if(empty($lname)){
    echo "Please enter your Last Name";
}else if(strlen($lname) > 50){
    echo "Last Name must be less than 50 characters";
}else if(empty($email)){
    echo "Please enter your Email";
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Please enter valid Email";
}else if(strlen($email) > 100){
    echo "Email must be less than 100 characters";
}else if(empty($password)){
    echo "Please enter your Password";
}else if(strlen($password) < 5||strlen($password) > 20){
    echo "password length must between 5 to 20";
}else if(empty($mobile)){
    echo "Please enter your mobile";
}else if(strlen($mobile) != 10){
    echo "Please enter 10 digit number";
}else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
    echo "Invalid mobile number";
}else{

    require "connection.php";
    $r = Database::search("SELECT * FROM user WHERE `email` = '".$email."' OR `mobile`='".$mobile."' ");
    $n = $r->num_rows;
    if($n > 0){
       echo "User with the same email address already exists";
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimeZone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO user(`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender_id`) 
        VALUES('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','".$gender."'); ");
    
        echo "success";

    }


}
?>