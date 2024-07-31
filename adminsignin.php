<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | admin sign in</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid justify-content-center">
        <div class="row align-items-center">

            <div class="col-12" style="margin-top:150px;">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center fw-bold title1">Hi,Welcome To eShop Admins</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background" style="height: 250px;"></div>
                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-lg-3">
                            <div class="col-12 mt-5">
                                <p class="title2 fw-bold">Sign in to your account</p>
                            </div>
                            <div class="col-12 col-lg-11">
                                <label class="form-label fw-bold">Email</label>
                                <input type="text" class="form-control mt-lg-0 mt-2" id="e" />
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary mt-lg-0 mt-2" onclick="adminverification();">Send
                                    verification code to Log in</button>
                            </div>
                            <div class="col-12 col-lg-5 d-grid">
                                <button class="btn btn-danger mt-lg-0 mt-2">Back to user Log in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center fw-bold text-black-50">&copy;2021 eShop.lk All Right Riserved</p>
            </div>

        </div>
    </div>

    <!-- model -->
    <div class="modal fade" tabindex="-1" id="verify">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Verification code</label>
                        <input class="form-control" type="text" id="v" />
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="verify();">ok</button>
            </div>

            </div>
           
        </div>
    </div>
    </div>
    <!-- model -->


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>