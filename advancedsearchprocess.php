<?php

require "connection.php";

if (isset($_POST["k"])) {

    $k = $_POST["k"];
    $c = $_POST["c"];
    $b = $_POST["b"];
    $m = $_POST["m"];
    $con = $_POST["con"];
    $clr = $_POST["clr"];
    $pf = $_POST["pf"];
    $pt = $_POST["pt"];

if (!empty($k) && empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {
        
        $textsearch = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%".$k."%' LIMIT 6; ");
        $n = $textsearch->num_rows;
    
        if($n >= 1){
    
            for($i = 0; $i < $n; $i++){
    
                $row = $textsearch->fetch_assoc();
    
                $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."'; ");
                $n1 = $img->num_rows;
                $row1 = $img->fetch_assoc();
    
                ?>
    
                <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                    <img src="<?php echo $row1["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;"><?php echo $row["title"];?>
                            <span class="badge bg-info">New</span>
                        </h5>
                        <span class="card-text text-primary">Rs.<?php echo $row["price"];?></span>
                        <br />
                        <?php
                        if((int)$row["qty"] > 0){
                        ?>
                        <span class="card-text text-warning">In Stock</span>
                        <br />
                        <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row['id']; ?>">
                        <a href="<?php echo "singleproductview.php?id=".($row['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                        <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                            Cart&nbsp;&nbsp;</a>
                        <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row['id']; ?>);"><i
                                class="bi bi-suit-heart-fill"></i></a>
                        <?php
                        }else{
                        ?>
                        <span class="card-text text-warning">out of stock</span>
                        <br />
                        <input type="number" value="1" class="form-control mb-1" disabled>
                        <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                        <a class="btn btn-danger d-block mt-1 disabled" >Add to Cart</a>
                        <?php
                        }
    
                        ?>
                    </div>
                </div>
    
            <?php
                    
    
            }

}else{
        ?>
        <div class="col-12 mt-5 mb-5">
            <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
        </div>
        <?php
    }

}else if (!empty($c) && !empty($b) && !empty($m) && empty($k) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {
           
  
        $bandm = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='".$m."' AND `brand_id`='".$b."' ");
        $badn = $bandm->num_rows;

        if($badn >= 1){

            $brbr = $bandm->fetch_assoc();
                     
        $catr = Database::search("SELECT * FROM `product` WHERE `category_id`='".$c."' AND `model_has_brand_id`='".$brbr["id"]."'; ");
        $cr = $catr->num_rows;
    
        if($cr >= 1){
    
            for($i = 0; $i < $cr; $i++){
    
                $row = $catr->fetch_assoc();
    
                $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."'; ");
                $n1 = $img->num_rows;
                $row1 = $img->fetch_assoc();
    
                ?>
    
                <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                    <img src="<?php echo $row1["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;"><?php echo $row["title"];?>
                            <span class="badge bg-info">New</span>
                        </h5>
                        <span class="card-text text-primary">Rs.<?php echo $row["price"];?></span>
                        <br />
                        <?php
                        if((int)$row["qty"] > 0){
                        ?>
                        <span class="card-text text-warning">In Stock</span>
                        <br />
                        <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row['id']; ?>">
                        <a href="<?php echo "singleproductview.php?id=".($row['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                        <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                            Cart&nbsp;&nbsp;</a>
                        <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row['id']; ?>);"><i
                                class="bi bi-suit-heart-fill"></i></a>
                        <?php
                        }else{
                        ?>
                        <span class="card-text text-warning">out of stock</span>
                        <br />
                        <input type="number" value="1" class="form-control mb-1" disabled>
                        <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                        <a class="btn btn-danger d-block mt-1 disabled" >Add to Cart</a>
                        <?php
                        }
    
                        ?>
                    </div>
                </div>
    
            <?php
                    
    
            }

        }else{

            ?>
            <div class="col-12 mt-5 mb-5">
                <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
            </div>
            <?php

        }

        }else{

            ?>
            <div class="col-12 mt-5 mb-5">
                <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
            </div>
            <?php

        }
        

} else if (!empty($con) && !empty($clr) && empty($c) && empty($b) && empty($m) && empty($k) && empty($pf) && empty($pt) ) {
   
            
    $conaclr = Database::search("SELECT * FROM `product` WHERE `condition_id`='".$con."' AND `color_id`='".$clr."' ; ");
    $n = $conaclr->num_rows;

    if($n >= 1){

        for($i = 0; $i < $n; $i++){

            $row = $conaclr->fetch_assoc();

            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."'; ");
            $n1 = $img->num_rows;
            $row1 = $img->fetch_assoc();

            ?>

            <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                <img src="<?php echo $row1["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;"><?php echo $row["title"];?>
                        <span class="badge bg-info">New</span>
                    </h5>
                    <span class="card-text text-primary">Rs.<?php echo $row["price"];?></span>
                    <br />
                    <?php
                    if((int)$row["qty"] > 0){
                    ?>
                    <span class="card-text text-warning">In Stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row['id']; ?>">
                    <a href="<?php echo "singleproductview.php?id=".($row['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                    <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                        Cart&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row['id']; ?>);"><i
                            class="bi bi-suit-heart-fill"></i></a>
                    <?php
                    }else{
                    ?>
                    <span class="card-text text-warning">out of stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" disabled>
                    <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                    <a class="btn btn-danger d-block mt-1 disabled" >Add to Cart</a>
                    <?php
                    }

                    ?>
                </div>
            </div>

        <?php
                

        }
    
    }else{

        ?>
        <div class="col-12 mt-5 mb-5">
            <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
        </div>
        <?php
    

    }
        

} elseif (!empty($pf) && !empty($pt) && empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && empty($k) ) {

    $price = Database::search("SELECT * FROM `product` WHERE `price` BETWEEN '".$pf."' AND '".$pt."' ; ");
    $n = $price->num_rows;

    if($n >= 1){

        for($i = 0; $i < $n; $i++){

            $row = $price->fetch_assoc();

            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."'; ");
            $n1 = $img->num_rows;
            $row1 = $img->fetch_assoc();

            ?>

            <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                <img src="<?php echo $row1["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;"><?php echo $row["title"];?>
                        <span class="badge bg-info">New</span>
                    </h5>
                    <span class="card-text text-primary">Rs.<?php echo $row["price"];?></span>
                    <br />
                    <?php
                    if((int)$row["qty"] > 0){
                    ?>
                    <span class="card-text text-warning">In Stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row['id']; ?>">
                    <a href="<?php echo "singleproductview.php?id=".($row['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                    <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                        Cart&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row['id']; ?>);"><i
                            class="bi bi-suit-heart-fill"></i></a>
                    <?php
                    }else{
                    ?>
                    <span class="card-text text-warning">out of stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" disabled>
                    <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                    <a class="btn btn-danger d-block mt-1 disabled" >Add to Cart</a>
                    <?php
                    }

                    ?>
                </div>
            </div>

        <?php
                

        }
    
    }else{

        ?>
        <div class="col-12 mt-5 mb-5">
            <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
        </div>
        <?php
    

    }
        
            


}else if(!empty($k) && !empty($c) && !empty($b) && !empty($m) && !empty($con) && !empty($clr) && !empty($pf) && !empty($pt) ){

    $bandm = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='".$m."' AND `brand_id`='".$b."' ");
    $badn = $bandm->num_rows;

    if($badn >= 1){

        $brbr = $bandm->fetch_assoc();

        $all = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%".$k."%' AND `model_has_brand_id`='".$brbr["id"]."' AND 
        `category_id`='".$c."' AND `condition_id`='".$con."' AND `color_id`='".$clr."' AND `price` BETWEEN '".$pf."' AND '".$pt."' ; ");
    $n = $all->num_rows;

    if($n >= 1){

        for($i = 0; $i < $n; $i++){

            $row = $all->fetch_assoc();

            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."'; ");
            $n1 = $img->num_rows;
            $row1 = $img->fetch_assoc();

            ?>

            <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                <img src="<?php echo $row1["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;"><?php echo $row["title"];?>
                        <span class="badge bg-info">New</span>
                    </h5>
                    <span class="card-text text-primary">Rs.<?php echo $row["price"];?></span>
                    <br />
                    <?php
                    if((int)$row["qty"] > 0){
                    ?>
                    <span class="card-text text-warning">In Stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row['id']; ?>">
                    <a href="<?php echo "singleproductview.php?id=".($row['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                    <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                        Cart&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row['id']; ?>);"><i
                            class="bi bi-suit-heart-fill"></i></a>
                    <?php
                    }else{
                    ?>
                    <span class="card-text text-warning">out of stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" disabled>
                    <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                    <a class="btn btn-danger d-block mt-1 disabled" >Add to Cart</a>
                    <?php
                    }

                    ?>
                </div>
            </div>

        <?php
                

        }
    
    }else{

        ?>
        <div class="col-12 mt-5 mb-5">
            <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
        </div>
        <?php
    

    }

    }else{

        ?>
        <div class="col-12 mt-5 mb-5">
            <span class="mt-5 mb-5 text-black-50 fw-bold fs-4">No Result</span>
        </div>
        <?php

    }

}

}


?>