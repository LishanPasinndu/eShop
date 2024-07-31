<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product page</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">

        <div id="addproductbox">
            <div class="row gy-3">

                <!-- heading -->

                <div class="col-12">
                    <h3 class="h2 text-center text-primary" style="font-weight:bolder;">Product Listing</h3>
                </div>
                <!-- heading -->

                <!-- category,brand,model -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- category -->
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12">
                                    <select id="ca" class="form-select">
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
                            </div>
                        </div>
                        <!-- category -->
                        <!-- brand -->
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12">
                                    <select id="br" class="form-select">
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
                            </div>
                        </div>
                        <!-- brand -->
                        <!-- model -->
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12">
                                    <select id="mo" class="form-select">
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
                        <!-- model -->
                    </div>
                </div>
                <!-- category,brand,model -->

                <hr class="hrbreak1">

                <!-- title -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Tite to your product</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">
                            <input type="text" class="form-control" id="ti" />
                        </div>
                    </div>
                </div>
                <!-- title -->

                <hr class="hrbreak1">

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4 ">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="bn" checked>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="us">
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr1">
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr2">
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr3">
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr4">
                                            <label class="form-check-label" for="clr4">
                                                Pacific Blue
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr5">
                                            <label class="form-check-label" for="clr5">
                                                Jet Black
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-check offset-lg-0 offset-1 col-5">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio"
                                                id="clr6">
                                            <label class="form-check-label" for="clr6">
                                                Rose Gold
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Quantity</label>
                                </div>
                            </div>
                            <input type="number" id="qty" class="form-control" min="0" value="0" />
                        </div>
                    </div>
                </div>
                <!-- condition,color,qty -->

                <hr class="hrbreak1">

                <!-- cost,payement method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="form-label lbl1">Cost per item</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest rupee)" id="cost">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="form-label lbl1">Approved Payement Methods</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-2 col-2 pm1"></div>
                                            <div class="col-2 pm2"></div>
                                            <div class="col-2 pm3"></div>
                                            <div class="col-2 pm4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cost,payement method -->

                <hr class="hrbreak1">

                <!-- delivery cost -->
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Delivery Cost</label>
                        </div>
                        <div class="offset-lg-1 col-lg-3 col-12">
                            <label class="form-label">Delivery Cost Within Colombo</label>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)"
                                    id="dwc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1"></label>
                        </div>
                        <div class="offset-lg-1 col-lg-3 col-12 mt-lg-3">
                            <label class="form-label">Delivery Cost Out Of Colombo</label>
                        </div>
                        <div class="col-12 col-lg-7 mt-lg-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)"
                                    id="doc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delivery cost -->

                <hr class="hrbreak1">

                <!-- Description -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea cols="100" rows="28" class="form-control" style="background-color:ghostwhite;"
                                id="desc"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Description -->

                <hr class="hrbreak1">

                <!-- product image -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <img src="resources/addproductimg.svg" onclick="changeimg();"
                            class="ms-2 col-8 col-lg-2 productimg" id="prev">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                            <label class="btn btn-primary col-6 col-lg-8" for="imguploader"
                                                onclick="changeimg();">upload</label>
                                        </div>
                                        <!-- <div class="col-6 col-lg-4 d-grid mt-lg-0 mt-2">
                            <button class="btn btn-primary">Upload</button>
                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product image -->

                <hr class="hrbreak1">

                <!-- notice -->
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                     <labelclass="form-label">We are taking 5% of the product price from every product as a service
                        charge.</label>
                </div>
                <!-- notice -->

                <!-- save button -->
                <div class="col-12">
                    <div class="row">
                        <div class="d-grid offset-lg-4 offset-0 col-12 col-lg-4">
                            <button class="btn btn-success" onclick="addproduct();">Add Product</button>
                        </div>
                        <div class="col-12 col-lg-2 d-grid mt-2 mt-lg-0">
                            <button class="btn btn-dark" onclick="changeproductview();">Update Product</button>
                        </div>

                    </div>
                    <br /><br />
                </div>
                <!-- save button -->

            </div>
        </div>

        <!-- footer -->
        <?php
                require "footer.php";
                ?>
        <!-- footer -->
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>