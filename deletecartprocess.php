<?php

session_start();

require "connection.php";

if($_SESSION["u"]){

    $id = $_GET["id"];
    $email = $_SESSION["u"]["email"];

    $cartrs = Database::search("SELECT * FROM `cart` WHERE `id`='".$id."'; ");
    $cf = $cartrs->fetch_assoc();
    $pid = $cf["product_id"];

    $recentrs = Database::search("SELECT * FROM `recent` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'; ");
    $rn = $recentrs->num_rows;

    if($rn == 1){

        Database::iud("DELETE FROM `cart` WHERE `id`='".$id."'; ");

        echo "success";

    }else{

        Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES ('".$pid."','".$email."'); ");

        Database::iud("DELETE FROM `cart` WHERE `id`='".$id."'; ");

        echo "success";

    }


}

?>