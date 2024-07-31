    <?php

    session_start();

    require "connection.php";

    if(isset($_SESSION["u"])){

        $user = $_SESSION["u"];

        $pageno;

        ?>

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>eShop|My Product</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- head -->

                <div class="bg-primary col-12">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1">
                                    <?php
                                    
                                    $profileimg = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$user["email"]."';");   
                                    $pn = $profileimg->num_rows;
                                    $pr = $profileimg->fetch_assoc();

                                    if($pn == 1){
                                        ?>

                                    <img class="rounded-circle" width="90px" height="90px"
                                        src="<?php echo $pr["code"]; ?>" />

                                    <?php
                                    }else{
                                        ?>

                                    <img class="rounded-circle" width="90px" height="90px"
                                        src="resources/demoProfileImg.jpg" />

                                    <?php
                                    }

                                    ?>

                                </div>

                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span
                                                class="fw-bold"><?php echo $user["fname"]."&nbsp". $user["lname"]; ?></span>
                                        </div>
                                    </div>
                                    <div class="text-white"><?php echo $user["email"]; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-5 mt-lg-3 ">
                                    <h1 class="text-white offset-6 offset-lg-2 fw-bold">My Product</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- head -->

                <div class="col-12">
                    <div class="row">

                        <!-- Sorting -->

                        <div class="col-12 col-lg-2 mx-lg-3 my-3 mb-lg-5 rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" placeholder="search..." id="s" class="form-control" />
                                                </div>
                                                <div class="col-1">
                                                    <label class="bi bi-search fs-3 form-label" for=""></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-lg-2">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="n">
                                                <label class="form-check-label" for="n">
                                                    Never To Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to Never
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-lg-4">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="q"
                                                    id="l">
                                                <label class="form-check-label" for="l">
                                                    Low To High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="q"
                                                    id="h">
                                                <label class="form-check-label" for="h">
                                                    High To Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-lg-4">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="c"
                                                    id="b">
                                                <label class="form-check-label" for="b">
                                                    Brand new
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="c"
                                                    id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-0 mt-3 offset-lg-1 col-11 mb-3  col-lg-8">
                                            <div class="row">
                                                <button class="col-12 d-grid fw-bold mb-3 btn btn-success" onclick="addfilters();">Search</button>
                                                <button class="col-12 d-grid btn btn-primary ">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sorting -->

                        <!-- product -->

                        <div class="col-lg-9 col-12 mt-3 mb-5 bg-white rounded border border-primary ">
                            <div class="row">
                                <div class="offset-1 col-10 text-center">
                                    <div class="row" id="pr">

                                        <?php

                                    if(isset($_GET["page"])){
                                        $pageno = $_GET["page"];
                                    }else{
                                        
                                        $pageno = 1;

                                    }

                                    $product = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."'; ");
                                    $d = $product->num_rows;
                                    $row = $product->fetch_assoc();

                                    $result_per_page = 6;

                                    $number_of_pages = ceil($d/$result_per_page);

                                    // echo $d;
                                    // echo "<br/>";
                                    // echo $number_of_pages;

                                    $page_first_result = ((int)$pageno - 1 ) * $result_per_page;

                                    $selectreds = Database::search("SELECT * FROM `product` WHERE `user_email`='".$user["email"]."'
                                    LIMIT ".$result_per_page." OFFSET ".$page_first_result."; ");

                                    $srn = $selectreds->num_rows;

                                        while($srow = $selectreds->fetch_assoc()){

                                            ?>

                                        <div class="card mb-3 col-12 col-lg-6 mt-3">
                                            <div class="row g-0">

                                                <?php
                                            
                                            $pimge = Database::search("SELECT * FROM `images` WHERE `product_id`='".$srow["id"]."';");
                                            $pir = $pimge->fetch_assoc();

                                            ?>
                                                <div class="col-md-3 mt-5">
                                                    <img src="<?php echo $pir["code"]; ?>"
                                                        class="img-fluid rounded-start" />
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?>
                                                        </h5>
                                                        <span class="card-text fw-bold text-primary">Rs.
                                                            <?php echo $srow["price"]; ?></span>
                                                        <br />
                                                        <span
                                                            class="card-text fw-bold text-success"><?php echo $srow["qty"]; ?>
                                                            Items
                                                            Left</span>
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" chcked id="deactive"
                                                                onchange="changestatus(<?php echo $srow['id']; ?>);"
                                                                class="form-check-input" <?php
                                                                if($srow["status_id"] == 2){
                                                                    echo "checked";
                                                                }
                                                                ?> />
                                                            <label for="deactive" id="clabel<?php echo $srow['id']; ?>"
                                                                class="form-check-label text-info fw-bold">Make
                                                                your
                                                                product
                                                                <?php

                                                                if($srow["status_id"] == 2){
                                                                    echo "Active";
                                                                }else{
                                                                    echo "Deactive";
                                                                }

                                                                 $pid = $srow["id"];
                                                        
                                                                ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-12 mt-lg-2">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6">
                                                                    <a class="btn btn-success d-grid"
                                                                      onclick="sendid(<?php echo $pid; ?>);">Update</a>
                                                                </div>
                                                                <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                    <a class="btn btn-danger d-grid"
                                                                        onclick="deletemodel(<?php echo $srow['id']; ?>);">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="delmodel<?php echo $srow['id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold text-danger"
                                                            id="exampleModalLabel">Warning ! </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are You Sure You Want To Delete This Product.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" onclick="deleteproduct(<?php echo $srow['id']; ?>);">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->

                                        <?php

                                        }

                                    ?>

                                    </div>
                                </div>

                                <!-- pagination -->

                                <div class="col-12 mb-3 mt-2">
                                    <div class="row">
                                        <div class="offset-4 col-4 d-flex justify-content-center">
                                            <div class="pagination">
                                                <a href="<?php 
                                                
                                                if($pageno <= 1){

                                                    echo "#";
                                                }else{
                                                    echo "?page=".($pageno-1);
                                                }
                                                
                                                ?>">&laquo;</a>

                                                <?php
                                                
                                                for($page = 1; $page <= $number_of_pages; $page++){

                                                if($page == $pageno){

                                                ?>
                                                <a href="<?php echo "?page=" . ($page); ?>"
                                                    class="ms-1 active"><?php echo $page; ?></a>
                                                <?php

                                                }else{

                                                ?>
                                                <a href="<?php echo "?page=" . ($page); ?>"
                                                    class="ms-1"><?php echo $page; ?></a>
                                                <?php

                                                }

                                                }

                                                ?>

                                                <a href="<?php
                                                
                                                if($pageno >= $number_of_pages){

                                                    echo "#";
                                                }else{

                                                    echo "?page=".($pageno+1);
                                                }

                                                ?>">&raquo;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- pagination -->

                            </div>
                        </div>
                    </div>
                </div>


                <!-- product -->

                <?php
        
                require "footer.php";

                ?>

            </div>
        </div>



        <script src="script.js"></script>
        <script src="bootstrap.js"></script>

    </body>

    </html>

    <?php

    }else{
        ?>
    <script>
alert("You Have To Signin Or SignUp First");
window.location = "index.php";
    </script>
    <?php
    }

    ?>