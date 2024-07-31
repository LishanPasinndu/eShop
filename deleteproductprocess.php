<?php

require "connection.php";

$id = $_GET["id"];

$product = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'; ");
$pn = $product->num_rows;

if($pn == 1 ){

    Database::iud("DELETE FROM `images` WHERE `product_id`='".$id."'; ");

    echo "Product Image Deleted";

    Database::iud("DELETE FROM `product` WHERE `id`='".$id."'; ");

    echo "Product Deleted";

}else{
    echo "Product Does Not Exist";
}

?>