<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop|User Profile</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-primary">

    <div class="container-fluid bg-white mt-5 mb-5 ">
        <div class="row">

            <?php

session_start();
if(isset($_SESSION["u"])){

?>
            <div class="col-md-3 border-end">
                <div class="d-flex flex-column align-items-center py-5 p-3">

                    <?php
                 require "connection.php";

                 $profileimg = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$_SESSION["u"]["email"]."';");
                 $pn = $profileimg->num_rows;

                 if($pn == 1){
                     $p = $profileimg->fetch_assoc();
                     ?>
                    <img class="img-fluid mt-5 rou" id="p" width="150px" src="<?php echo $p["code"]; ?>" alt="" />
                    <?php
                 }else{
                     ?>
                    <img class="img-fluid mt-5 rou" id="p" width="150px" src="resources/demoProfileImg.jpg" alt="" />
                    <?php
                 }

                ?>
                    <span
                        style="font-weight: bold;"><?php echo $_SESSION["u"]["fname"]."&nbsp".$_SESSION["u"]["lname"] ?></span>
                    <span class="text-black-50"><?php echo $_SESSION["u"]["email"] ?></span>
                    <input class="d-none" type="file" id="profileimg" accept="img/*" />
                    <label class="btn btn-primary mt-3" for="profileimg" onclick="changeimgprofile();">Update Profile
                        Image</label>
                </div>
            </div>

            <div class="col-md-5 border-end">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" placeholder="First Name"
                                value="<?php echo $_SESSION["u"]["fname"] ?>" id="fn" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Surame</label>
                            <input type="text" class="form-control" placeholder="Last Name"
                                value="<?php echo $_SESSION["u"]["lname"] ?>" id="ln" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number"
                                value="<?php echo $_SESSION["u"]["mobile"] ?>" id="mobile" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password"
                                value="<?php echo $_SESSION["u"]["password"] ?>" readonly />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="text" class="form-control" placeholder="Enter Email id"
                                value="<?php echo $_SESSION["u"]["email"] ?>" readonly id="email" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Registerd Date & Time</label>
                            <input type="text" class="form-control" placeholder="Registerd Date"
                                value="<?php echo $_SESSION["u"]["register_date"] ?>" readonly />
                        </div>

                        <?php

                       

                        $uemail = $_SESSION["u"]["email"];
                        $uaddress = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$uemail."';");
                        $n = $uaddress->num_rows;

                        if($n == 1){

                            $d = $uaddress->fetch_assoc();

                        }else{

                        }

                        $cid = $d["city_id"];
                        $city = Database::search("SELECT * FROM `city` WHERE `id`='".$cid."';");
                        $cit = $city->fetch_assoc();

                        $gid = $_SESSION["u"]["gender_id"];
                        $gen = Database::search("SELECT * FROM `gender` WHERE `id`='".$gid."';");
                        $gender = $gen->fetch_assoc();

                        ?>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Address Line 1</label>
                            <input type="text" class="form-control" placeholder="Enter Address Line 1"
                                value="<?php echo $d["line1"]; ?>" id="line1" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Address Line 2</label>
                            <input type="text" class="form-control" placeholder="Enter Address Line 2"
                                value="<?php echo $d["line2"]; ?>" id="line2" />
                        </div>
                    </div>
                    <?php
                    
                    $cid = $d["city_id"];
                    $city = Database::search("SELECT * FROM `city` WHERE `id`='".$cid."';");
                    $c = $city->fetch_assoc();

                    $disid = $c["district_id"];
                    $district = Database::search("SELECT * FROM `district` WHERE `id`='".$disid."';");
                    $d = $district->fetch_assoc();

                    $proid = $d["province_id"];
                    $province = Database::search("SELECT * FROM `province` WHERE `id`='".$proid."';");
                    $p = $province->fetch_assoc();
                    
                    ?>
                    <div class="row mt-2 mbb-1">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Province</label>
                            <select id="province" class="form-select">
                                <option value="<?php echo $p["id"]; ?>"><?php echo $p["name"]; ?></option>

                                <?php
                                
                                $provinces = Database::search("SELECT * FROM `province` WHERE `id`!='".$p["id"]."' ;");
                                $pnn = $provinces->num_rows;

                                for($i = 0;$i<$pnn;$i++){
                                    $pr = $provinces->fetch_assoc();
                                    ?>
                                <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label fw-bold">District</label>
                            <select id="district" class="form-select">
                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                                <?php
                                
                                $diss = Database::search("SELECT * FROM `district` WHERE `id`!='".$d["id"]."' ;");
                                $pdpd = $diss->num_rows;

                                for($g = 0;$g<$pdpd;$g++){
                                    $prr = $diss->fetch_assoc();
                                    ?>
                                <option value="<?php echo $prr["id"]; ?>"><?php echo $prr["name"]; ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" class="form-control" placeholder="City"
                                value="<?php echo $cit["name"]; ?>" id="city" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label fw-bold">Postal Code</label>
                            <input type="text" class="form-control" placeholder="enter your postal code" value=""
                                id="pc" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gender</label>
                            <input type="text" class="form-control" placeholder="Gender"
                                value="<?php echo $gender["name"]; ?>" readonly />
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php

}else{

    ?>

            <script>
            window.location = "index.php";
            </script>

            <?php

}

?>

            <div class="col-md-4">
                <div class="row p-3 py-5">
                    <div class="col-md-12">
                        <span class="fw-bold">User Rating</span>
                        <span class="fa fa-star fs-4 checked text-warning"></span>
                        <span class="fa fa-star fs-4 checked text-warning"></span>
                        <span class="fa fa-star fs-4 checked text-warning"></span>
                        <span class="fa fa-star fs-4 checked text-warning"></span>
                        <span class="fa fa-star fs-4 checked text-secondary"></span>
                    </div>
                    <div class="col-md-12">
                        <label>4.1 average based on 254 reviews</label>
                    </div>
                    <br /><br />
                    <hr class="hrbreak1" />
                    <div class="col-md-12">
                        <div class="row">
                            <div class="fw-bold side mt-2">
                                <div class="">5 star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">150</div>
                        </div>
                        <div class="row">
                            <div class="fw-bold side mt-2">
                                <div class="">4 star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">63</div>
                        </div>
                        <div class="row">
                            <div class="fw-bold side mt-2">
                                <div class="">3 star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">15</div>
                        </div>
                        <div class="row">
                            <div class="fw-bold side mt-2">
                                <div class="">2 star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 10%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">6</div>
                        </div>
                        <div class="row">
                            <div class="fw-bold side mt-2">
                                <div class="">1 star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 30%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">20</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
        require "footer.php";
        ?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</body>

</html>