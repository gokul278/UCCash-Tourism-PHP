<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Withdraw Approval</title>
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                class="fa fa-wallet me-2"></i>Withdraw</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="withdraw approval.php" style="color:#f7c128" class="dropdown-item active">Withdraw
                                Approval</a>
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
                    <a href="adminbalancewithdraw.php" class="nav-item nav-link"><i
                            class="fa fa-university me-2"></i>Admin
                        Balance<p style="text-align: center;"> Withdraw</p></a>
                    <a href="business tools.php" class="nav-item nav-link"><i class="fa fa-tools me-2"></i>Business
                        Tools</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-info-circle me-2"></i>Information</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="terms & conditions.php" class="dropdown-item">Terms & Condition</a>
                            <a href="privacy policies.php" class="dropdown-item">Privacy Policies</a>
                            <a href="payment agreements.php" class="dropdown-item">Payment Agreements</a>
                            <a href="membership agreements.php" class="dropdown-item">Membership Agreements</a>
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
            <!--Table Start-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h4 style="color: #f7c128;" class="mb-5">Withdraw Approval</h4>
                            <div class="table-responsive">
                                <strong>
                                    <table id="myTable" style="text-align: center;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.NO</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Withdraw Amount</th>
                                                <th scope="col">Admin Fee 5%</th>
                                                <th scope="col">Re Topup Activation 5%</th>
                                                <th scope="col">Net Amount</th>
                                                <th scope="col">To Withdraw</th>
                                                <th scope="col">Approve</th>
                                                <th scope="col">Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">

                                        </tbody>
                                    </table>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->

            <style>
                .table-bordered {
                    border-color: #fff;
                }
            </style>

        </div>
        <!-- Content End -->
        <!--Model Start-->


        <style>
            /* Form Styles */
            /* Form Styles */
            .custom-form {
                background-color: rgb(25, 28, 36);
                /* Set background color */
                padding: 20px;
                /* Add padding for better visibility */
                border-radius: 10px;
                /* Add border radius for rounded corners */
            }

            .disabled-input {
                background-color: #222d32 !important;
                color: #191c24;
                /* Optional: Change text color to make it more visible */
            }

            input[type="date"]::-webkit-calendar-picker-indicator {
                filter: invert(1);
            }
        </style>

        <!--Model End-->

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>


    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <script src="./requiredFiles/js/withdrawapproval.js"></script>

</body>

</html>