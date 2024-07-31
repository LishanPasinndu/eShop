<?php

require "connection.php";

session_start();

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Advanced search</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="bg-info">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body border border-primary border-start-0 border-end-0 border-top-0">
                <?php
                   require "header.php";
                ?>
            </div>

            <div class="col-12 bg-white ">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2 mt-3">
                                <div class="mb-3 logo"></div>
                            </div>
                            <div class="col-10">
                                <label class="text-black-50 fw-bolder fs-2 mt-5">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3">
                <div class="row">
                    <div class="offset-lg-1 offset-0 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" id="k" placeholder="Type Keyword to search..">
                            </div>
                            <div class="col-12 col-lg-2 mt-3 mb-2">
                                <button class="btn btn-primary d-grid searchbtn1" onclick="advancesearch();">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 offset-0 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select id="c" class="form-select">
                                            <option value="0">Select Category</option>
                                            <?php
                                            
                                            $categoryrs = Database::search("SELECT * FROM `category`; ");
                                            $cn = $categoryrs->num_rows;

                                            for($x = 0; $x < $cn ; $x++){

                                                $cr = $categoryrs->fetch_assoc();

                                            ?>
                                            <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4  mb-3">
                                        <select id="b" class="form-select">
                                            <option value="0">Select brand</option>
                                            <?php
                                            
                                            $brandrs = Database::search("SELECT * FROM `brand`; ");
                                            $cn = $brandrs->num_rows;

                                            for($x = 0; $x < $cn ; $x++){

                                                $cr = $brandrs->fetch_assoc();

                                            ?>
                                            <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4  mb-3">
                                        <select id="m" class="form-select">
                                            <option value="0">Select model</option>
                                            <?php
                                            
                                            $modelrs = Database::search("SELECT * FROM `model`; ");
                                            $cn = $modelrs->num_rows;

                                            for($x = 0; $x < $cn ; $x++){

                                                $cr = $modelrs->fetch_assoc();

                                            ?>
                                            <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 offset-0 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select id="con" class="form-select">
                                            <option value="0">Select condition</option>
                                            <?php
                                            
                                            $conditionrs = Database::search("SELECT * FROM `condition`; ");
                                            $cn = $conditionrs->num_rows;

                                            for($x = 0; $x < $cn ; $x++){

                                                $cr = $conditionrs->fetch_assoc();

                                            ?>
                                            <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6  mb-3">
                                        <select id="clr" class="form-select">
                                            <option value="0">Select color</option>
                                            <?php
                                            
                                            $colors = Database::search("SELECT * FROM `color`; ");
                                            $cn = $colors->num_rows;

                                            for($x = 0; $x < $cn ; $x++){

                                                $cr = $colors->fetch_assoc();

                                            ?>
                                            <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 offset-0 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control fw-bold" id="pf" placeholder="Price From" />
                                    </div>
                                    <div class="col-12 col-lg-6  mb-3">
                                        <input type="text" class="form-control fw-bold" id="pt" placeholder="Price To" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 rounded mb-3">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="viewresults">

<!--                         
                            <div class="col-12 mb-3 mt-2">
                                <div class="row">
                                    <div class="offset-4 col-4 d-flex justify-content-center">
                                        <div class="pagination">
                                            <a href="">&laquo;</a>
                                            <a href="#" class="ms-1 active">1</a>
                                            <a href="#" class="ms-1 ">2</a>
                                            <a href="">&raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
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