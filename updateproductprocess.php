<?php

require "connection.php";

$pid = $_POST["id"];
$title = $_POST["t"];
$qty = (int)$_POST["qty"];
$dwc = (int)$_POST["dwc"];
$doc =(int) $_POST["doc"];
$description = $_POST["desc"];
$imagefile = $_FILES["img"];

session_start();
$email = $_SESSION["u"]["email"];

if(empty($title)){
    echo "please add a title !";
}else if(strlen($title) > 100){
    echo "Title Must Contai 100 or Less than 100 Characters.";
}else if($qty == '0' || $qty == "e"){
    echo "please Add the Quantity of your product";
}else if(!is_int($qty)){
    echo "please enter valid Quantity.";
}else if(empty($qty)){
    echo "please Add the Quantity of your product";
}else if($qty < 0){
    echo "please enter valid Quantity.";
}else if(empty($dwc)){
    echo "please insert the delivery cost within colombo.";
}else if(!is_int($dwc)){
    echo "please insert a valid price.";
}else if(empty($doc)){
    echo "please insert the delivery cost out of colombo.";
}else if(!is_int($doc)){
    echo "please insert a valid price.";
}else if(empty($description)){
    echo "please enter the description of your product.";
}else{

        Database::iud("UPDATE FROM product SET
        `title`='".$title."',`qty`='".$qty."',`description`='".$description."',`delivery_with_colombo`='".$dwc."',
        `delivery_out_colombo`='".$doc."' WHERE `id`='".$pid."' AND `user_email`='".$email."' ; ");

        echo "Update Product Success";

        $last_id = Database::$connection->insert_id;

         $allowed_image_extention = array("image/jpeg","image/png","image/svg","image/jpg");
        // $file_extention = pathinfo($imagefile,PATHINFO_EXTENSION);

        $file_extention = $imagefile["type"];
        if(isset($imagefile)){
   
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

                $filename = "resources//products//".uniqid().$newimgextention;

                move_uploaded_file($imagefile["tmp_name"],$filename);

                Database::iud("UPDATE FROM `images` SET `code`='".$filename."',`product_id`='".$pid."' ");

                echo "image Updated successfulley";

            }
        }else{
            echo "please select an image";
        }
   
}

?>

