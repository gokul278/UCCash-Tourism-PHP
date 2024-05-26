<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Change PWD</title>
    <link rel="shortcut icon" href="./img/favicon.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Simple Notify -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php

        include ("./requiredFiles/ajax/DBConnection.php");

        $pageshow = false;

        if (isset($_GET["user_id"]) && isset($_GET["hash_value"])) {
            $user_id = $_GET["user_id"];
            $hash_value = $_GET["hash_value"];

            $checkuseridsql = "SELECT * FROM forgetpassword WHERE user_id = '{$user_id}' && remark='pending'";
            $checkuseridres = $con->query($checkuseridsql);



            if (mysqli_num_rows($checkuseridres) == 1) {

                $row = $checkuseridres->fetch_assoc();

                if ($row["forgetpass_hash"] === $hash_value) {

                    $pageshow = true;

                } else {

                    $pageshow = false;

                }

            } else {

                $pageshow = false;

            }

        } else {
            $pageshow = false;
        }



        if ($pageshow) {
            ?>

            <style>
                body {
                    background-image: url('/img/bg.jpg');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            </style>
            <!-- Sign In Start -->
            <div class="container-fluid" style="background-image: url(./img/main-banner.jpg);">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <strong>
                            <form id="passchange">
                                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                                    <img src="./UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
                                        style="width: 200px; display: block; margin: 15px auto;">
                                    <br>
                                    <label style="color: black;" for="Userid">Change Password for <span
                                            style="color:#66e0ac"><?php echo $_GET["user_id"]; ?></span></label>
                                    <br>
                                    <br>
                                    <label for="Password">Password<span style="color: red;"> *</span></label>
                                    <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                        <input type="password" class="form-control" id="password" onclick="clearerror()"
                                            oninput="checkrepass()" placeholder=""
                                            pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}' required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    <div style="font-size:15px;color:red" class="mb-3 col-md-12">
                                        <div id="uppercase"><span style="font-size:20px">*</span> A capital (UPPERCASE) Letter &nbsp;</div>
                                        <div id="lowercase"><span style="font-size:20px">*</span> A lowercase (LOWERCASE) letter &nbsp;
                                        </div>
                                        <div id="special"><span style="font-size:20px">*</span> A Special Character &nbsp;</div>
                                        <div id="min8"><span style="font-size:20px">*</span> Minimum 8 characters &nbsp;</div>
                                    </div>
                                    <label for="rePassword">Re-enter Password<span style="color: red;"> *</span></label>
                                    <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                        <input type="password" class="form-control" id="repassword" oninput="checkrepass()"
                                            placeholder="" onclick="clearerror()" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglerePassword">
                                            <i class="bi bi-eye-slash" id="reeyeIcon"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" id="user_id" value="<?php echo $_GET["user_id"];?>">
                                    <input type="hidden" id="hashvalue" value="<?php echo $_GET["hash_value"];?>">
                                    <div id="passwordshow"><span style="font-size:20px">*</span> Minimum 8 characters &nbsp;</div>
                                    <div class="form-floating mb-3" id="errorshow">
                                    </div>
                                    
                                    <div id="changebtn">
                                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Change
                                            Password</button>
                                    </div>
                                    <a href="signin.php">
                                        <p class="text-center mb-0">Back to Login
                                    </a></p>
                                </div>
                            </form>
                        </strong>
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
        </div>

        <script>
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function () {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');
                } else {
                    passwordField.type = 'password';
                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');
                }
            });

            document.addEventListener("DOMContentLoaded", function () {
                const passwordField = document.getElementById("repassword");
                const toggleButton = document.getElementById("togglerePassword");
                const eyeIcon = document.getElementById("reeyeIcon");

                toggleButton.addEventListener("click", function () {
                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        eyeIcon.classList.remove("bi-eye-slash");
                        eyeIcon.classList.add("bi-eye");
                    } else {
                        passwordField.type = "password";
                        eyeIcon.classList.remove("bi-eye");
                        eyeIcon.classList.add("bi-eye-slash");
                    }
                });
            });
        </script>

        <?php
        } else {

            ?>

        <style>
            body {
                background-image: url('/img/bg.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>
        <!-- Sign In Start -->
        <div class="container-fluid" style="background-image: url(./img/main-banner.jpg);">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <strong>
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3" align="center">
                            <img src="./UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
                                style="width: 200px; display: block; margin: 15px auto;">
                            <br>
                            <h4 style="color: red;">You Have Invalid Link or Expired Link</span></h4>
                            <br>
                            <h5 style="color: #66e0ac;">Try Again to Get the Link</span></h5>
                            <br>
                            <div id="forgetbtn">
                                <button onclick="redirect()" class="btn btn-primary py-3 w-100 mb-4">Forgot
                                    Password</button>
                            </div>
                            <a href="signin.php">
                                <p class="text-center mb-0">Back to Login
                            </a></p>
                        </div>
                    </strong>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
        </div>

        <script>
            const redirect = () => {
                location.replace("forgot_pwd.php")
            }
        </script>

        <?php

        }
        ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="./requiredFiles/js/change_pwd.js"></script>

</body>

</html>