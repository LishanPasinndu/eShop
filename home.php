 <?php
 
 session_start();

 ?>

 <!DOCTYPE html>

 <html>

 <head>

     <title>eShop Home</title>

     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link rel="icon" href="resources/logo.svg" />
     <link rel="stylesheet" href="style.css" />
     <link rel="stylesheet" href="bootstrap.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

 </head>

 <body>

     <div class="container-fluid">
         <div class="row">

             <!-- header -->
             <?php
              require "header.php";
              ?>
             <!-- header -->

             <hr class="hrbreak1" />

             <!-- search bar -->
             <div class="col-12 justify-content-center">
                 <div class="row mb-3">
                     <div class="col-12 col-lg-1 offset-lg-1 logoimg" style="background-position:center;"></div>
                     <div class="col-12 col-lg-6">
                         <div class="input-group input-group-lg mt-3 mb-3">
                             <input type="text" id="basicsearchtext" class="form-control"
                                 aria-label="Text input with dropdown button">

                             <select id="basicsearhselect" class="btn btn-outline-primary ">
                                 <option value="0">Select Category</option>

                                 <?php

                               require "connection.php";

                               $rs = Database::search("SELECT * FROM category;");
                               $n = $rs->num_rows;

                               for($i=1;$i<=$n;$i++){
                                   $cat = $rs->fetch_assoc();

                                   ?>
                                 <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                 <?php
                               }
                               ?>
                             </select>
                         </div>
                     </div>
                     <div class="col-6 col-lg-2 d-grid gap-2">
                         <button class="btn btn-primary mt-3 searchbtn" onclick="basicsearch();">Search</button>
                     </div>
                     <div class="col-6 col-lg-2 mt-4">
                         <a href="advancesearch.php" class="link-secondary link1">Advanced</a>
                     </div>
                 </div>
             </div>
             <!-- search bar -->

             <hr class="hrbreak1" />

             <!-- slide -->
             <div class="col-12 d-none d-lg-block">
                 <div class="row">
                     <div id="carouselExampleCaptions" class="offset-2 col-8 carousel slide " data-bs-ride="carousel">
                         <div class="carousel-indicators">
                             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                 class="active" aria-current="true" aria-label="Slide 1"></button>
                             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                 aria-label="Slide 2"></button>
                             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                 aria-label="Slide 3"></button>
                         </div>
                         <div class="carousel-inner">
                             <div class="carousel-item active">
                                 <img src="resources/slider images/posterimg.jpg" class="d-block w-100 posterimg1">
                                 <div class="carousel-caption d-none d-md-block postercaption">
                                     <h5 class="postertitle">Welcome to eShop</h5>
                                     <p class="postertext">The World's best online store by one click</p>
                                 </div>
                             </div>
                             <div class="carousel-item">
                                 <img src="resources/slider images/posterimg2.jpg" class="d-block w-100" alt="...">
                             </div>
                             <div class="carousel-item">
                                 <img src="resources/slider images/posterimg3.jpg" class="d-block w-100" alt="...">
                                 <div class="carousel-caption d-none d-md-block postercaption1">
                                     <h5 class="postertitle">Be free.......</h5>
                                     <p class="postertext">Experience the lowest delivery coast with us</p>
                                 </div>
                             </div>
                         </div>
                         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                             data-bs-slide="prev">
                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                             <span class="visually-hidden">Previous</span>
                         </button>
                         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                             data-bs-slide="next">
                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                             <span class="visually-hidden">Next</span>
                         </button>
                     </div>
                 </div>
             </div>
             <!-- slide -->

             <div class="col-12">
                 <div class="row border border-primary">
                     <div class="offset-lg-1 col-12 col-lg-10" id="pdiv">
                         <div class="row" id="mainsearch">
                         </div>
                     </div>
                 </div>
             </div>

             <!-- product title view -->
             <?php
               $rs = Database::search("SELECT * FROM category;");
               $n = $rs->num_rows;
               for($x=0;$x<$n;$x++){
                   $c = $rs->fetch_assoc();
                   ?>
             <div class="col-12" id="oldrow2">
                 <a class="link-dark link2" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                 <a class="link-dark link3" href="#">See All &rightarrow;</a>
             </div>
             <!-- product title view -->

             <!-- product view -->
             <div class="col-12 " id="oldrow">
                 <div class="row border border-primary">
                     <div class="offset-lg-1 col-12 col-lg-10" id="pdiv">
                         <div class="row" id="pdetailes">

                             <?php
                               $resultset = Database::search("SELECT * FROM `product` WHERE `category_id`='".$c["id"]."' 
                               ORDER BY `datetime_added` DESC LIMIT 5;");
                               $nr = $resultset->num_rows;
                               for($y = 0 ; $y<$nr; $y++){
                                $prod = $resultset->fetch_assoc();
                                ?>
                             <div class="card col-6 offset-lg-0 offset-2 col-lg-2 mt-2 mb-2" style="width: 15rem;">
                                 <?php
                              $pimg = Database::search("SELECT * FROM `images` WHERE `product_id`='".$prod["id"]."';");
                              $imgrow = $pimg->fetch_assoc();
                              ?>
                                 <img src="<?php echo $imgrow["code"]; ?>" class="card-img-top cardtopimage" alt="...">
                                 <div class="card-body">
                                     <h5 class="card-title" style="font-weight:bold;"><?php echo $prod["title"];?>
                                         <span class="badge bg-info">New</span>
                                     </h5>
                                     <span class="card-text text-primary">Rs.<?php echo $prod["price"];?></span>
                                     <br />
                                     <?php

                                       if((int)$prod["qty"] > 0){
                                           ?>
                                     <span class="card-text text-warning">In Stock</span>
                                     <br />
                                     <input type="number" value="1" class="form-control mb-1"
                                         id="qtytext<?php echo $prod['id']; ?>">
                                     <a href="<?php echo "singleproductview.php?id=".($prod['id']); ?>"
                                         class="btn btn-success d-block">Buy Now</a>
                                     <a class="btn btn-danger  mt-1"
                                         onclick="addtocart(<?php echo $prod['id']; ?>);">&nbsp;&nbsp;&nbsp;Add to
                                         Cart&nbsp;&nbsp;</a>
                                     <a class="btn btn-secondary  mt-1"
                                         onclick="addtowatchlist(<?php echo $prod['id']; ?>);"><i
                                             class="bi bi-suit-heart-fill"></i></a>
                                     <?php
                                       }else{
                                           ?>
                                     <span class="card-text text-warning">out of stock</span>
                                     <br />
                                     <input type="number" value="1" class="form-control mb-1" disabled>
                                     <a href="#" class="btn btn-success d-block disabled">Buy Now</a>
                                     <a class="btn btn-danger d-block mt-1 disabled" ">Add to Cart</a>
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
                  </div>
                  <?php
               }
              ?>
            <!-- product view -->

            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->

              </div>
          </div>

          <script src=" script.js"></script>
                                         <script src="bootstrap.bundle.js"></script>

 </body>

 </html>