<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $oid = $_POST["oid"];
    $pid = $_POST["pid"];
    $email = $_POST["email"];
    $total = $_POST["total"];
    $qty = $_POST["qty"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'; ");
    $pr = $productrs->fetch_assoc();

    $oldqty = $pr["qty"];
    $newqty = $oldqty - $qty;

    Database::iud("UPDATE `product` SET `qty`='".$newqty."' WHERE `id`='".$pid."'; ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimeZone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`)
    VALUES('".$oid."','".$pid."','".$email."','".$date."','".$total."','".$qty."'); ");

    echo "success";

}

?>