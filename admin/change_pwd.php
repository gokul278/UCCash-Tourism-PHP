<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Change PWD</title>
    <link rel="shortcut icon" href="./img/favicon.png">

    <link rel="shortcut icon" href="./img/favicon.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


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
    <link href="../UC User/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../UC User/css/style.css" rel="stylesheet">

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

        include ("../requiredFiles/ajax/DBConnection.php");

        $pageshow = false;

        if (isset($_GET["hash_value"])) {
            $hash_value = $_GET["hash_value"];

            $checkuseridsql = "SELECT * FROM admindetails WHERE admin_id = 'UCT000000' && admin_remark='pending'";
            $checkuseridres = $con->query($checkuseridsql);



            if (mysqli_num_rows($checkuseridres) == 1) {

                $row = $checkuseridres->fetch_assoc();

                if ($row["admin_forgetpasshash"] === $hash_value) {

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
                    background-color: #000;
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            </style>
            <!-- Sign In Start -->
            <div class="container-fluid" style="background-color: #000;">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <strong>
                            <form id="passchange">
                                <div class="rounded p-4 p-sm-5 my-4 mx-3" style="background-color: #191C24;">
                                    <img src="../UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
                                        style="width: 200px; display: block; margin: 15px auto;">
                                    <br>
                                    <label style="color: #fff;" for="Userid">Change Password for <span
                                            style="color:#66e0ac">Admin</span></label>
                                    <br>
                                    <br>
                                    <label for="Password">Password<span style="color: red;"> *</span></label>
                                    
                                    <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                        <input type="password" class="form-control" id="password" onclick="clearerror()"
                                            oninput="checkrepass()" placeholder="" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    <label for="rePassword">Re-enter Password<span style="color: red;"> *</span></label>
                                    <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                        <input type="password" class="form-control" id="repassword" oninput="checkrepass()"
                                            placeholder="" onclick="clearerror()" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglerePassword">
                                            <i class="bi bi-eye-slash" id="reeyeIcon"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="hashvalue" value="<?php echo $_GET["hash_value"];?>">
                                    <input type="hidden" name="way" value="changepass">
                                    <div class="form-floating mb-3" id="errorshow">
                                    </div>
                                    
                                    <div id="changebtn">
                                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" id="changestatus" disabled>Change
                                            Password</button>
                                    </div>
                                    <a href="index.php">
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
                background-color: #000;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>
        <!-- Sign In Start -->
        <div class="container-fluid" style="background-color: #000;">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <strong>
                        <div class="rounded p-4 p-sm-5 my-4 mx-3" align="center" style="background-color: #191C24;">
                            <img src="../UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
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
                            <a href="index.php">
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