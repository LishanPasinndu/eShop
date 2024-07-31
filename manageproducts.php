<?php

session_start();
require "connection.php";
$pageno;

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | mange products</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage Products</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 mt-3 mb-3 offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-9">
                                <input id="tt" type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" onclick="searchproducts();">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 mt-3 mb-2">
                <div class="row">

                    <div class="col-8 col-lg-11">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                <span class="fs-4 fw-bold text-white">#</span>
                            </div>

                            <div class="col-lg-2 col-10 bg-light  d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-black">Product Title</span>
                            </div>

                            <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-white">Seller Name</span>
                            </div>

                            <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-black">Price</span>
                            </div>

                            <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-white">Qty</span>
                            </div>

                            <div class="col-3 bg-light d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-black">Registerd date</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-4 bg-light"></div>

                </div>
            </div>

            <div class="col-12  mb-2">
                <div class="row" id="newproduct">
                </div>
            </div>


            <div class="col-12">
                <div class="row" id="oldproduct">


                    <?php
              
                if(isset($_GET["page"])){
                    $pageno = $_GET["page"];
                }else{
                    
                    $pageno = 1;

                }

                $users = Database::search("SELECT * FROM `product`; ");
                $d = $users->num_rows;
                $row = $users->fetch_assoc();

                $result_per_page = 10;

                $number_of_pages = ceil($d/$result_per_page);

                $page_first_result = ((int)$pageno - 1 ) * $result_per_page;

                $selectreds = Database::search("SELECT * FROM `product`
                LIMIT ".$result_per_page." OFFSET ".$page_first_result."; ");

                $srn = $selectreds->num_rows;

                $c = "0";

                    while($srow = $selectreds->fetch_assoc()){

                        $c = $c + 1;

                        
                    ?>


                    <div class="col-12  mb-2">
                        <div class="row">

                            <div class="col-8 col-lg-11" onclick="singlemodal(<?php echo $srow['id']; ?>);">
                                <div class="row">

                                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                                    </div>

                                    <div class="col-lg-2 col-10  bg-light  d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold "><?php echo $srow["title"]; ?></span>
                                    </div>

                                    <?php
                            
                            $sellers = Database::search("SELECT * FROM `user` WHERE `email`='".$srow["user_email"]."' ");
                            $selrs = $sellers->fetch_assoc();

                            ?>

                                    <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span
                                            class="fs-5 fw-bold text-white"><?php echo $selrs["fname"]." ".$selrs["lname"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-black"><?php echo $srow["price"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                    </div>

                                    <div class="col-3 bg-light d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-black"><?php 
                                
                                $rd = $srow["datetime_added"];
                                $split = explode(" ", $rd);
                                echo $split[0];

                                ?></span>
                                    </div>

                                </div>
                            </div>


                            <?php
                            
                    $s = $srow["status_id"];

                    if($s == "1"){

                    ?>

                            <div class="col-4 col-lg-1 bg-white pt-1 pb-1 d-grid">
                                <button id="blockbtn1<?php  echo $srow["id"]; ?>" class="btn btn-danger "
                                    onclick="blockproducts('<?php echo $srow['id']; ?>');">Block</button>
                            </div>

                            <?php

                    }else{

                    ?>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <button class="btn btn-success"
                                    onclick="blockproducts('<?php echo $srow['id']; ?>');">Unblock</button>
                            </div>

                            <?php

                    }

                    ?>


                        </div>
                    </div>


                    <!-- Modal single product view -->
                    <div class="modal fade" id="singleproductview<?php echo $srow["id"]; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $srow["title"]; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <?php
                                
                                $imgers = Database::search("SELECT * FROM `images` WHERE `product_id`='".$srow["id"]."'; ");
                                $in = $imgers->num_rows;
                                $ir = $imgers->fetch_assoc();

                                if($in >= "1"){

                                    ?>
                                    <div class="text-center">
                                        <img src="<?php echo $ir["code"]; ?>" class="img-fluid"
                                            style="height: 250px;" /><br />
                                    </div>
                                    <?php

                                }else{

                                    ?>
                                    <div class="text-center">
                                        <img src="resources/empty.svg" class="img-fluid" style="height: 250px;" /><br />
                                    </div>
                                    <?php

                                }

                                ?>

                                    <div class="text-center mt-3 mb-3">
                                        <span class="fs-5  text-primary fw-bold">Price :</span>&nbsp;
                                        <span
                                            class="fs-5 text-black-50 fw-bold">Rs.<?php echo $srow["price"]; ?>.00</span><br />
                                        <span class="fs-5 text-primary fw-bold">Quantity :</span>&nbsp;
                                        <span class="fs-5 text-black-50 fw-bold"><?php echo $srow["qty"]; ?> Items
                                            Left</span><br />
                                        <?php
                                
                                $sellerr = Database::search("SELECT * FROM `user` WHERE `email`='".$srow["user_email"]."'; ");
                                $sr = $sellerr->fetch_assoc();

                                ?>
                                        <span class="fs-5 text-primary fw-bold">Seller :</span>&nbsp;
                                        <span
                                            class="fs-5 text-black-50 fw-bold"><?php echo $sr["fname"]." ".$sr["lname"]; ?></span><br />
                                        <span class="fs-5 text-primary fw-bold">Description :</span>&nbsp;
                                        <span class="fs-5 text-black-50 fw-bold"> <?php echo $srow["description"]; ?>
                                        </span><br />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal single product view  -->



                    <?php
                
         }
         ?>

                </div>
            </div>

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
                            <a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a>
                            <?php

                                                }else{

                                                ?>
                            <a href="<?php echo "?page=" . ($page); ?>" class="ms-1"><?php echo $page; ?></a>
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

            <hr class="hrbreak1" />

            <div class="col-12">
                <h3 class="text-primary">Manage Categories</h3>
            </div>

            <hr class="hrbreak1" />

            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php
                
                $category = Database::search("SELECT * FROM `category`;");
                $cn = $category->num_rows;

                for($i=0;$i<$cn;$i++){

                    $cr = $category->fetch_assoc();
                    ?>
                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                <label class="form-label fs-4 fw-bold py-3"><?php echo $cr["name"]; ?></label>
                            </div>
                        </div>
                    </div>
                    <?php
                    
                }

                ?>

                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                <div class="row">
                                    <div class="col-3 mt-3 addnew"></div>
                                    <div class="col-9">
                                        <label class="form-label fs-4 fw-bold py-3 text-black-50"
                                            onclick="addnewmodal();">Add New
                                            Category</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal 1 -->
            <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Category :- </label>
                            <input class="form-control" id="textcategory" type="text">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="savecategory();">Add
                                Category</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal 1 -->




            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>