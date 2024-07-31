<?php

session_start();

require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $product = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'; ");
    $pn = $product->num_rows;

    if($pn == 1){

        $pd = $product->fetch_assoc();

    ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Single product view</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";
            ?>

            <div class="col-12 mt-0 singleproduct">
                <div class="row">

                    <div class="bg-white" style="padding:11px;">
                        <div class="row">
                            <div class="col-lg-2 order-lg-1 order-2">
                                <ul>

                                    <?php

                                $images = Database::search("SELECT * FROM `images` WHERE `product_id`='".$pid."'; ");
                                $in = $images->num_rows;

                                $img1;

                                if(!empty($in)){

                                    for($x = 0; $x < $in; $x++ ){
                                        $ir = $images->fetch_assoc();

                                        $img1 = $ir["code"];

                                        ?>

                                    <li
                                        class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                        <img src="<?php echo $ir['code']; ?>" height="150px" class="mt-1 mb-1"
                                            id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                    </li>

                                    <?php

                                    }

                                }else{
                                   ?>
                                    <li
                                        class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                        <img src="resources/empty.svg" height="150px" class="mt-1 mb-1"
                                            alt="No Photo uploaded" />
                                    </li>
                                    <li
                                        class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                        <img src="resources/empty.svg" height="150px" class="mt-1 mb-1"
                                            alt="No Photo uploaded" />
                                    </li>
                                    <li
                                        class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                        <img src="resources/empty.svg" height="150px" class="mt-1 mb-1"
                                            alt="No Photo uploaded" />
                                    </li>
                                    <?php
                                }

                                ?>
                                </ul>
                            </div>
                            <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                <div class="align-items-center border border-1 border-secondary p-3">
                                    <div style="background-image: url('<?php echo $img1; ?>'); background-repeat:no-repeat; background-size:contain; height:445px;"
                                        id="mainimg"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 order-3">
                                <div class="row">
                                    <div class="col-12 ">
                                        <nav>
                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                <li class="breadcrumb-item">
                                                    <a href="#">Home</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="#">Products</a>
                                                </li>
                                                <li class="breadcrumb-item active">
                                                    <a href="#" class="text-black-50 text-decoration-none">Single
                                                        view</a>
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                    </div>

                                    <div class="col-12">
                                        <span class="badge badge-success">
                                            <i class="fa fa-star mt-1 text-warning"></i>
                                            <label class="text-dark fs-6">4.5 star</label>
                                            <label class="text-black-50 fs-6">| 35 Ratings & 45 viewers</label>
                                        </span>
                                    </div>

                                    <div class="col-12">
                                        <label class="fw-bold mt-1 fs-4">Rs.<?php echo $pd["price"]; ?></label>
                                        <label class="fw-bold mt-1 fs-6 text-danger"> <del> Rs. <?php $a=$pd["price"];
                                        
                                        $new = ($a/100)*5;
                                        $nv = $a + $new;
                                        echo $nv;
                                        
                                        ?>
                                            </del></label>
                                    </div>

                                    <hr class="hrbreak1" />

                                    <div class="col-12">
                                        <label class="text-primary fs-5"><b>Warrenty : </b>6 months
                                            warrenty</label><br />
                                        <label class="text-primary fs-5"><b>Return policy : </b>1 months return
                                            policy</label><br />
                                        <label class="text-primary fs-5"><b>In stock : </b><?php echo $pd["qty"]; ?>
                                            Items left</label>
                                    </div>

                                    <hr class="hrbreak1" />

                                    <div class="col-12">
                                        <label class="text-dark fs-4 fw-bold">Seller Information</label><br />
                                        <?php
                                        
                                        $users = Database::search("SELECT * FROM `user` WHERE `email`='".$pd["user_email"]."'; ");
                                        $user = $users->fetch_assoc();

                                        ?>
                                        <label class="text-success fs-6">Seller's Name
                                            :-<?php echo $user["fname"]." ".$user["lname"]; ?></label><br />
                                        <label class="text-success fs-6">Seller's email :-
                                            <?php echo $user["email"]; ?></label><br />
                                        <label class="text-success fs-6">Seller's mobile :-
                                            <?php echo $user["mobile"]; ?></label>
                                    </div>

                                    <hr class="hrbreak1" />

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-9 col-12 rounded border border-1 border-success mt-1">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-lg-1">
                                                        <img src="resources/singleview/pricetag.png" />
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                        <label class=" text-black-50">Stand a chance to get instant 5%
                                                            discount by using
                                                            Visa.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6" style="margin-top: 15px;">
                                                <label class="fs-6 mt-1 fw-bold">Color options</label>
                                                <?php
                                            

                                                ?>
                                                <button class="btn btn-primary btn-sm">Gold</button>
                                                <button class="btn btn-primary btn-sm">Black</button>
                                                <button class="btn btn-primary btn-sm">Blue</button>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="hrbreak1" />

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div
                                                        class="border border-1 border-secondary rounded overflow-hidden float-start productqty">
                                                        <span class="mt-2">Qty :</span>
                                                        <input id="qtyinput"
                                                            class="mt-2 border-0 fs-6 fw-bold text-start" type="number"
                                                            value="1" />
                                                        <div class="qtybuttons position-absolute">
                                                            <div
                                                                class="d-flex flex-column align-items-center border border-1 border-secondary qtyinc">
                                                                <i class="fas fa-chevron-up"
                                                                    onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                                            </div>
                                                            <div
                                                                class="d-flex flex-column align-items-center border border-1 border-secondary qtydec">
                                                                <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-4 col-lg-2">
                                                        <button class="btn btn-primary d-grid">Add cart</button>
                                                    </div>
                                                    <div class="col-4 col-lg-2">
                                                        <button class="btn btn-success d-grid" type="submit"
                                                            onclick="paynow(<?php echo $pid; ?>);"
                                                            id="payhere-payment">Buy now</button>
                                                    </div>
                                                    <div class="col-4 col-lg-2">
                                                        <i class="fas fa-heart mt-3 fs-4 text-black-50"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div
                            class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Related Items</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white mb-3">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="row p-2">

                                    <?php

                                    $br = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$pd["model_has_brand_id"]."'; ");
                                    $brs = $br->fetch_assoc();
                                
                                $brandrs = Database::search("SELECT * FROM `product` LEFT JOIN `model_has_brand` 
                                ON `product`.model_has_brand_id=`model_has_brand`.id WHERE `brand_id`='".$brs["brand_id"]."' LIMIT 4;  ");

                                $bds = $brandrs->num_rows;
                                for($g = 0;$g < $bds; $g++){
                                    $bdf = $brandrs->fetch_assoc();
                                    

                                    ?>

                                    <div class="card" style="width:18rem;">
                                        <?php
                                    
                                    $imgp = Database::search("SELECT * FROM `images` WHERE `product_id`='".$bdf["id"]."'; ");
                                    $imgpr = $imgp->fetch_assoc();


                                    ?>
                                        <img src="<?php echo $imgpr["code"]; ?>" />
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $bdf["title"]; ?></h5>
                                            <p class="card-text">Rs. <?php echo $bdf["price"]; ?></p>
                                            <a href="#" class="btn btn-primary">add to cart</a>
                                            <button class="btn btn-success">Buy Now</button>
                                            <a href="#" class="me-1 mt-1 fs-5"> <i
                                                    class="fas fa-heart mt-1 text-black-50"></i> </a>
                                        </div>
                                    </div>

                                    <?php

                                }

                                ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div
                            class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Product Detailes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white mb-3">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fs-5 fw-bold">
                                            Brand
                                        </label>
                                    </div>
                                    <div class="col-10">
                                        <label class="form-label">
                                            Apple
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fs-5 fw-bold">
                                            Model
                                        </label>
                                    </div>
                                    <div class="col-10">
                                        <label class="form-label">
                                            Iphone 12
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fs-5 fw-bold">
                                            Description
                                        </label>
                                    </div>
                                    <div class="col-10">
                                        <textarea class="form-control" readonly name="" id="" cols="60"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <br /> <br />
                    </div>

                    <div class="col-12 bg-white">
                        <div
                            class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Chat with Seller</span>
                            </div>
                        </div>
                        <div class="col-6 offset-3 d-grid mt-2 mb-3">
                            <a href="massages.php?e=<?php echo $user["email"]; ?>" class="btn btn-primary">Chat</a>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-12 bg-white">
                <div
                    class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                    <div class="col-md-6">
                        <span class="fs-3 fw-bold">Feedbacks...</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php
                
                $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='".$pd["id"]."'; ");
                $fn = $feedbackrs->num_rows;

                if($fn == 0){
 
                    ?>

                    <div class="col-12">
                        <label class="form-label ">There are no feedback to view...</label>
                    </div>

                    <?php

                }else{

                    for($x=0;$x<$fn;$x++){

                        $fr = $feedbackrs->fetch_assoc();

                        $usersss = Database::search("SELECT * FROM `user` WHERE `email`='".$fr["user_email"]."'; ");
                        $ur = $usersss->fetch_assoc();
    
                        ?>

                    <div class="col-12 offset-lg-1 col-lg-4 border border-1 border-danger rounded">
                        <div class="row">
                            <div class="col-12">
                                <span
                                    class="fs-5 fw-bold text-primary "><?php echo $ur["fname"]." ".$ur["lname"]; ?></span>
                            </div>
                            <div class="col-12">
                                <span class="fs-5  text-dark "><?php echo $fr["feed"]; ?></span>
                            </div>
                            <div class="col-12 text-end">
                                <span class="fs-6 text-black-50  "><?php echo $fr["date"]; ?></span>
                            </div>
                        </div>
                    </div>

                    <?php
    
                    }

                }

                ?>

                </div>
            </div>

            <?php
            require "footer.php";
            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>

<?php

}

}
 
?>