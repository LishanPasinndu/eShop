<?php

session_start();

require "connection.php";

$rs = Database::search("SELECT * FROM `admin` WHERE `email`='lishanpc@gmail.com'; ");
$d = $rs->fetch_assoc();
$_SESSION["a"] = $d;

if(isset($_SESSION["a"])){

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | admin panel</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-lg-2">
                <div class="row">
                    <div class="text-center align-items-start bg-dark col-12">
                        <div class="row g-1">

                            <div class="col-12 mt-5">
                                <h4 class="text-white"><?php echo $_SESSION["a"]["fname"]." ".$_SESSION["a"]["lname"]; ?></h4>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                <nav class="nav flex-column">
                                    <a class="nav-link active fs-5" aria-current="page" href="#">Dashboard</a>
                                    <a class="nav-link fs-5" href="manageuser.php">Manage Users</a>
                                    <a class="nav-link fs-5" href="manageproducts.php">Manage Products</a>
                                </nav>
                            </div>

                            <div class="col-12 mt-3">
                                <hr class="border border-1 border-white" />
                                <h4 class="text-white">Selling History</h4>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="col-12 mt-2 d-grid">
                                <label class="form-label text-white fs-6">From Date</label>
                                <input type="date" class="form-control" id="fromdate" placeholder="search from...">
                                <label class="form-label text-white mt-2 fs-6">To Date</label>
                                <input type="date" class="form-control" id="todate" placeholder="search to...">
                                <a class=" btn btn-primary mt-4" href="" id="historylink" onclick="dailyselling();">View Sellings</a>
                                <!-- <hr class="border border-1 border-white" />
                                <h4 class="text-white fs-4 fw-bold" style="cursor: pointer;">view Sellings</h4> -->
                                <hr class="border border-1 border-white" />
                                <hr class="border border-1 border-white" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-10">
                <div class="row">

                    <div class="col-12 mt-3 mb-3 text-white">
                        <h2 class="fw-bold">Dashboard</h2>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12">
                        <div class="row g-1">

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-primary text-white text-center rounded"
                                        style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Daily Earnings</span>
                                        <br />

                                        <?php
                                        
                                        $today = date("Y-m-d");
                                        $thismonth = date("m");
                                        $thisyear = date("Y");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";

                                        $invoicres = Database::search("SELECT * FROM `invoice` ");
                                        $in = $invoicres->num_rows;

                                        for($x = 0;$x < $in; $x++ ){

                                            $ir = $invoicres->fetch_assoc();

                                            $f = $f + $ir["qty"];

                                            $d = $ir["date"];
                                            $splitdate = explode(" ",$d);
                                            $pdate = $splitdate[0];

                                            if($pdate == $today){
                                                $a = $a + $ir["total"];
                                                $c = $c + $ir["qty"];
                                            }

                                            $splitmonth = explode("-",$pdate);
                                            $pyear = $splitmonth[0];
                                            $pmonth = $splitmonth[1];

                                            if($pyear == $thisyear){

                                                if($pmonth == $thismonth){
                                                    $b = $b + $ir["total"];
                                                    $e = $e + $ir["qty"];
                                                }

                                            }

                                        }

                                        ?>

                                        <span class="fs-5">Rs.<?php echo $a; ?>. 00</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-white text-black text-center rounded" style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Monthly Earnings</span>
                                        <br />
                                        <span class="fs-5">Rs.<?php echo $b; ?>. 00</span>

                                    </div>

                                </div>
                            </div>
                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Today Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $c; ?> items</span>

                                    </div>

                                </div>
                            </div>


                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-secondary text-white text-center rounded"
                                        style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Monthly Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $e; ?> items</span>

                                    </div>

                                </div>
                            </div>


                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-success text-white text-center rounded"
                                        style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Total Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $f; ?> items</span>

                                    </div>

                                </div>
                            </div>


                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">

                                        <br />
                                        <span class="fw-bold fs-4">Total Engagements</span>
                                        <br />

                                        <?php
                                        
                                        $usersrs = Database::search("SELECT * FROM `user`; ");
                                        $un = $usersrs->num_rows;

                                        ?>

                                        <span class="fs-5"><?php echo $un; ?> Members</span>

                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 bg-dark">
                        <div class="row">
                            <div class="col-10 col-lg-2 text-center mt-3 mb-3">
                                <label class="form-label fs-5 fw-bold text-white">Total Active Time</label>
                            </div>
                            <?php
                            
                            $startdate = new DateTime("2021-10-01 00:00:00");

                            $tdate = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $tdate->setTimezone($tz);
                            $enddate = new DateTime($tdate->format("Y-m-d H:i:s"));

                            $difference = $enddate->diff($startdate);

                            ?>
                            <div class="col-2 col-lg-10 text-center mt-3 mb-3">
                                <label class="form-label fs-5 fw-bold text-success">
                                    <?php
                                    
                                    echo $difference->format('%Y') ." Years ".$difference->format('%m') ." Months ".
                                    $difference->format('%d') ." Days | ".$difference->format('%H') ." Hours ".
                                    $difference->format('%i') ." Minitues ".$difference->format('%s') ." Seconds";

                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                        <div class="row">

                            <?php
                            
                            $freq = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurrence` 
                            FROM `invoice` WHERE `date` LIKE '%".$today."%' GROUP BY `product_id` ORDER BY `value_occurrence`
                            DESC LIMIT 1");

                            $freqnum = $freq->num_rows;

                            for($z = 0; $z<$freqnum ; $z++){
                                
                                $freqrs = $freq->fetch_assoc();

                                $mpid = $freqrs["product_id"];

                            }

                            $prs = Database::search("SELECT * FROM `product` WHERE `id`='".$mpid."'; ");
                            $pr = $prs->fetch_assoc();

                            $puser = $pr["user_email"];

                            $pusersrs = Database::search("SELECT * FROM `user` WHERE `email`='".$puser."'; ");
                            $uur = $pusersrs->fetch_assoc();

                            $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='".$pr["id"]."'; ");
                            $ir = $imagers->fetch_assoc();

                            $prof = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$puser."'; ");
                            $profr = $prof->fetch_assoc();

                            ?>

                            <div class="col-12 text-center">
                                <label class="form-label fs-4 fw-bold">Mostly Sold Items</label>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <img src="<?php echo $ir["code"]; ?>" class="img-fluid rounded-top" />
                                <hr />
                            </div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-5 fw-bold"><?php echo $pr["title"]; ?></label><br />
                                <span class="fs-6"><?php echo $pr["qty"]; ?> Items</span>
                                <br />
                                <span class="fs-6">Rs.<?php echo $pr["price"]; ?>.00</span>
                            </div>
                            <div class="col-12">
                                <div class="fistplace"></div>
                            </div>
                        </div>
                    </div>

                    <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="form-label fs-4 fw-bold">Mostly Famous Seller</label>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <img src="<?php echo $profr["code"]; ?>" style="height: 200px;border-radius: 50%;"
                                    class="img-fluid " />
                                <hr />
                            </div>
                            <div class="col-12 text-center mt-4">
                                <label class="form-label fs-5 fw-bold"><?php echo $uur["fname"]." ".$uur["lname"]; ?></label><br />
                                <span class="fs-6"><?php echo $uur["email"]; ?></span>
                                <br />
                                <span class="fs-6"><?php echo $uur["mobile"]; ?></span>
                            </div>
                            <div class="col-12">
                                <div class="fistplace"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>

<?php
    
}

?>