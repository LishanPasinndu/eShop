<?php

session_start();

require "connection.php";

$product = $_SESSION["p"];

if(isset($product)){

    ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product page</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">

        <div id="updateproductbox" class="">
            <div class="row gy-3">

                <!-- heading -->

                <div class="col-12">
                    <h3 class="h2 text-center text-primary" style="font-weight:bolder;">Update Product</h3>
                </div>
                <!-- heading -->

                <!-- search filed -->

                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="offset-0 offset-lg-1 col-12 col-lg-6">
                            <input type="text" class="form-control text-center"
                                placeholder="Search Product you want to update " id="searchforupdate" />
                        </div>
                        <div class="col-12 col-lg-4 d-grid mt-lg-0 mt-3">
                            <button class="btn btn-primary " onclick="searchforupdate();">Search Product</button>
                        </div>
                    </div>
                </div>

                <hr class="hrbreak1" />

                <!-- search filed -->

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

                                        <?php
                                    
                                    $category = Database::search("SELECT * FROM `category` WHERE `id`='".$product["category_id"]."'; ");
                                    $cd = $category->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>
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
                                    <select id="br" class="form-select" disabled>
                                        <?php
                                    
                                    $mab = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$product["model_has_brand_id"]."'; ");
                                    $mhb = $mab->fetch_assoc();

                                    $brand = Database::search("SELECT * FROM `brand` WHERE `id`='".$mhb["brand_id"]."'; ");
                                    $br = $brand->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $br["id"]; ?>"><?php echo $br["name"]; ?></option>
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
                                    <select id="mo" class="form-select" disabled>
                                        <?php
                                        
                                        $model = Database::search("SELECT * FROM `model` WHERE `id`='".$mhb["model_id"]."'; ");
                                        $mo = $model->fetch_assoc();
                                        
                                        ?>
                                        <option value="<?php echo $mo["id"]; ?>"><?php echo $mo["name"]; ?></option>
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
                            <input type="text" class="form-control" id="ti" value="<?php echo $product["title"]; ?>" />
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
                                <?php
                            
                            if($product["condition_id"] == "1"){

                                ?>

                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="bn" checked disabled>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="us" disabled>
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                                <?php

                            }else{
                                ?>
                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="bn" disabled>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="offset-1 col-5 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="bn" id="us" checked disabled>
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                                <?php
                            }

                            ?>
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
                                                disabled id="clr1" <?php
                                                $color = $product["color_id"];
                                                if($color == "1"){
                                                  ?> checked <?php
                                                }

                                                ?>>
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
                                                disabled id="clr2" <?php
                                                $color = $product["color_id"];
                                                if($color == "2"){
                                                  ?> checked <?php
                                                }
                                                ?>>
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
                                                disabled id="clr3" <?php
                                                $color = $product["color_id"];
                                                if($color == "3"){
                                                  ?> checked <?php
                                                }
                                                ?>>
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
                                                disabled id="clr4" <?php
                                                $color = $product["color_id"];
                                                if($color == "4"){
                                                  ?> checked <?php
                                                }
                                                ?>>
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
                                                disabled id="clr5" <?php
                                                $color = $product["color_id"];
                                                if($color == "5"){
                                                  ?> checked <?php
                                                }
                                                ?>>
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
                                                disabled id="clr6" <?php
                                                $color = $product["color_id"];
                                                if($color == "6"){
                                                  ?> checked <?php
                                                }
                                                ?>>
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
                            <input type="number" id="qty" class="form-control" min="0"
                                value="<?php echo $product["qty"]; ?>" />
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
                                        <input type="text" class="form-control" disabled
                                            aria-label="Amount (to the nearest rupee)" id="cost"
                                            value="<?php echo $product["price"]; ?>">
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
                                    id="dwc" value="<?php echo $product["delivery_with_colombo"]; ?>">
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
                                    id="doc" value="<?php echo $product["delivery_out_colombo"]; ?>">
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
                            <textarea cols="100" rows="28" class="form-control"
                                value="<?php echo $product["description"]; ?>" style="background-color:ghostwhite;"
                                id="desc"><?php echo $product["description"]; ?></textarea>
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
                        <?php
                        
                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product["id"]."'; ");
                        $in = $imagers->num_rows;

                        if($in == 1){
                            $ir = $imagers->fetch_assoc();

                            ?>

                        <img src="<?php echo $ir["code"]; ?>" onclick="changeimg();"
                            class="ms-2 col-8 col-lg-2 productimg" id="prev">

                        <?php

                        }else{

                            ?>

                        <img src="resources/addproductimg.svg" onclick="changeimg();"
                            class="ms-2 col-8 col-lg-2 productimg" id="prev">

                        <?php

                        }

                        ?>
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
                    <label class="form-label">We are taking 5% of the product price from every product as a service
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
                            <button class="btn btn-dark" onclick="updatepro(<?php echo $product['id']; ?>);">Update Product</button>
                        </div>
                    </div>
                    <br /><br />
                </div>

                <!-- save button -->

            </div>
        </div>

        <?php
        
        require "footer.php";

        ?>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>


<?php

}

?>