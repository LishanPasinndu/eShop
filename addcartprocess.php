<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){
    
$pid = $_GET["id"];
$qty = $_GET["qty"];
$email = $_SESSION["u"]["email"];

if($qty == 0){
    echo "Please add a quantity ";

}else{

$cartrs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'; ");
$cn = $cartrs->num_rows;

if($cn == 1){
 
echo "this product is already exists in your cart";

}else{

$productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'; ");
$pr = $productrs->fetch_assoc();

$prqty = $pr["qty"];

if($prqty >= $qty){

    Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`)
    VALUES('".$pid."','".$email."','".$qty."'); ");
    
    echo "This product added in your cart";

}else{

    echo "Please enter a valid quantity below"." ".$prqty.".";
}

}

}

}

?>