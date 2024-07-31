<?php

require "connection.php";

$id = $_GET["p"];

$statusrs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'; ");
$sn =$statusrs->num_rows;

if($sn == 1){

    $sd = $statusrs->fetch_assoc();

    $status_id = $sd["status_id"];

    if($status_id == 1){

        Database::iud("UPDATE `product` SET `status_id`=2 WHERE `id`='".$id."';");
        echo "Deactivated";

    }else{
        Database::iud("UPDATE `product` SET `status_id`=1 WHERE `id`='".$id."';");
        echo "Activated";
    }

}else{

    echo "Canot connect to database";

}

?>