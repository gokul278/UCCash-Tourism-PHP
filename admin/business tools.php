<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Business Tools</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/favicon.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

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


    <!-- Simple Notifier -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>

    <style>
        #fileName1,
        #fileName2,
        #fileName3,
        #fileName4 {
            display: inline-block;
            max-width: 200px;
            /* Adjust the max-width as needed */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
            margin-left: 10px;
            /* Space between the label and the file name */
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user me-2"></i>Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle profile_image" src="img/user.png" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 adminname"></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i><b>Dashboard</b></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i><b>Edit Details</b></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile.php" class="dropdown-item"><b>Edit Profile</b></a>
                            <a href="news upload.php" class="dropdown-item"><b>News Upload</b></a>
                            <a href="flash banner.php" class="dropdown-item"><b>Flash Banner Upload</b></a>
                            <a href="gallery.php" class="dropdown-item"><b>Gallery Update</b></a>
                            <a href="savings TP today value.php" class="dropdown-item"><b>Saving's TP Today<p> Value
                                        Edit</p></b></a>
                            <a href="uccvaluedepoist.php" class="dropdown-item"><b>UCC Value Deposit</b></a>
                        </div>
                    </div>
                    <a href="members details.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Member's <p
                            style="text-align: center;">Details</p></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-id-card me-2"></i>ID Activation</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="crypto deposit.php" class="dropdown-item">Crypto Deposit</a>
                            <a href="bank deposit.php" class="dropdown-item">Bank Deposit</a>
                            <a href="travel coupon activation.php" class="dropdown-item">ID Activation</a>
                            <a href="travel coupon approval.php" class="dropdown-item">ID Activation Approval</a>
                            <a href="travel coupon purchase history.php" class="dropdown-item">ID Activation History</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-donate me-2"></i>Monthly TP<p style="text-align: center;"> Savings</p></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="monthly tp savings.php" class="dropdown-item">Monthly TP Saving's <p>Approval</p>
                            </a>
                            <a href="monthly TP savings history.php" class="dropdown-item">Monthly TP Saving's <p>
                                    History</p></a>
                        </div>
                    </div>
                    <a href="travel coupon usage history.php" class="nav-item nav-link"><i
                            class="fa fa-star me-2"></i>Travel Coupon<p style="text-align: center;">Usage History</p>
                    </a>
                    <a href="bonus travel point usage history.php" class="nav-item nav-link"><i
                            class="fa fa-gift me-2"></i>Bonus Travel<p style="text-align: center;"> Point Usage History
                        </p></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-wallet me-2"></i>Withdraw</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="withdraw approval.php" class="dropdown-item">Withdraw Approval</a>
                            <a href="withdraw history.php" class="dropdown-item">Withdraw History</a>
                        </div>
                    </div>
                    <a href="wallet transfer report.php" class="nav-item nav-link"><i
                            class="fa fa-money-bill me-2"></i>Wallet Trasfer<p style="text-align: center;"> Report</p>
                    </a>
                    <a href="ranking board.php" class="nav-item nav-link"><i class="fa fa-signal me-2"></i>Ranking
                        Board</a>
                    <a href="tour destination edit.php" class="nav-item nav-link "><i class="far fa-map me-2"></i>Tour<p
                            style="text-align: center;">Destinations</p></a>
                    <a href="tour booking history.php" class="nav-item nav-link"><i class="fa fa-bookmark me-2"></i>Tour
                        Booking<p style="text-align: center;"> History</p></a>
                    <!-- <a href="hotel booking edit.php" class="nav-item nav-link"><i class="fa fa-bookmark me-2"></i>Hotel
                        Booking<p style="text-align: center;"> Edit</p></a>
                    <a href="hotel booking history.php" class="nav-item nav-link"><i
                            class="fa fa-bookmark me-2"></i>Hotel Booking<p style="text-align: center;"> History</p></a> -->
                    <a href="members income balance sheet.php" class="nav-item nav-link"><i
                            class="fa fa-file-invoice-dollar me-2"></i>Member's<p style="text-align: center;">Income
                            Balance Sheet</p></a>
                    <a href="company balance sheet.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Company<p
                            style="text-align: center;"> Balance Sheet</p></a>
                    <a href="member's bonus TP balance sheet.php" class="nav-item nav-link"><i
                            class="fa fa-file-invoice-dollar me-2"></i>Member's<p style="text-align: center;"> Bonus
                            Travel Point Balance Sheet</p></a>
                    <a href="fast start report.php" class="nav-item nav-link"><i class="fa fa-file-alt me-2"></i>Fast
                        Start<p style="text-align: center;"> Report</p></a>
                    <a href="business tools.php" class="nav-item nav-link active"><i
                            class="fa fa-tools me-2"></i>Business Tools</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-info-circle me-2"></i>Information</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="terms & conditions.php" class="dropdown-item">Terms & Condition</a>
                            <a href="privacy policies.php" class="dropdown-item">Privacy Policies</a>
                            <a href="payment agreements.php" class="dropdown-item">Payment Agreements</a>
                            <a href="independent distributor agreement.php" class="dropdown-item">Independent
                                Distributor<p> Agreements</p></a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Support Mails</a>
                    <a href="travel coupon balance sheet.php" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Travel Coupon <p style="text-align: center;">Balance Sheet</p></a>
                    <a href="savings TP balance sheet.php" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Saving's Travel<p style="text-align: center;"> Point Balance Sheet
                        </p></a>
                    <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span style="color: #fff;" class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2 profile_image" src="img/user.png" alt=""
                                style="width: 40px; height: 40px;">
                            <span style="color: #fff;" class="d-none d-lg-inline-flex adminname"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0"
                            style="color: white;">
                            <a href="admin settings.php" class="dropdown-item">My Profile</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <br><br>

            <!-- Blank Start -->
            <div style="text-align: center;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-secondary rounded h-auto p-4 m-5" style="display: inline-block;">
                                <h4 style="color: #f7c128;" class="mb-5">Business Tools</h4>
                                <form id="submitpdf1">
                                    <div class="mb-3" style="margin-bottom: 15px; max-width: 300px;">
                                        <label for="formFileMultiple1" style="font-weight: bold; color: #fff;">Upload
                                            PDF
                                            1</label>
                                        <br><br>
                                        <div
                                            style="background-color: #000; border: 1px solid #ccc; border-radius: 5px; padding: 50px;">
                                            <input class="form-control" type="file" id="formFileMultiple1" accept=".pdf"
                                                onchange="displayFileName(1)" name="pdffile" style="display: none;">
                                            <label for="formFileMultiple1"
                                                style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;">Choose
                                                PDF File</label>
                                            <span id="fileName1" style="margin-left: 10px;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="way" value="pdf1">
                                    <button type="submit" id="submitbtn1" class="btn btn-primary"
                                        disabled>Update</button>
                                </form>
                            </div>
                            <div class="bg-secondary rounded h-auto p-4 m-5" style="display: inline-block;">
                                <h4 style="color: #f7c128;" class="mb-5">Business Tools</h4>
                                <form id="submitpdf2">
                                    <div class="mb-3" style="margin-bottom: 15px; max-width: 300px;">
                                        <label for="formFileMultiple2" style="font-weight: bold; color: #fff;">Upload
                                            PDF
                                            2</label>
                                        <br><br>
                                        <div
                                            style="background-color: #000; border: 1px solid #ccc; border-radius: 5px; padding: 50px;">
                                            <input class="form-control" type="file" id="formFileMultiple2" accept=".pdf"
                                                onchange="displayFileName(2)" name="pdffile" style="display: none;">
                                            <label for="formFileMultiple2"
                                                style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;">Choose
                                                PDF File</label>
                                            <span id="fileName2" style="margin-left: 10px;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="way" value="pdf2">
                                    <button type="submit" class="btn btn-primary" id="submitbtn2"
                                        disabled>Update</button>
                                </form>
                            </div>
                            <div class="bg-secondary rounded h-auto p-4 m-5" style="display: inline-block;">
                                <form id="submitpdf3">
                                    <h4 style="color: #f7c128;" class="mb-5">Business Tools</h4>
                                    <div class="mb-3" style="margin-bottom: 15px; max-width: 300px;">
                                        <label for="formFileMultiple3" style="font-weight: bold; color: #fff;">Upload
                                            PDF
                                            3</label>
                                        <br><br>
                                        <div
                                            style="background-color: #000; border: 1px solid #ccc; border-radius: 5px; padding: 50px;">
                                            <input class="form-control" type="file" id="formFileMultiple3" accept=".pdf"
                                                onchange="displayFileName(3)" name="pdffile" style="display: none;">
                                            <label for="formFileMultiple3"
                                                style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;">Choose
                                                PDF File</label>
                                            <span id="fileName3" style="margin-left: 10px;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="way" value="pdf3">
                                    <button type="submit" class="btn btn-primary" id="submitbtn3"
                                        disabled>Update</button>
                                </form>
                            </div>
                            <div class="bg-secondary rounded h-auto p-4 m-5" style="display: inline-block;">
                                <form id="submitpdf4">
                                    <h4 style="color: #f7c128;" class="mb-5">Business Tools</h4>
                                    <div class="mb-3" style="margin-bottom: 15px; max-width: 300px;">
                                        <label for="formFileMultiple4" style="font-weight: bold; color: #fff;">Upload
                                            PDF
                                            4</label>
                                        <br><br>
                                        <div
                                            style="background-color: #000; border: 1px solid #ccc; border-radius: 5px; padding: 50px;">
                                            <input class="form-control" type="file" id="formFileMultiple4" accept=".pdf"
                                                onchange="displayFileName(4)" name="pdffile" style="display: none;">
                                            <label for="formFileMultiple4"
                                                style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;">Choose
                                                PDF File</label>
                                            <span id="fileName4" style="margin-left: 10px;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="way" value="pdf4">
                                    <button type="submit" class="btn btn-primary" id="submitbtn4"
                                        disabled>Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Blank End -->


        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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

    <script>
        function displayFileName(fileNumber) {
            var input = document.getElementById('formFileMultiple' + fileNumber);
            var fileNameSpan = document.getElementById('fileName' + fileNumber);
            fileNameSpan.textContent = input.files[0].name;
            if (fileNameSpan.textContent.length >= 1) {
                $("#submitbtn" + fileNumber).prop("disabled", false);
            } else {
                $("#submitbtn" + fileNumber).prop("disabled", true);
            }
        }

    </script>

    <script src="./requiredFiles/js/businesstools.js"></script>
</body>

</html>