<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
</head>

<body>

    <div class="col-12">
        <div class="row">
            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-lg-2">
                <?php
                        // session_start();
                        if(isset($_SESSION["u"])){
                            $user = $_SESSION["u"]["fname"];
                            ?>
                <span class="text-start label1"><b>Welcome <?php echo $user; ?></b></span> |
                <span class="text-start label2">Help and Contact </span>|
                <span class="text-start label2" onclick="signout();"> Sign out</span>
                <?php
                        }else{
                            ?>
                <a href="index.php" class="link1">Hi Sign In or Register</a> |
                <span class="text-start label2">Help and Contact </span>
                <?php
                        }
                        ?>


            </div>
            <div class="offset-lg-6 col-12 col-lg-2">
                <div class="row mt-1 mb-1">
                    <div class="col-1 cl-lg-3 mx-2 mt-lg-2">
                        <span class="text-start label2" onclick="gotoaddproduct();">Sell </span>
                    </div>
                    <div class="col-2 col-lg-6 dropdown  me-lg-0 me-4">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            My shop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="watchlist.php">Whishlist</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="#">Message</a></li>
                            <li><a class="dropdown-item" href="sellerproductview.php">My Product</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Selling</a></li>
                        </ul>
                    </div>
                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mx-lg-0 mx-1 carticon" onclick="gocart();"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>