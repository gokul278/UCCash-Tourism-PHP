<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UC USER</title>
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



    <style>
        /* Desktop view styles */
        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .genealogy-tree {
            margin-top: 20px;
            margin: 0px auto;
            max-width: 95%;
            /* Adjust the percentage as needed */
            overflow-x: auto;
        }


        .genealogy-tree ul {
            list-style: none;
            padding-top: 10px;
            padding-bottom: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .genealogy-tree li {
            text-align: center;
            position: relative;
            padding: 0;
            background-color: #fff;
            border-radius: 10px;

            transition: all 0.3s ease;
        }

        .genealogy-tree a:hover {
            transform: translateY(-5px);
        }

        .parentimg {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .childimg {
            width: 70%;
            height: 70%;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .genealogy-tree a {
            text-decoration: none;
            color: #333;
        }

        .genealogy-tree ul ul {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            margin-left: 0;
            padding-left: 0;
        }

        .genealogy-tree ul ul li {
            margin-top: 10px;
            margin: 0;
            margin-left: 5px;
            font-size: 80%;
        }

        .genealogy-tree ul ul li {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .childimg {
            width: 100px;
            /* Adjust as needed */
            height: 100px;
            /* Adjust as needed */
        }

        .genealogy-tree ul ul li:first-child {
            margin-left: 5px;
        }

        .genealogy-tree ul ul li:last-child {
            margin-right: 5px;
        }

        @media screen and (max-width: 1250px) {
            .genealogy-tree ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                padding-top: 10px;
                padding-bottom: 10px;
                justify-content: center;
                align-items: center;
                flex-wrap: nowrap;
                overflow-x: auto;
            }
        }




        /* Tooltip container */
        .genealogy-tree a {
            position: relative;
            display: inline-block;
            text-decoration: none;
            color: #333;
        }

        /* Tooltip text */
        .genealogy-tree a .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .genealogy-tree a .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        /* Show the tooltip text when hovering */
        .genealogy-tree a:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        .childimg {
            width: 60px;
            /* Adjust as needed */
            height: 60px;
            /* Maintain aspect ratio */
            margin-right: 50px;

        }

        #treedata {
            justify-content: flex-start;
        }
    </style>




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


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <img src="./img/uc logo.png" alt="UCCASH" class="navbar-brand mx-4 mb-3"
                    style="width: 150px; height: 60px;">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle user_profileimg" src="img/user.png" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 user_name"><b></b></h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-user me-2"></i>Profiles</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile.php" class="dropdown-item">Profile</a>
                            <a href="user bank details.php" class="dropdown-item">Bank & Wallet Details</a>
                            <a href="address.php" class="dropdown-item">Address</a>
                            <a href="member info.php" class="dropdown-item">Member Info</a>
                            <a href="security.php" class="dropdown-item">Security</a>
                            <!-- <a href="trans PWD.php" class="dropdown-item">Change Trans PWD</a> -->
                            <a href="id card.php" class="dropdown-item">ID Card</a>
                        </div>
                    </div>
                    <a href="referral.php" class="nav-item nav-link"><i class="fa fa-user-plus me-2"></i>Refferal
                        Link</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                class="fa fa-users me-2"></i>My Team</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="genealogy.php" class="dropdown-item active">Genealogy</a>
                            <a href="team list.php" class="dropdown-item">Team List</a>
                            <a href="direct member list.php" class="dropdown-item">Direct Member List</a>
                        </div>
                    </div>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Coupon<p style="text-align: center;" > Activation Deposit</p></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="crypto deposit.php" class="dropdown-item">Crypto Deposit</a>
                            <a href="bank deposit.php" class="dropdown-item">Bank Deposit</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-id-card me-2"></i>ID Activation<p style="text-align: center;"> Deposit</p>
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="id activation.php" class="dropdown-item">ID Activation</a>
                            <a href="id reactivation.php" class="dropdown-item">ID Reactivation</a>
                        </div>
                    </div>
                    <a href="distributor activation status.php" class="nav-item nav-link"><i
                            class="fa fa-signal me-2"></i>ID Activation <p style="text-align: center;">History</p></a>
                    <!-- <a href="coupon purchase history.php" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Coupon <p style="text-align: center;">Purchase History</p></a> -->
                    <a href="coupon usage history.php" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Travel
                        Coupon <p style="text-align: center;">Usage History</p></a>
                    <!-- <a href="monthly TP savings.php" class="nav-item nav-link"><i class="fa fa-comment-dollar me-2"></i>Monthly TP <p style="text-align: center;">Savings</p></a> -->
                    <a href="monthly TP savings status.php" class="nav-item nav-link"><i
                            class="fa fa-donate me-2"></i>Monthly TP <p style="text-align: center;">Saving History</p>
                    </a>
                    <a href="monthly savings pending invoice.php" class="nav-item nav-link"><i
                            class="fa fa-file-invoice-dollar me-2"></i>Monthly Savings <p style="text-align: center;">
                            Pending Invoice</p></a>
                    <a href="rank board.php" class="nav-item nav-link"><i class="fa fa-star me-2"></i>Rank Board</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-wallet me-2"></i>Income History</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="savings income.php" class="dropdown-item">Savings Income</a>
                            <a href="bonus travel point.php" class="dropdown-item">Bonus Travel Point</a>
                            <a href="networking income.php" class="dropdown-item">Networking Income</a>
                            <a href="leadership income.php" class="dropdown-item">Leadership Income</a>
                            <a href="car & house fund.php" class="dropdown-item">Car & House Fund</a>
                            <a href="royalty income.php" class="dropdown-item">Royalty Income</a>
                        </div>
                    </div>
                    <a href="transfer.php" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer</a>
                    <a href="transfer history.php" class="nav-item nav-link"><i
                            class="fa fa-exchange-alt me-2"></i>Transfer History</a>

                    <a href="withdraw.php" class="nav-item nav-link"><i class="fa fa-university me-2"></i>Withdraw</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-id-card me-2"></i>Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.php" class="dropdown-item">Tour Booking</a>
                            <a href="hotel booking.php" class="dropdown-item">Hotel Booking</a>
                        </div>
                    </div>
                    <a href="booking history.php" class="nav-item nav-link"><i class="fa fa-bookmark me-2"></i>Booking
                        History</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-tools me-2"></i>Business Tools</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">1 PDF </a>
                            <a href="#" class="dropdown-item">2 PDF</a>
                            <a href="#" class="dropdown-item">3 PDF</a>
                            <a href="#" class="dropdown-item">4 PDF</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-info-circle me-2"></i>Information</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./img/UCCASH Tourism Terms and Conditions.pdf" class="dropdown-item">Terms &
                                Conditions</a>
                            <a href="./img/UCCASH Tourism Privacy Policy.pdf" class="dropdown-item">Privacy Policies</a>
                            <a href="./img/UCCASH Tourism Payment Agreement.pdf" class="dropdown-item">Payment
                                Agriments</a>
                            <a href="./img/UCCASH Tourism Indipendent Distributor Agreement.pdf"
                                class="dropdown-item">Independent Distributor<p>Agreement</p></a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>Supports</a>
                    <a href="./logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>



                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2 user_profileimg" src="img/user.png" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex user_name"><b></b></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="./logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->



            <div class="genealogy-tree" style="width:100%">
                <ul>
                    <li>

                        <a href="#" id="headname" class="hover-container" title=""><img
                                class="parentimg user_profileimg" src="img/user.png"></a>
                        <div class="hover-box">
                            <p><b class="user_name"></b></p>
                            <p id="user_id"></p>
                            <select id="level" onchange="levelchange()" class="form-select">
                                <option selected value="lvl1">Level 1</option>
                                <option value="lvl2">Level 2</option>
                                <option value="lvl3">Level 3</option>
                                <option value="lvl4">Level 4</option>
                                <option value="lvl5">Level 5</option>
                                <option value="lvl6">Level 6</option>
                                <option value="lvl7">Level 7</option>
                                <option value="lvl8">Level 8</option>
                                <option value="lvl9">Level 9</option>
                            </select>
                            <!-- <p style="color:red"><a href="" style="color:red">Level 1</a>&nbsp;&nbsp;&nbsp;<a href="">Level 2</a>&nbsp;&nbsp;&nbsp;<a href="">Level 3</a>&nbsp;&nbsp;&nbsp;<a href="">Level 4</a>&nbsp;&nbsp;&nbsp;<a href="">Level 5</a>&nbsp;&nbsp;&nbsp;<a href="">Level 6</a>&nbsp;&nbsp;&nbsp;<a href="">Level 7</a>&nbsp;&nbsp;&nbsp;<a href="">Level 8</a>&nbsp;&nbsp;&nbsp;<a href="">Level 9</a></p> -->
                        </div>
                        <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i>
                    </li>

                </ul>
                <!-- treedata -->
                <ul id="treedata">

                    Loading ..

                    <!-- Add more children as needed -->
                </ul>
                </li>

            </div>



            <!--tooltip start-->

            <style></style>

            <!--tooltip end-->

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
        <!--user js-->
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"></script>

        <script src="./requiredFiles/js/genealogy.js"></script>
</body>

</html>