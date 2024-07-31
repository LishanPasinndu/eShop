<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";

    ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | cart</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="col-12" style="background-color: #E3E5E4;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-2">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Basket</li>
                    </ol>
                </nav>
            </div>

            <div class=" col-12 border border-1 border-secondary rounded mb-3">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fs-1 fw-bolder">&nbsp;Basket<i class="bi bi-cart3"></i></label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hrbreak1" />
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Search in Cart...." />
                            </div>
                            <div class="col-12 col-lg-2 d-grid mb-3">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="hrbreak1" />
                    </div>

                    <?php
                    
                    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$umail."'; ");
                    $cn = $cartrs->num_rows;

                    if($cn == 0){

                        ?>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptycard"></div>
                            <div class="col-12 text-center">
                                <label class="fw-bolder text-dark form-label fs-1">You have no items in your
                                    basket</label>
                            </div>
                            <div class="col-12 offset-0 offset-lg-4 col-lg-4 d-grid mb-4">
                                <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                            </div>
                        </div>
                    </div>

                    <?php

                    }else{

                        ?>

                    <div class="col-12 col-lg-9">
                        <div class="row">

                            <?php
                            
                            for($i = 0; $i < $cn ; $i++){
                                $cr = $cartrs->fetch_assoc();

                                $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$cr["product_id"]."'; ");
                                $pr = $productrs->fetch_assoc();

                                $total = $total + ($pr["price"]*$cr["qty"]);

                                $addresrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'; ");
                                $ar = $addresrs->fetch_assoc();
                                $cityid = $ar["city_id"];

                                $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='".$cityid."'; ");
                                $dr = $districtrs->fetch_assoc();
                                $districtid = $dr["district_id"];

                                $ship = "0";

                                if($districtid == "1"){
                                    $ship = $pr["delivery_with_colombo"];
                                    
                                    $shipping = $shipping + $pr["delivery_with_colombo"];
                                }else{
                                    $ship = $pr["delivery_out_colombo"];

                                    $shipping = $shipping + $pr["delivery_out_colombo"];
                                }

                                // echo $total;
                                // echo "<br/>";
                                // echo $shipping;

                                $sellers = Database::Search("SELECT * FROM `user` WHERE `email`='".$pr["user_email"]."'; ");
                                $sn = $sellers->fetch_assoc();

                                ?>

                            <div class="card mb-3 col-12">
                                <div class="row g-0">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-black-50 fw-bold fs-5">Seller :</span>
                                                &nbsp;<span
                                                    class="text-dark fw-bold fs-5"><?php echo $sn["fname"]." ".$sn["lname"]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <?php
                                        
                                        $images = Database::search("SELECT * FROM `images` WHERE `product_id`='".$cr["product_id"]."'; ");
                                        $in = $images->num_rows;
                                        for($x=0;$x<$in;$x++){
                                            $ir = $images->fetch_assoc();
                                            $arr[$x] = $ir["code"];
                                        }

                                        ?>
                                    <div class="col-md-4">
                                        <img src="<?php echo $arr[0]; ?>" width="200px" class="img-fluid rounded-start d-inline-block"
                                            tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="<?php echo $pr["description"]; ?>" title="<?php echo $pr["title"]; ?>"/>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h3 class="card-title text-dark fw-bold"><?php echo $pr["title"]; ?></h3>
                                            <?php
                                            
                                            $color = Database::search("SELECT * FROM `color` WHERE `id` IN(SELECT `color_id` FROM `product` WHERE `id`='".$pr["id"]."'); ");
                                            $colorr = $color->fetch_assoc();

                                            ?>
                                            <span class="fw-bold text-black-50">Colour :
                                                <?php echo $colorr["name"] ;?></span>&nbsp; |
                                            <?php
                                            
                                            $condition = Database::search("SELECT * FROM `condition` WHERE `id` IN(SELECT `condition_id` FROM `product` WHERE `id`='".$pr["id"]."'); ");
                                            $conr = $condition->fetch_assoc();
                                            
                                            ?>
                                            &nbsp;<span class="fw-bold text-black-50">Condition :
                                                <?php echo $conr["name"]; ?></span><br />
                                            <span class="text-black-50 fs-5">Price :</span>&nbsp
                                            <span
                                                class="fw-bold text-dark">Rs.<?php echo $pr["price"]; ?>.00</span><br />
                                            <br />
                                            <span class="text-black-50 fw-bold fs-5">Quantity :</span>
                                            <input type="text"
                                                class="border border-2 border-secondary fs-4 rounded px-3 cardquantitiytext"
                                                value="<?php echo $cr["qty"]; ?>" /><br />
                                            <span class="text-black-50 fw-bold fs-5">Delivery fee :</span>&nbsp
                                            <span class="fw-bold text-dark">Rs.<?php echo $ship; ?>.00</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <div class="card-body d-grid">
                                            <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                            <a class="btn btn-outline-danger mb-2"
                                                onclick="deletecart(<?php echo $cr['id']; ?>);">Remove</a>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-black-50 fw-bold fs-5">Requested Total<i
                                                        class="bi bi-info-circle"></i></span>
                                                <span class="text-black-50 fw-bold fs-5 float-end">
                                                    Rs.<?php echo ($pr["price"] * $cr["qty"]) + $shipping ; ?>.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <?php

                    }

                    ?>

                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fs-3 fw-bold text-dark">Summury</label>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-6">
                                <span class="fs-6 fw-bold text-dark">Items (<?php echo $cn; ?>)</span>
                            </div>
                            <div class="col-6">
                                <span class="fs-6 text-end fw-bold text-dark">Rs.<?php echo $total; ?>.00</span>
                            </div>
                            <div class="col-6 mt-2">
                                <span class="fs-6 fw-bold text-dark">Shipping </span>
                            </div>
                            <div class="col-6 mt-2">
                                <span class="fs-6 text-end fw-bold text-dark">Rs.<?php echo $shipping; ?>.00</span>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-6 mt-2">
                                <span class="fs-4 text-end fw-bolder text-dark">Total</span>
                            </div>
                            <div class="col-6 mt-2">
                                <span
                                    class="fs-4 text-end fw-bolder text-dark">Rs.<?php echo $total + $shipping; ?>.00</span>
                            </div>
                            <div class="col-12 d-grid mt-3 mb-3">
                                <a href="#" class="btn btn-primary">CHECKOUT</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php

            }

             ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    </script>
</body>

</html>

<?php

}else{

    ?>

<script>
window.location = "index.php";
</script>

<?php
}

?>