<?php

require "connection.php";

if(isset($_GET["c"])){

    $category = $_GET["c"];

    if(empty($category)){
        echo "Please enter a category name";
    }else{

        $crs = Database::search("SELECT * FROM `category` WHERE `name`='".$category."'; ");
        $cn = $crs->num_rows;

        if($cn == 1){
            echo "The category already exists";

        }else{

            Database::iud("INSERT INTO `category`(`name`) VALUES('".$category."');  ");

            echo "success";
        }
        
    }

}


?>