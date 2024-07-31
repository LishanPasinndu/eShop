<!DOCTYPE html>

<html>

<head>

    <title>eShop</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="main-background">

    <div class="container-fluid vh-100 d-flex align-content-center justify-content-center">

        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to eShop</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-6 d-none d-lg-block  background">
                    </div>

                    <div class="col-12 col-lg-6 " id="signUpBox">

                        <div class="row g-3">

                            <div class="col-12 title2">
                                <p>Create New Account</p>
                                <p id="msg" class="text-danger"></p>
                            </div>

                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" id="fname" />
                            </div>

                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="lname" />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" />
                            </div>

                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" id="mobile" />
                            </div>

                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">

                                    <?php
                                        require "connection.php";
                                        $r = Database::search("SELECT * FROM `gender`;");
                                        $n = $r->num_rows;
                                        for($x=0;$x<$n;$x++){
                                            $d = $r->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary col-12" onclick="signup();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark col-12" onclick="changeView();">Already have an account?
                                    Sign In</button>
                            </div>

                        </div>

                    </div>

                    <!-- login -->
                    <div class="col-12 col-lg-6   d-none" id="signInBox">

                        <div class="row g-3">

                            <div class="col-12 title2">
                                <p>Sign In To Your Account</p>
                                <p id="msg2"></p>
                            </div>

                            <?php

                                $e = "";
                                $p = "";

                                if(isset($_COOKIE['e'])){
                                    $e = $_COOKIE['e'];
                                }

                                if(isset($_COOKIE['p'])){
                                    $p = $_COOKIE['p'];
                                }
                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input value="<?php echo $e; ?>" class="form-control" type="email" id="email2" />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input value="<?php echo $p; ?>" class="form-control" type="password" id="password2" />
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <a href="#" class="link-primary" onclick="ForGotPassword();">Forgot Password?</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary col-12" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger col-12" onclick="changeView();">New to eShop? Join
                                    Now</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!-- content -->

        </div>

    </div>

    <!-- footer -->
    <div class="col-12 d-none d-lg-block fixed-bottom">
        <p class="text-center"> &copy; 2021 eShop.lk All rights reserved</p>
    </div>
    <!-- footer -->

    <!-- model -->
    <div class="modal fade" tabindex="-1" id="ForgetPasswordModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Password Reset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" id="np" />
                                <button class="btn btn-outline-primary" id="npb" type="button"
                                    onclick="showpassword1();">Show</button>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Retype Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" id="rnp" />
                                <button class="btn btn-outline-primary" id="rpb" type="button"
                                    onclick="showpassword2();">Show</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Verification code</label>
                            <input class="form-control" type="text" id="vc" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetpassword();">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <!-- model -->

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>