<?php

require "connection.php";

session_start();

if(isset($_SESSION["u"])){

    $uemail = $_SESSION["u"]["email"];
    $pid = $_GET["id"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND `user_email`='".$uemail."'; ");
    $n = $watchlistrs->num_rows;

    if($n == 1){
        echo "You have recently added this product to watchlist";

    }else{

    Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) 
    VALUES('".$pid."','".$uemail."');");

    echo "success";

    } 

}else{

    echo "no";
}



?>