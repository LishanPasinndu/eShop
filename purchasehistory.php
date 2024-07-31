<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $mail = $_SESSION["u"]["email"];

    ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Transactionhistory</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="col-12 text-center mb-3">
                <span class="fs-1 text-primary fw-bold">Transaction History</span>
            </div>

            <?php
            
            $invoicers = Database::search("SELECT * FROM `invoice` WHERE `user_email`='".$mail."'; ");
            $in = $invoicers->num_rows;

            if($in > 0){

                ?>

            <div class="col-12 d-none d-lg-block">
                <div class="row">
                    <div class="col-1 bg-light">
                        <label class="form-label fw-bold">#</label>
                    </div>
                    <div class="col-3 bg-light">
                        <label class="form-label fw-bold">Order Detailes</label>
                    </div>
                    <div class="col-1 bg-light text-end">
                        <label class="form-label fw-bold">Quantity</label>
                    </div>
                    <div class="col-2 bg-light text-end">
                        <label class="form-label fw-bold">Amount</label>
                    </div>
                    <div class="col-2 bg-light text-end">
                        <label class="form-label fw-bold">Purchased Date & Time</label>
                    </div>
                    <div class="col-3 bg-light"></div>
                    <div class="col-12">
                        <hr class="hrbreak1" />
                    </div>

                </div>
            </div>

            <?php
            
            for($x = 0; $x < $in; $x++){
                $ir = $invoicers->fetch_assoc();

                ?>

            <div class="col-12 mb-2">
                <div class="row">

                    <div class="col-12 text-center col-lg-1 bg-info">
                        <label class="form-label text-white fs-6 py-5"><?php echo $ir["order_id"]; ?></label>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="row">

                            <?php
                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='".$ir["product_id"]."' ");
                        $f = $imagers->fetch_assoc();
                        
                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$ir["product_id"]."'; ");
                        $pr = $productrs->fetch_assoc();

                        $sellers = Database::search("SELECT * FROM `user` WHERE `email`='".$pr["user_email"]."'; ");
                        $sr = $sellers->fetch_assoc();

                        ?>

                            <div class="card mx-3 my-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?php echo $f["code"]; ?>" class="img-fluid rounded-start mt-1">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                            <p class="card-text"><b>Seller :</b><?php echo $sr["fname"]; ?></p>
                                            <p class="card-text"><b>Price :</b>Rs.<?php echo $pr["price"]; ?>. 00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-1 text-center">
                        <label class="form-label fs-4 pt-5"><?php echo $ir["qty"]; ?></label>
                    </div>

                    <div class="col-12 col-lg-2 bg-info text-center text-lg-end">
                        <label class="form-label text-white fs-4 pt-5">Rs.<?php echo $ir["total"]; ?>. 00</label>
                    </div>

                    <div class="col-12 col-lg-2 text-center text-lg-end">
                        <label class="form-label fs-4 pt-5"><?php echo $ir["date"]; ?></label>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5"
                                    onclick="addfeedback(<?php echo $ir['product_id']; ?>);"><i
                                        class="bi bi-info-circle-fill"></i> Feedback</button>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-danger rounded mt-5 fs-5"><i class="bi bi-trash-fill"></i>
                                    Delete</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php

            }

            ?>

            <div class="col-12">
                <hr class="hrbreak1" />
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-lg-9 d-none d-lg-block"></div>
                    <div class="col-12 col-lg-3 d-grid">
                        <button class="btn btn-danger fs-4"><i class="bi bi-trash-fill"></i> Clear All Records</button>
                    </div>
                </div>
            </div>

            <!-- modal -->

            <div class="modal fade" id="feedbackmodal<?php echo $ir['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea placeholder="Type your feedback here..." id="feedtext<?php echo $ir["product_id"]; ?>" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="savefeedback(<?php echo $ir['product_id']; ?>);">Save Feedback</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->


            <?php

            }else{

                ?>


            <div class="col-12 text-center bg-light" style="height: 450px;">
                <div style="height: 200px;"></div>
                <span class="fs-1 fw-bold text-black-50">You Have No Items in your Transaction history yet...</span>
            </div>

            <?php

            }

            ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>

<?php

}else{
    ?>
<script>
window.location = "index.php";
</script>
<?php
}

?>