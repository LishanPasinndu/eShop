<?php

require "connection.php";

$text = $_GET["t"];
$select = $_GET["s"];


if($text != 0 && empty($select)){

    $textsearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%".$text."%' LIMIT 5; ");
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

    }

}else if($select != 0 && empty($text)){

    
    $category = Database::search("SELECT * FROM `product` WHERE `category_id`='".$select."'; ");
    $n = $category->num_rows;

    if($n >= 1){

        for($i = 0; $i < $n; $i++){

            $row2 = $category->fetch_assoc();

            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row2["id"]."'; ");
            $n1 = $img->num_rows;
            $row3 = $img->fetch_assoc();

            ?>

            <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                <img src="<?php echo $row3["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;"><?php echo $row2["title"];?>
                        <span class="badge bg-info">New</span>
                    </h5>
                    <span class="card-text text-primary">Rs.<?php echo $row2["price"];?></span>
                    <br />
                    <?php
                    if((int)$row2["qty"] > 0){
                    ?>
                    <span class="card-text text-warning">In Stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row2['id']; ?>">
                    <a href="<?php echo "singleproductview.php?id=".($row2['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                    <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row2['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                        Cart&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row2['id']; ?>);"><i
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

    }

}else if(!empty($text) && $select != 0){

    $candtext = Database::search("SELECT * FROM `product` WHERE `category_id`='".$select."' AND 
    `title` LIKE '%".$text."%'; ");
    $n = $candtext->num_rows;

    if($n >= 1){

        for($i = 0; $i < $n; $i++){

            $row2 = $candtext->fetch_assoc();

            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row2["id"]."'; ");
            $n1 = $img->num_rows;
            $row3 = $img->fetch_assoc();

            ?>

            <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                <img src="<?php echo $row3["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;"><?php echo $row2["title"];?>
                        <span class="badge bg-info">New</span>
                    </h5>
                    <span class="card-text text-primary">Rs.<?php echo $row2["price"];?></span>
                    <br />
                    <?php
                    if((int)$row2["qty"] > 0){
                    ?>
                    <span class="card-text text-warning">In Stock</span>
                    <br />
                    <input type="number" value="1" class="form-control mb-1" id="qtytext<?php echo $row2['id']; ?>">
                    <a href="<?php echo "singleproductview.php?id=".($row2['id']); ?>" class="btn btn-success d-block">Buy Now</a>
                    <a class="btn btn-danger  mt-1" onclick="addtocart(<?php echo $row2['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                        Cart&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary  mt-1" onclick="addtowatchlist(<?php echo $row2['id']; ?>);"><i
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

    }

}else{

    echo "nothing";

}

// echo $text;
// echo "<br/>";
// echo $select;

?>