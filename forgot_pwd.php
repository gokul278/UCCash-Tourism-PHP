<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forgot PWD</title>
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
                        <form id="forgetpass">
                            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                                <img src="./UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
                                    style="width: 200px; display: block; margin: 15px auto;">
                                <br>
                                <label style="color: black;" for="Userid">Forgot Password</label>
                                <br>
                                <div class="form-floating mb-3" onclick="clearerror()">
                                    <input type="text" class="form-control" id="userid" placeholder="name@example.com"
                                        required>
                                    <label for="userid">User ID</label>
                                </div>
                                <div class="form-floating mb-3" id="errorshow" >
                                </div>
                                <div id="forgetbtn">
                                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send Mail</button>
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

    <!-- JavaScripting Page -->
    <script src="./requiredFiles/js/forgetpassword.js"></script>
</body>

</html>