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
    <title>eShop | mange users</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 mt-3 mb-3 offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-9">
                                <input id="searchtxt" type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" onclick="searchusers();">Search</button>
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

                            <div class="col-lg-2 col-4  bg-light d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-black">Profile image</span>
                            </div>

                            <div class="col-lg-2 col-6 bg-primary  d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-white">User Name</span>
                            </div>

                            <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-black">Email</span>
                            </div>

                            <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                <span class="fs-4 fw-bold text-white">Mobile</span>
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
                <div class="row" id="newuser">
                </div>
            </div>

            <div class="col-12">
                <div class="row" id="olduser">

                    <?php
            
            
            
                if(isset($_GET["page"])){
                    $pageno = $_GET["page"];
                }else{
                    
                    $pageno = 1;

                }

                $users = Database::search("SELECT * FROM `user`; ");
                $d = $users->num_rows;
                $row = $users->fetch_assoc();

                $result_per_page = 20;

                $number_of_pages = ceil($d/$result_per_page);

                $page_first_result = ((int)$pageno - 1 ) * $result_per_page;

                $selectreds = Database::search("SELECT * FROM `user`
                LIMIT ".$result_per_page." OFFSET ".$page_first_result."; ");

                $srn = $selectreds->num_rows;

                $c = "0";

                    while($srow = $selectreds->fetch_assoc()){

                        $c = $c + 1;

                        
                    ?>


                    <div class="col-12  mb-2">
                        <div class="row">


                            <div class="col-8 col-lg-11" onclick="viewmsgmodal('<?php echo $srow['email']; ?>');">
                                <div class="row">

                                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                                    </div>

                                    <?php
                    
                    $ir = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$srow["email"]."'; ");
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
                                            class="fs-5 fw-bold text-white"><?php echo $srow["fname"]." ".$srow["lname"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-light d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-black"><?php echo $srow["email"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"]; ?></span>
                                    </div>

                                    <div class="col-3 bg-light d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-black"><?php 
                                
                                $rd = $srow["register_date"];
                                $split = explode(" ", $rd);
                                echo $split[0];

                                ?></span>
                                    </div>

                                </div>
                            </div>


                            <?php
                            
                    $s = $srow["status"];

                    if($s == "1"){

                    ?>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <button id="blockbtn<?php  echo $srow["email"]; ?>" class="btn btn-danger"
                                    onclick="blockusers('<?php echo $srow['email']; ?>');">Block</button>
                            </div>

                            <?php

                    }else{

                    ?>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <button class="btn btn-danger" onclick="blockusers('<?php echo $srow['email']; ?>');"><i
                                        class="bi bi-exclamation-circle"></i> Unblock</button>
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
            <?php
         ?>

            <!-- Modal -->
            <div class="modal fade" id="msgmodallishanwickrama1@gmail.com" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">My Massages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" onload="refresher('<?php echo $srow['email']; ?>');"
                            style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

                            <?php
                               
                               $customer = $_SESSION["u"]["email"];

                               ?>

                            <div class="col-12 py-5 px-4">
                                <div class="row rounded-lg overflow-hidden shadow">
                                    <div class="col-12 px-0">
                                        <div class="bg-white">

                                            <div class="bg-gray px-4 py-2 bg-light">
                                                <p class="h5 mb-0 py-1">Recent</p>
                                            </div>

                                            <div class="messages-box">
                                                <div class="list-group rounded-0" id="rcv">



                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- massage box -->
                                    <div class="col-12 px-0">
                                        <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                            <!-- massage load venne methana -->

                                            <div class="col-7 media mb-3">
                                                <img src="resources/demoProfileImg.jpg" alt="user" width="50"
                                                    class="rounded-circle">
                                                <div class="media-body ml-3">
                                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-muted">
                                                            hi admin</p>
                                                    </div>
                                                    <p class="small text-muted">12:00 PM | 2021-10-01</p>
                                                </div>
                                            </div>
                                            <div class="col-5"></div>

                                            <div class="col-5"></div>
                                            <div class="col-7 media ml-auto mb-3">
                                                <div class="media-body">
                                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-white">
                                                          hi malidu</p>
                                                    </div>
                                                    <p class="small text-muted">12:00 PM | 2021-10-01</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row bg-white">

                                            <!-- text -->
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="input-group">
                                                        <input type="text" id="msgtxt" placeholder="Type a message"
                                                            aria-describedby="button-addon2"
                                                            class="form-control rounded-0 border-0 py-4 bg-light">
                                                        <div class="input-group-append">
                                                            <button id="button-addon2" class="btn btn-link fs-1"
                                                                onclick="sendmessage('<?php echo $srow['email']; ?>');">
                                                                <i class="bi bi-cursor-fill"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- text -->

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>