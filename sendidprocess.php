<?php

session_start();
$user = $_SESSION["u"]["email"];

require "connection.php";

$id = $_GET["id"];

$product = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'
AND `user_email`='".$user."'; ");
$n = $product->num_rows;

if($n == 1){

    $row = $product->fetch_assoc();

    $_SESSION["p"] = $row;

    echo "success";

}else{
    echo "error";
}


?>