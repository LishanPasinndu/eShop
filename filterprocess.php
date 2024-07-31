<?php

session_start();

$user = $_SESSION["u"];

require "connection.php";

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

if(!empty($search) && !empty($age) && empty($condition) && empty($qty)){

    if($age = 1){

        $prs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' 
        AND `title` LIKE '%".$search."%' ORDER BY `datetime_added` DESC ; ");
        $pns = $prs->num_rows;

        for($i = 0; $i < $pns; $i++){

            $row = $prs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

        

    }else if($age = 2){

        $prs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' 
        AND `title` LIKE '%".$search."%' ORDER BY `datetime_added` ASC ; ");
        $pns = $prs->num_rows;

        for($i = 0; $i < $pns; $i++){
            $row1 = $prs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row1["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row1["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row1["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row1["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row1['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row1["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row1['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row1["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row1["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row1['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row1['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

      
    }

}else if(!empty($search) && empty($condition) && empty($qty) && empty($age)){

    $product = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%'; ");
    $pn = $product->num_rows;
    
    for($x = 0; $x < $pn; $x++){
       

        $row2 =  $product->fetch_assoc();
         
        ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row2["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row2["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row2["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row2["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row2['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row2["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row2['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row2["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row2["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row2['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row2['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

    }

  

}else if(!empty($age) && !empty($search) && empty($condition) && empty($qty)){

    if($age == 1){

        $page = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%'
        ORDER BY `datetime_added` DESC ; ");
        $an = $page->num_rows;

        for($i = 0; $i < $an; $i++){

            $row3 = $page->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row3["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row3["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row3["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row3["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row3['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row3["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row3['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row3["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row3["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row3['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row3['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

      

    }else if($age == 2){

        $page = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%'
        ORDER BY `datetime_added` ASC ; ");
        $an = $page->num_rows;

        for($i = 0; $i < $an; $i++){
            $row4 = $page->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row4["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row4["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row4["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row4["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row4['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row4["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row4['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row4["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row4["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row4['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row4['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

      

    }

}else if(!empty($qty) && !empty($search) && empty($age) && empty($condition)){

    if($qty == 1){

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%'
        ORDER BY `qty` ASC ; ");
        $qtyn = $qtyrs->num_rows;

        for($i = 0; $i < $qtyn; $i++){
            $row5 = $qtyrs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row5["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row5["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row5["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row5["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row5['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row5["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row5['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row5["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row5["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row5['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row5['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

       

    }else if($qty == 2){

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%'
        ORDER BY `qty` DESC ; ");
        $qtyn = $qtyrs->num_rows;

        for($i = 0; $i < $qtyn; $i++){

            $row6 = $qtyrs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row6["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row6["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row6["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row6["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row6['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row6["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row6['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row6["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row6["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row6['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row6['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

    }

}else if(!empty($condition) && !empty($search) && empty($age) && empty($qty)){

    if($condition == 1){

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' 
        AND `title` LIKE '%".$search."%' AND `condition_id`='1'; ");
        $qtyn = $qtyrs->num_rows;

        for($i = 0; $i < $qtyn; $i++){
            $row5 = $qtyrs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row5["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row5["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row5["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row5["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row5['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row5["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row5['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row5["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row5["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row5['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row5['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

       

    }else if($condition == 2){

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' 
        AND `title` LIKE '%".$search."%' AND `condition_id`='2' ; ");
        $qtyn = $qtyrs->num_rows;

        for($i = 0; $i < $qtyn; $i++){

            $row6 = $qtyrs->fetch_assoc();

            ?>

                <div class="card mb-3 col-12 col-lg-6 mt-3">
                    <div class="row g-0">
                        <?php                            
                        $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$row6["id"]."';");
                        $pir = $pimge->fetch_assoc();
                        ?>
                        <div class="col-md-3 mt-5">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $row6["title"]; ?>
                                </h5>
                                <span class="card-text fw-bold text-primary">Rs.
                                    <?php echo $row6["price"]; ?></span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $row6["qty"]; ?>
                                    Items
                                    Left</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" chcked id="deactive" onchange="changestatus(<?php echo $row6['id']; ?>);"
                                        class="form-check-input" <?php
                                    if($row6["status_id"] == 2){
                                    echo "checked";
                                    }
                                    ?> />
                                    <label for="deactive" id="clabel<?php echo $row6['id']; ?>"
                                        class="form-check-label text-info fw-bold">Make
                                        your
                                        product
                                        <?php

                                    if($row6["status_id"] == 2){
                                    echo "Active";
                                    }else{
                                    echo "Deactive";
                                    }

                                    $pid = $row6["id"];
                                                                        
                                    ?>
                                    </label>
                                </div>
                                <div class="col-12 mt-lg-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-success d-grid" onclick="sendid(<?php echo $row6['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a class="btn btn-danger d-grid"
                                                onclick="deletemodel(<?php echo $row6['id']; ?>);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }

    }

}

?>