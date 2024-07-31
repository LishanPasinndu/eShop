<?php

require "connection.php";

if(isset($_POST["e"])){

    $email = $_POST["e"];

    $users = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'; ");
    $num = $users->num_rows;

    if($num == 1){

        $row = $users->fetch_assoc();
        $us = $row["status"];

        if($us == "1"){

        Database::iud("UPDATE `user` SET `status`='2' WHERE `email`='".$email."'; ");

        echo "success1";

        }else{

            Database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$email."'; ");

            echo "success2";
        }

    }

}


?>