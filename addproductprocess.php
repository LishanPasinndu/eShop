<?php

require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$colour = $_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc =(int) $_POST["doc"];
$description = $_POST["desc"];
$imagefile = $_FILES["img"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimeZone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail = "lishanpc@gmail.com";

if($category == "0"){
    echo "Please Select Category !";
}else if($brand == "0"){
    echo "Please Select brand !";
}else if($model == "0"){
    echo "Please Select model !";
}else if(empty($title)){
    echo "please add a title !";
}else if(strlen($title) > 100){
    echo "Title Must Contai 100 or Less than 100 Characters.";
}else if($qty == '0' || $qty == "e"){
    echo "please Add the Quantity of your product";
}else if(!is_int($qty)){
    echo "please enter valid Quantity.";
}else if(empty($qty)){
    echo "please Add the Quantity od your product";
}else if($qty < 0){
    echo "please enter valid Quantity.";
}else if(empty($price)){
    echo "please insert the price of your product.";
}else if(!is_int($price)){
    echo "please insert a valid price.";
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


    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id` ='". $brand ."' AND `model_id`='". $model ."' ");

    if($modelHasBrand->num_rows == 0){
        echo "The Product Doesn't Exists";
    }else{
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];

        Database::iud("INSERT INTO product(`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,
        `condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_with_colombo`,`delivery_out_colombo`) 
        VALUES ('".$category."','".$modelHasBrandId."','".$title."','".$colour."','".$price."','".$qty."','".$description."',
        '".$condition."','".$state."','".$useremail."','".$date."','".$dwc."','".$doc."'); ");

        echo "Add Product Success";

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

                Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES('".$filename."','".$last_id."'); ");

                echo "image saved successfulley";

            }
        }else{
            echo "please select an image";
        }

    }
   
}

?>