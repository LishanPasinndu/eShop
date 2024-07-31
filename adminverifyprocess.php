<?php

require "connection.php";

$e = $_POST["e"];
$v = $_POST["v"];

if(empty($e)){
    echo "Missing Email Address!";
}else if(empty($v)){
    echo "Please enter your verification code";
}else{

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$e."' AND `verification`='".$v."'; ");
    if($rs->num_rows == 1){

        
    $d = $rs->fetch_assoc();
    $_SESSION["a"] = $d;

        echo "1";
        
    }else{
        echo "Sign in Faliedd!";
    }

}

?>