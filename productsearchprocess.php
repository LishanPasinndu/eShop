<?php

session_start();

require "connection.php";

if(isset($_POST["t"])){

    $text = $_POST["t"];

    if(empty($text)){

        echo "Please enter a product name to search";

    }else{

        $users = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%".$text."%' ; ");
        $pn = $users->num_rows;

        for($y=0;$y<$pn;$y++){

            
        $row = $users->fetch_assoc();

            ?>

<div class="col-12  mb-2">
    <div class="row">

        <div class="col-8 col-lg-11" onclick="singlemodal(<?php echo $row['id']; ?>);">
            <div class="row">

                <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                    <span class="fs-5 fw-bold text-white">1</span>
                </div>

                <div class="col-lg-2 col-10  bg-light  d-lg-block pt-2 pb-2">
                    <span class="fs-5 fw-bold "><?php echo $row["title"]; ?></span>
                </div>

                <?php
                            
                            $sellers = Database::search("SELECT * FROM `user` WHERE `email`='".$row["user_email"]."' ");
                            $selrs = $sellers->fetch_assoc();

                            ?>

                <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                    <span class="fs-5 fw-bold text-white"><?php echo $selrs["fname"]." ".$selrs["lname"]; ?></span>
                </div>

                <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                    <span class="fs-5 fw-bold text-black"><?php echo $row["price"]; ?></span>
                </div>

                <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                    <span class="fs-5 fw-bold text-white"><?php echo $row["qty"]; ?></span>
                </div>

                <div class="col-3 bg-light d-none d-lg-block pt-2 pb-2">
                    <span class="fs-5 fw-bold text-black"><?php 
                                
                                $rd = $row["datetime_added"];
                                $split = explode(" ", $rd);
                                echo $split[0];

                                ?></span>
                </div>

            </div>
        </div>


        <?php
                            
                    $s = $row["status_id"];

                    if($s == "1"){

                    ?>

        <div class="col-4 col-lg-1 bg-white pt-1 pb-1 d-grid">
            <button id="blockbtn1<?php  echo $row["id"]; ?>" class="btn btn-danger "
                onclick="blockproducts('<?php echo $row['id']; ?>');">Block</button>
        </div>

        <?php

                    }else{

                    ?>

        <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
            <button class="btn btn-success" onclick="blockproducts('<?php echo $row['id']; ?>');">Unblock</button>
        </div>

        <?php

                    }

                    ?>


    </div>
</div>

<?php

        }

    }

}


?>