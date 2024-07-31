<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$line1 = $_POST["a1"];
$line2 = $_POST["a2"];
$city = $_POST["c"];

if(empty($fname)){
    echo "please entr the first name!";
}else if(empty($lname)){
    echo "please entr the last name!";
}else if(empty($mobile)){
    echo "please entr the mobile number!";
}else if(strlen($mobile) != 10){
    echo "Please enter 10 digit number";
}else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
    echo "Invalid mobile number";
}else if(empty($line1)){
    echo "please entr the address line 1!";
}else if(empty($line2)){
    echo "please entr the address line 2!";
}else if(empty($city)){
    echo "please entr the city!";
}else{

    $up = Database::iud("UPDATE `user` SET
    `fname`='".$fname."',
    `lname`='".$lname."',
    `mobile`='".$mobile."' 
    WHERE `email`='".$_SESSION["u"]["email"]."';");
    
    echo "user table updated";
    
    $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."'; ");
    $nr = $address->num_rows;
    
    if($nr == 1){
    
        //update
    
        $city_id = Database::search("SELECT `id` FROM `city` WHERE `name`='".$city."'; ");
        $unr = $city_id->fetch_assoc();
    
        Database::iud("UPDATE FROM `user_has_address` SET 
        `line1`='".$line1."',
        `line2`='".$line2."',
        `city_id`='".$unr["id"]."'
        WHERE `user_email`='".$_SESSION["u"]["email"]."' ");
    
        echo "Address Updated";
    
    }else{
    
        //add new
    
        $city_id = Database::search("SELECT `id` FROM `city` WHERE `name`='".$city."'; ");
        $unr = $city_id->fetch_assoc();
    
        Database::iud("INSERT INTO `user_has_address`(`line1`,`line2`,`user_email`,`location_id`)
        VALUES('".$_SESSION["u"]["email"]."','".$line1."','".$line2."','".$unr["id"]."') ");
    
    }

    $allowed_image_extention = array("image/jpeg","image/png","image/svg","image/jpg");
    // $file_extention = pathinfo($imagefile,PATHINFO_EXTENSION);

    if(isset($_FILES["i"])){
        
        $img = $_FILES["i"];

        $file_extention = $img["type"];

        $profilleiimg = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$_SESSION["u"]["email"]."';");   
        $pgnn = $profilleiimg->num_rows;

        if($pgnn == 1){

            if(!in_array($file_extention,$allowed_image_extention)){
                echo "please select a valid image";
            }else{
    
                $newimgextention;
    
                if($file_extention == "image/jpeg"){
                $newimgextention = ".jpeg";
                }else if($file_extention == "image/jpg"){
                $newimgextention = ".jpg";
                }else if($file_extention == "image/png"){
                $newimgextention = ".png";
                }else if($file_extention == "image/svg"){
                $newimgextention = ".svg";
                }
    
                $filename = "resources//profileimg//".uniqid().$newimgextention;
    
                move_uploaded_file($img["tmp_name"],$filename);
    
                Database::iud("UPDATE FROM `profile_image` SET 
                `code`='".$filename."',
                `user_email`='".$_SESSION["u"]["email"]."'       
                WHERE `user_email`='".$_SESSION["u"]["email"]."'; ");
    
                echo "image updated successfulley";
    
            
        }

        }else{

            if(!in_array($file_extention,$allowed_image_extention)){
                echo "please select a valid image";
            }else{
    
                $newimgextention;
    
                if($file_extention == "image/jpeg"){
                $newimgextention = ".jpeg";
                }else if($file_extention == "image/jpg"){
                $newimgextention = ".jpg";
                }else if($file_extention == "image/png"){
                $newimgextention = ".png";
                }else if($file_extention == "image/svg"){
                $newimgextention = ".svg";
                }
    
                $filename = "resources//profileimg//".uniqid().$newimgextention;
    
                move_uploaded_file($img["tmp_name"],$filename);
    
                Database::iud("INSERT INTO `profile_image`(`code`,`user_email`) 
                VALUES('".$filename."','".$_SESSION["u"]["email"]."'); ");
    
                echo "image saved successfulley";
    
            
        }

        
        }
    }else{
        echo "you haven't update profile picture";
    }

}


}


// echo $fname;
// echo "<br/>";
// echo $lname;
// echo "<br/>";
// echo $mobile;
// echo "<br/>";
// echo $line1;
// echo "<br/>";
// echo $line2;
// echo "<br/>";
// echo $city;
// echo "<br/>";
// echo $img["name"];



?>