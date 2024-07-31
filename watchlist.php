<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Watchlist</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gx-2 gy-3">

            <?php
    require "header.php";
    ?>

            <div class="col-12 border border-1 border-secondary rounded">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fs-1 fw-bolder">&nbsp;Watchlist &hearts;</label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hrbreak1" />
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Search in watchlist" />
                            </div>
                            <div class="col-12 col-lg-2 d-grid mb-3">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="hrbreak1" />
                    </div>
                    <div
                        class="mb-3 col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                            </ol>
                        </nav>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                            <a class="nav-link" href="#">My cart</a>
                            <a class="nav-link" href="#">Recently viwed</a>
                        </nav>
                    </div>

                    <?php
                    
                    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."'; ");
                    $wn = $watchlistrs->num_rows;

                    if($wn <= 0){

                        ?>

                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 emptview"></div>
                            <label class="form-label fs-1 mb-3 fw-bolder text-center">You have no items in your
                                watchlist</label>
                        </div>
                    </div>

                    <?php

                    }else{

                        ?>
                    <div class="col-12 col-lg-9">
                        <div class="row g-2">
                            <?php

                        for($i = 0; $i < $wn; $i++){
                            $wr = $watchlistrs->fetch_assoc();
                            $pid = $wr["product_id"];

                            $products = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'; ");
                            $pn = $products->num_rows;
                            if($pn == 1){
                                $pr = $products->fetch_assoc();
                                $proid = $pr["id"];

                            }
                            
                        ?>

                            <div class="card mb-3 mx-0 mx-lg-5 col-12">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <?php
                                        
                                        $images = Database::search("SELECT * FROM `images` WHERE `product_id`='".$wr["product_id"]."'; ");
                                        $in = $images->num_rows;
                                        for($x=0;$x<$in;$x++){
                                            $ir = $images->fetch_assoc();
                                            $arr[$x] = $ir["code"];
                                        }

                                        ?>
                                        <img src="<?php echo $arr[0]; ?>" width="200px" class="img-fluid rounded-start" />
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h3 class="card-title text-dark fw-bold"><?php echo $pr["title"]; ?></h3>
                                            <?php
                                            
                                            $color = Database::search("SELECT * FROM `color` WHERE `id` IN(SELECT `color_id` FROM `product` WHERE `id`='".$proid."'); ");
                                            $colorr = $color->fetch_assoc();

                                            ?>
                                            <span class="fw-bold text-black-50">Colour : <?php echo $colorr["name"]; ?></span>&nbsp; |
                                            <?php
                                            
                                            $condition = Database::search("SELECT * FROM `condition` WHERE `id` IN(SELECT `condition_id` FROM `product` WHERE `id`='".$proid."'); ");
                                            $conr = $condition->fetch_assoc();
                                            
                                            ?>
                                            &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $conr["name"]; ?></span><br />
                                            <span class="text-black-50 fs-5">Price :</span>&nbsp
                                            <span class="fw-bold text-dark"><?php echo $pr["price"]; ?> .00</span><br />
                                            <span class="text-black-50 fw-bold fs-5">Seller :-</span><br />
                                            <?php
                                            
                                            $userr = Database::search("SELECT * FROM `user` WHERE `email` IN(SELECT `user_email` FROM `product` WHERE `id`='".$proid."'); ");
                                            $seller = $userr->fetch_assoc();
                                            
                                            ?>
                                            <span class="fw-bold text-dark"><?php echo $seller["fname"]." ".$seller["lname"]; ?></span><br />
                                            <span class="fw-bold text-dark"><?php echo $seller["email"]; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <div class="card-body d-grid">
                                            <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                            <a href="#" class="btn btn-outline-secondary mb-2">Add Cart</a>
                                            <a onclick="removewatchlist(<?php echo $wr['id']; ?>);" class="btn btn-outline-danger mb-2">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

                     }

                     ?>
                        </div>
                    </div>
                    <?php

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