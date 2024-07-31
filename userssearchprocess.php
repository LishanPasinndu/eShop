<?php

session_start();

require "connection.php";

if(isset($_POST["t"])){

    $text = $_POST["t"];

    if(empty($text)){

        echo "Please enter a name to search";

    }else{

        $users = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%".$text."%' ; ");
        $un = $users->num_rows;

        for($x=0;$x<$un;$x++){

            $row = $users->fetch_assoc();

            ?>

<div class="col-12  mb-2">
        <div class="row" id="olduser">

            <div class="col-8 col-lg-11" onclick="viewmsgmodal();">
                <div class="row">

                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-5 fw-bold text-white">1</span>
                    </div>

                    <?php
            
            $ir = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$row["email"]."'; ");
            $in = $ir->num_rows;
            $iir =  $ir->fetch_assoc();
        
            if($in > 0){

                ?>

                    <div
                        class="col-4 col-lg-2 bg-light text-center justify-content-center d-lg-block pt-2 pb-2">
                        <img src="<?php echo $iir["code"]; ?>" class="img-fluid"
                            style="height: 50px;border-radius: 50%;">
                    </div>

                    <?php

            }else{

            ?>

                    <div
                        class="col-4 col-lg-2  bg-light text-center justify-content-center  d-lg-block pt-2 pb-2">
                        <img src="resources/demoProfileImg.jpg" style="height: 50px;">
                    </div>

                    <?php

            }

            ?>

                    <div class="col-lg-2 col-6 bg-primary d-lg-block pt-2 pb-2">
                        <span
                            class="fs-5 fw-bold text-white"><?php echo $row["fname"]." ".$row["lname"]; ?></span>
                    </div>

                    <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                        <span class="fs-5 fw-bold text-black"><?php echo $row["email"]; ?></span>
                    </div>

                    <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                        <span class="fs-5 fw-bold text-white"><?php echo $row["mobile"]; ?></span>
                    </div>

                    <div class="col-3 bg-light d-none d-lg-block pt-2 pb-2">
                        <span class="fs-5 fw-bold text-black"><?php 
                        
                        $rd = $row["register_date"];
                        $split = explode(" ", $rd);
                        echo $split[0];

                        ?></span>
                    </div>

                </div>
            </div>


            <?php
                    
            $s = $row["status"];

            if($s == "1"){

            ?>

            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                <button id="blockbtn<?php  echo $row["email"]; ?>" class="btn btn-danger"
                    onclick="blockusers('<?php echo $row['email']; ?>');">Block</button>
            </div>

            <?php

            }else{

            ?>

            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                <button class="btn btn-danger" onclick="blockusers('<?php echo $row['email']; ?>');"><i
                        class="bi bi-exclamation-circle"></i> Unblock</button>
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