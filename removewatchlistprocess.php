<?php

require "connection.php";

$pid = $_GET["id"];

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$pid."'; ");
$watchrsq = $watchrs->fetch_assoc();

$proid = $watchrsq["product_id"];
$email = $watchrsq["user_email"];

Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES ('".$proid."','".$email."'); ");

Database::iud("DELETE FROM `watchlist` WHERE `id`='".$pid."'; ");

echo "success";
?>