<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $orderid = uniqid();

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'; ");
    $pr = $productrs->fetch_assoc();

    $addresrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'; ");
    $cn = $addresrs->num_rows;

    $cityid;
    $add;

    if($cn == 1){

        $ar = $addresrs->fetch_assoc();
        $cityid = $ar["city_id"];

        $add = $ar["line1"].",".$ar["line2"];

        $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='".$cityid."'; ");
        $dr = $districtrs->fetch_assoc();
        $districtid = $dr["district_id"];

        $delivery = "0";

        if($districtid == "1"){
            $delivery = $pr["delivery_with_colombo"];
        }else{
            $delivery = $pr["delivery_out_colombo"];
        }

        $item = $pr["title"];
        $amount = $pr["price"]*$qty + $delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $add;
        $city = $dr["name"];

        $array['id'] = $orderid;
        $array['item'] = $item;
        $array['amount'] = $amount;
        $array['fname'] = $fname;
        $array['lname'] = $lname;
        $array['email'] = $umail;
        $array['mobile'] = $mobile;
        $array['address'] = $address;
        $array['city'] = $city;
    
        echo json_encode($array);

    }else{

       echo "2";

    } 

}else{

    echo "1";

}


?>