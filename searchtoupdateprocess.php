<?php

require "connection.php";

$array;

if(isset($_GET["id"])){

$id = $_GET["id"];

if(empty($id)){
    echo "please enter the productid";
}else{

    $prs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'; ");
    $n = $prs->num_rows;

    if($n == 1){
        $r = $prs->fetch_assoc();

        $array["id"] = $r["id"];

        $crs = Database::search("SELECT * FROM `category` WHERE `id`='".$r["category_id"]."' ");
        if($crs->num_rows == 1){
            $cr = $crs->fetch_assoc();
            $array["category"] = $cr["id"];
        }

        $mhbi = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$r["model_has_brand_id"]."' ");
        $mhb = $mhbi->fetch_assoc();
        $moid = $mhb["model_id"];
        $brid = $mhb["brand_id"];

        $moq = Database::search("SELECT * FROM `model` WHERE `id`='".$moid."' ");
        $moqr = $moq->fetch_assoc();
        $model = $moqr["id"];

        $brq = Database::search("SELECT * FROM `brand` WHERE `id`='".$brid."' ");
        $brqr = $brq->fetch_assoc();
        $brand = $brqr["id"];

        $imgq = Database::search("SELECT * FROM `images` WHERE `product_id`='".$r["id"]."' ");
        $imgqr = $imgq->fetch_assoc();
        $img = $imgqr["code"];

        $array["model"] = $model;
        $array["brand"] = $brand;
        $array["title"] = $r["title"];
        $array["con"] = $r["condition_id"];
        $array["color"] = $r["color_id"];
        $array["qty"] = $r["qty"];
        $array["price"] = $r["price"];
        $array["dwc"] = $r["delivery_with_colombo"];
        $array["doc"] = $r["delivery_out_colombo"];
        $array["desc"] = $r["description"];
        $array["img"] = $img;

        echo json_encode($array);

    }else{
        echo "Invalid Product id";
    }

}

}


?>