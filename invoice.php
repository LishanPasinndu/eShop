<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $umail = $_SESSION["u"]["email"];
    $oid = $_GET["id"];

    ?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Invoice</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


</head>

<body class="mt-2 " style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="col-12">
                <hr class="hrbreak1" />
            </div>

            <div class="col-12 btn-toolbar justify-content-end ">
                <button class="btn btn-dark me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i> Print</button>
                <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button>
            </div>

            <div class="col-12">
                <hr class="hrbreak1" />
            </div>

            <div id="GFG" >

                <div class="col-12">
                    <div class="row">

                        <div class="col-6">
                            <div class="invoiceheaderimg mt-2"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-end text-decoration-underline text-primary">
                                    <h2>eShop</h2>
                                </div>
                                <div class="col-12 text-end fw-bold">
                                    <span>Maradana, Colombo 10, Sri Lanka</span><br />
                                    <span>+94112547821</span><br />
                                    <span>eShop@gmail.com</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <hr class="border border-2 border-primary" />
                </div>

                <div class="col-12 mb-4">
                    <div class="row">

                        <div class="col-6">
                            <h5>INVOICE TO :</h5>
                            <?php
                        
                        $userhasaddress = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."' ");
                        $ar = $userhasaddress->fetch_assoc();

                        ?>
                            <h2><?php echo $_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"]; ?></h2>
                            <span class="fw-bold"><?php echo $ar["line1"]." , ",$ar["line2"]; ?></span><br />
                            <span class="fw-bold text-decoration-underline text-primary"><?php echo $umail; ?></span>
                        </div>

                        <?php
                    
                    $invoice = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'; ");
                    $in = $invoice->num_rows;
                    $ir = $invoice->fetch_assoc();

                    ?>

                        <div class="col-6 text-end mt-4">
                            <h1 class="fw-bold text-primary">INVOICE <?php echo $ir["id"]; ?></h1>
                            <span class="fw-bold">Date and Time of Invoice :</span>&nbsp;
                            <span class="fw-bold"><?php echo $ir["date"]; ?></span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr style=" background-color: rgb(241, 241, 241);" class="border-1 border-white ">
                                <th class="border-0 border-white">#</th>
                                <th class="border-0 border-white">Order Id & Product</th>
                                <th class="text-end border-0 border-white">Unit Price</th>
                                <th class="text-end border-0 border-white">Quantity</th>
                                <th class="text-end border-0 border-white">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                    $substotal;
                    
                    for($x = 0; $x < $in ; $x++){

                        $substotal =  $ir["total"];

                        ?>
                            <tr style="height: 70px;">
                                <td class="bg-primary text-white fs-3"><?php echo $ir["id"]; ?></td>
                                <td class="border-0 border-white" style="background-color: rgb(241, 241, 241);">
                                    <a href="#" class="fs-6 fw-bold p-2"><?php echo $ir["order_id"]; ?></a><br />
                                    <?php
                                
                                $pid = $ir["product_id"];

                                $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'; ");
                                $pr = $productrs->fetch_assoc();

                                ?>
                                    <a href="#" class="fs-6 fw-bold p-2 "><?php echo $pr["title"]; ?></a>
                                </td>
                                <td class="fs-6 text-end fw-bold pt-3 border-0 border-white"
                                    style="background-color: rgb(199,199,199);">Rs. <?php echo $pr["price"]; ?> .00</td>
                                <td style="background-color: rgb(241, 241, 241);"
                                    class="fs-6 text-end pt-3 fw-bold border-0 border-white"><?php echo $ir["qty"]; ?>
                                </td>
                                <td class="fs-6 text-end pt-3 bg-primary text-white ">Rs. <?php echo $ir["total"]; ?>
                                    .00
                                </td>
                            </tr>
                            <?php

                    }

                    ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-5 text-end border-secondary">SUBTOTAL</td>
                                <td class="fs-5 text-end border-secondary">Rs. <?php echo $substotal; ?> .00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-5 text-end border-primary">Disscount</td>
                                <td class="fs-5 text-end border-primary">Rs. 00 .00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-5 text-end text-primary border-0 border-white">GRAND TOTAL
                                </td>
                                <td class="fs-5 text-end border-primary border-0 border-white">Rs.
                                    <?php echo $substotal; ?> .00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-4 text-center" style="margin-top: -100px;margin-bottom: 50px;">
                    <span class="fs-1 fw-bold">Thank You !</span>
                </div>

                <div class="col-12 mt-3 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-primary border-5 rounded"
                    style="background-color: #e7f2ff;">
                    <div class="row">
                        <div class="col-12 mt-1 mb-1">
                            <label class="form-label fs-6 fw-bold">NOTICE :</label><br />
                            <label class="form-label fs-6 ">Purcahsed item can return before 7 day of delivery</label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="hrbreak1" />
                </div>

                <div class="col-12 mb-3 text-center">
                    <label class="form-label fs-6 text-black-50">
                        Invoice was created on a computer and is walid without the Signature and seal.
                    </label>
                </div>

            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>

<?php

}

?>