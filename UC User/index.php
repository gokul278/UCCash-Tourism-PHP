<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UC USER</title>
    <link rel="shortcut icon" href="./img/favicon.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->

    <!-- wthogle Web Fonts -->
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
        .packages .packages-item .packages-img {
            position: relative;
            overflow: hidden;
            transition: 0.5s;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            z-index: 1;
        }

        .packages .packages-item .packages-img .packages-info {
            background: rgba(0, 0, 0, .3);
        }

        .packages .packages-item .packages-img .packages-info small,
        .packages .packages-item .packages-img .packages-info small i {
            color: var(--bs-white);
            transition: 0.5s;
        }

        .packages .packages-item .packages-img::after {
            position: absolute;
            content: "";
            width: 0;
            height: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 0px solid;
            border-radius: 10px !important;
            visibility: hidden;
            transition: 0.7s;
            z-index: 3;
        }

        .packages .packages-item .packages-img:hover.packages-img::after {
            width: 100%;
            height: 100%;
            border: 300px solid;
            border-color: rgba(19, 53, 123, 0.6) rgba(19, 53, 123, 0.6) rgba(19, 53, 123, 0.6) rgba(19, 53, 123, 0.6);
            visibility: visible;
        }

        .packages .packages-item .packages-img small,
        .packages .packages-item .packages-img small i {
            transition: 0.5s;
        }

        .packages .packages-item .packages-img:hover small,
        .packages .packages-item .packages-img:hover small i {
            color: var(--bs-white) !important;

        }

        .packages .packages-item .packages-img img {
            transition: 0.5s;
        }

        .packages .packages-item .packages-img:hover img {
            transform: scale(1.3);
        }

        .packages .packages-item .packages-img .packages-price {
            position: absolute;
            width: 100px;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            display: inline-block;
            background: var(--bs-primary);
            color: var(--bs-white);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            z-index: 5;
        }

        .packages .packages-carousel {
            position: relative;
        }

        .packages .packages-carousel .owl-nav .owl-prev {
            position: absolute;
            top: -50px;
            left: 0;
            padding: 5px 30px;
            border: 1px solid var(--bs-primary);
            border-radius: 30px;
            transition: 0.5s;
        }

        .packages .packages-carousel .owl-nav .owl-next {
            position: absolute;
            top: -50px;
            right: 0;
            padding: 5px 30px;
            border: 1px solid var(--bs-primary);
            border-radius: 30px;
            transition: 0.5s;
        }

        .packages .packages-carousel .owl-nav .owl-prev i,
        .packages .packages-carousel .owl-nav .owl-next i {
            color: var(--bs-primary);
            font-size: 17px;
            transition: 0.5s;
        }

        .packages .packages-carousel .owl-nav .owl-prev:hover,
        .packages .packages-carousel .owl-nav .owl-next:hover {
            background: var(--bs-primary);
        }

        .packages .packages-carousel .owl-nav .owl-prev:hover i,
        .packages .packages-carousel .owl-nav .owl-next:hover i {
            color: var(--bs-white);
        }
    </style>
</head>

<body>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="p-1" style="width: 100%;" align="end">
                    <button type="button" class="close btn btn-danger" data-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <img id="flashbanner" style="width: 100%; height: 100%;" alt="image">
                </div>
            </div>
        </div>
    </div>

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
                    <a href="index.php" class="nav-item nav-link active"><i
                            class="fa fa-chart-bar me-2"></i>Dashboard</a>
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-users me-2"></i>My Team</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="genealogy.php" class="dropdown-item">Genealogy</a>
                            <a href="team list.php" class="dropdown-item">Team List</a>
                            <a href="direct member list.php" class="dropdown-item">Direct Member List</a>
                        </div>
                    </div>
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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-wallet me-2"></i>Topup Wallet</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="topupdeposite.php" class="dropdown-item">Topup Wallet Deposite</a>
                            <a href="topuphistory.php" class="dropdown-item">Topup Wallet History</a>
                        </div>
                    </div>
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
                            <a href="rewardbonus.php" class="dropdown-item">Reward Bonus</a>
                        </div>
                    </div>
                    <a href="wallet transfer.php" class="nav-item nav-link"><i
                            class="fa fa-exchange-alt me-2"></i>Wallet Transfer</a>
                    <a href="transfer.php" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer</a>
                    <a href="transfer history.php" class="nav-item nav-link"><i
                            class="fa fa-exchange-alt me-2"></i>Transfer History</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-university me-2"></i>Withdraw</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="coin withdraw.php" class="dropdown-item">Coin Withdraw</a>
                            <a href="withdraw request.php" class="dropdown-item">Withdraw Request</a>
                            <a href="withdraw history.php" class="dropdown-item">Withdraw History</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-map me-2"></i>Tour
                            Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.php" class="dropdown-item">International Booking</a>
                            <a href="domestictourbooking.php" class="dropdown-item">Domestic Booking</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bookmark me-2"></i>Booking
                            <p style="text-align: center;">History</p>
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="booking history.php" class="dropdown-item">International History</a>
                            <a href="domestictourbookinghistory.php" class="dropdown-item">Domestic history</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-tools me-2"></i>Business Tools</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <?php

                            include("../requiredFiles/ajax/DBConnection.php");

                            $getimage = $con->query("SELECT * FROM busniesstools");
                            foreach ($getimage as $rowimage) {
                                echo '<a href="../admin/img/businesstools/' . $rowimage["imagename"] . '" target="_blank" class="dropdown-item">' . $rowimage["description"] . '</a>';
                            }

                            ?>
                            <!-- <a href="./img/pdf1.pdf" target="_blank" class="dropdown-item">1 PDF </a>
                            <a href="./img/pdf2.pdf" target="_blank" class="dropdown-item">2 PDF</a>
                            <a href="./img/pdf3.pdf" target="_blank" class="dropdown-item">3 PDF</a>
                            <a href="./img/pdf4.pdf" target="_blank" class="dropdown-item">4 PDF</a> -->
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
                                Agreement</a>
                            <a href="./img/UCCASH Tourism Membership Agreement.pdf" class="dropdown-item">Membership
                                Agreement</a>
                            <a href="./img/UCCASH Tourism Indipendent Distributor Agreement.pdf"
                                class="dropdown-item">Independent Distributor<p>Agreement</p></a>
                        </div>
                    </div>
                    <a href="supports.php" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>Supports</a>
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
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2 user_profileimg" src="img/user.png" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><b class="user_name"></b></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="./logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!--user start-->

            <style type="text/css">
                body {
                    margin-top: 0px;
                    color: #1a202c;
                    text-align: left;
                    background-color: #e2e8f0;
                }

                .main-body {
                    padding: 15px;
                }

                .card {
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                }

                .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 0 solid rgba(0, 0, 0, .125);
                    border-radius: .25rem;
                }

                .card-body {
                    flex: 1 1 auto;
                    min-height: 1px;
                    padding: 1rem;
                }

                .gutters-sm {
                    margin-right: -8px;
                    margin-left: -8px;
                }

                .gutters-sm>.col,
                .gutters-sm>[class*=col-] {
                    padding-right: 8px;
                    padding-left: 8px;
                }

                .mb-3,
                .my-3 {
                    margin-bottom: 1rem !important;
                }

                .bg-gray-300 {
                    background-color: #e2e8f0;
                }

                .h-100 {
                    height: 100% !important;
                }

                .shadow-none {
                    box-shadow: none !important;
                }
            </style>


            <div class="container">
                <div class="main-body">

                    <?php
                    include("../requiredFiles/ajax/DBConnection.php");

                    $getimage = $con->query("SELECT * FROM newsimages");

                    $indicators = '';
                    $slides = '';
                    $activeClass = 'active';
                    $counter = 0;

                    foreach ($getimage as $rowimage) {
                        // Indicators
                        $indicators .= '<li data-target="#carouselExampleIndicators" data-slide-to="' . $counter . '" class="' . ($counter === 0 ? 'active' : '') . '"></li>';

                        // Slides
                        $slides .= '
        <div class="carousel-item ' . $activeClass . '">
            <img class="d-block w-100" src="../admin/img/news/' . $rowimage["imagename"] . '" alt="Slide ' . ($counter + 1) . '" style="height: 400px; object-fit: cover;">
        </div>
    ';

                        $activeClass = '';
                        $counter++;
                    }
                    ?>


                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?= $indicators ?>
                        </ol>
                        <div class="carousel-inner">
                            <?= $slides ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <br>

                    <style>
                        :root {
                            --success-bg: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
                            --progress-bg: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
                            --progress-fill: linear-gradient(to right, #ff8008, #ffc837);
                            --locked-bg: linear-gradient(90deg, #d3d3d3 0%, #e0e0e0 100%);
                            --font: 'Inter', Arial, sans-serif;
                        }

                        .reward-banner,
                        .reward-banner.in-progress {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            padding: 12px 16px;
                            border-radius: 14px;
                            font-family: var(--font);
                            margin: 16px 0;
                            animation: fadein 0.6s ease-out;
                            overflow: hidden;
                            gap: 16px;
                        }

                        .reward-banner {
                            background: var(--success-bg);
                            color: #222;
                            box-shadow: 0 4px 20px rgba(67, 233, 123, 0.1);
                        }

                        .reward-banner.in-progress {
                            background: var(--progress-bg);
                            color: #333;
                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                        }

                        .reward-banner.locked {
                            background: var(--locked-bg);
                            color: #333;
                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                        }

                        .reward-banner .content {
                            margin-left: 0px;
                            min-height: auto;
                            display: flex;
                            align-items: center;
                            background-color: transparent;
                            gap: 12px;
                            flex: 1;
                            min-width: 0;
                        }

                        .reward-icon {
                            font-size: 1.8rem;
                            animation: pop 1.2s infinite alternate;
                            filter: drop-shadow(0 0 6px #fff5);
                            margin-left: 0;
                            /* ensure no gap */
                            flex-shrink: 0;
                        }

                        .reward-banner.in-progress .reward-icon {
                            filter: drop-shadow(0 0 6px #0002);
                        }

                        .desc-group {
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            min-width: 0;
                        }

                        .desc {
                            font-size: 0.95rem;
                            line-height: 1.3;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                        }

                        .desc.bold {
                            font-weight: 600;
                        }

                        .progress-bar {
                            width: 100%;
                            height: 6px;
                            background-color: #ffe5b4;
                            border-radius: 6px;
                            overflow: hidden;
                            margin-top: 6px;
                        }

                        .progress-fill {
                            height: 100%;
                            background: var(--progress-fill);
                            transition: width 0.3s ease-in-out;
                        }

                        .reward-banner .button-link {
                            background: #fff;
                            border: none;
                            color: #000;
                            border-radius: 8px;
                            font-weight: 600;
                            font-size: 0.95rem;
                            padding: 6px 10px;
                            cursor: pointer;
                            transition: transform 0.15s ease, box-shadow 0.15s ease;
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                            display: flex;
                            align-items: center;
                            flex-shrink: 0;
                        }

                        .reward-banner button:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                        }

                        @keyframes pop {
                            to {
                                transform: scale(1.15) rotate(-5deg);
                            }
                        }

                        @keyframes fadein {
                            from {
                                opacity: 0;
                                transform: translateY(20px);
                            }

                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        /* Mobile */
                        @media (max-width: 600px) {

                            .reward-banner,
                            .reward-banner.in-progress {
                                flex-direction: column;
                                align-items: flex-start;
                                padding: 16px;
                                gap: 10px;
                            }

                            .reward-banner .content {
                                width: 100%;
                            }

                            .desc {
                                white-space: normal;
                            }

                            .reward-banner button {
                                align-self: flex-end;
                            }
                        }
                    </style>

                    <div id="rewardsBannerPlace">


                    </div>

                    <!-- ✅ Completed Reward -->
                    <!-- <div class="reward-banner">
                        <div class="content">
                            <span class="reward-icon">🎉</span>
                            <div class="desc-group">
                                <span class="desc bold">You’ve reached the 5/5 Referral Reward! You Got $25</span>
                                <span class="desc">Next Reward Starts on 2025-07-28</span>
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/rewardbonus.php" class="button-link">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div> -->

                    <!-- ✅ In Progress Reward -->
                    <!-- <div class="reward-banner in-progress">
                        <div class="content">
                            <span class="reward-icon">⏳</span>
                            <div class="desc-group">
                                <span class="desc bold">You’ve referred 3 out of 5 friends</span>
                                <span class="desc">Refer 2 more to earn your $25 reward, before (timing come here)</span>
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/referral.php" class="button-link">
                            <i class="bi bi-share-fill"></i>
                        </a>
                    </div> -->

                    <!-- ✅ Locked Reward -->
                    <!-- <div class="reward-banner locked">
                        <div class="content">
                            <span class="reward-icon">🔒</span>
                            <div class="desc-group">
                                <span class="desc bold">You need to Activate your Account</span>
                                <span class="desc">To unlock the $25 reward</span>
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/id%20activation.php" class="button-link">
                            <i class="bi bi-lightning-charge"></i>
                        </a>
                    </div> -->


                    <br>
                    <br>

                    <div class="row gutters-sm" style="justify-content: center;align-items: center;">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="img/user.png" alt="Admin" class="rounded-circle user_profileimg"
                                            style="width:150px;height:148px">
                                        <div class="mt-3">
                                            <h4 class="user_name"></h4>
                                            <p class="text-secondary mb-1"><b>USER</b></p>
                                            <br>
                                        </div>
                                        <!-- <a href="./rank%20board.php" class="mt-1" style="background-color: #2b4e6b;width:100%;display:flex;justify-content: center;padding:0px 20px; border-radius: 10px;gap:2rem">
                                            <div>
                                                <p class="mb-1 mt-1" style="color: #fff;"><b>New Car</b></p>
                                                <p class="mb-1" style="color: #fff;">7d 11h 59m 51s
                                                    +12h bonus</p>
                                            </div>
                                            <div class="text-secondary" style="display:flex;align-items: center;justify-content: center;">
                                                <i style="color: #fff;font-size: 20px;" class="bi bi-arrow-right"></i>
                                            </div>
                                        </a> -->
                                        <div id="rankboardContainer"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">ID</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary" id="user_referalStatus">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Rank</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <b id="rank"></b>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User ID</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <b id="user_id"></b>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sponser ID</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <b id="user_sponserid"></b>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Joining Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <b id="created_at"></b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!--user end-->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/topupwallet.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Topup Wallet</h5>
                                <h5 class="card-text mb-0" id="tu_points"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/coins.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Savings Travel Points</h5>
                                <h5 class="card-text mb-0" id="savingtravel"></h5>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/gift.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Bonus Travel Points</h5>
                                <h5 class="card-text mb-0" id="bonustravel"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/coupon.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Travel Coupon's</h5>
                                <h5 class="card-text mb-0" id="travelcoupon"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/bitcoin.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Savings Income</h5>
                                <h5 class="card-text mb-0" id="savingsincome"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/circle.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Networking Income</h5>
                                <h5 class="card-text mb-0" id="networkingincome"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/steps.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Leadership Income</h5>
                                <h5 class="card-text mb-0" id="leadershipincome"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/house fund.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Car & House Fund</h5>
                                <h5 class="card-text mb-0" id="carandhousefund"></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/star.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Royalty Income</h5>
                                <h5 class="card-text mb-0" id="royaltyincome"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/id.png" class="card-img-top"
                                alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">ID Reactivation Wallet</h5>
                                <h5 class="card-text mb-0" id="reactivationwallet"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/withdraw.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">Available Withdraw Balance</h5>
                                <h5 class="card-text mb-0" id="availablewithdrwabalance"></h5>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-xl-4">
                        <div class="card rounded bg-light text-center">
                            <img style="margin: auto; width: 80px; height: 80px;" src="img/UCC Wallet.png"
                                class="card-img-top" alt="Coupon Image">

                            <div class="card-body">
                                <h5 class="card-title mb-2">UCC Wallet</h5>
                                <h5 class="card-text mb-0" id="uccwallet"></h5>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>


            <br><br>


            <!-- Packages stat-->
            <div class="container-fluid packages">
                <div class="container">
                    <div class="mx-auto text-center mb-5" style="max-width: 900px;">

                        <h1 class="mb-0">Explore Our <span style="color: #f7c128;">Gallery</span></h1>
                    </div>
                    <br>
                    <div class="packages-carousel owl-carousel">
                        <?php

                        include("../requiredFiles/ajax/DBConnection.php");

                        $getimage = $con->query("SELECT * FROM galleryimages");
                        foreach ($getimage as $rowimage) {
                            echo ' <div class="packages-item">
                            <div class="packages-img">
                                <img src=".././admin/img/gallery/' . $rowimage["imagename"] . '" class="img-fluid w-100 rounded-top"
                                    alt="' . $rowimage["imagename"] . '" width="275" height="183" style="border-radius: 10px;">
                            </div>
                        </div>';
                        }

                        ?>
                    </div>
                </div>
            </div>
            <!--News Ticker Start-->

            <!-- <h3 style="text-align: center;">Latest News</h3>
            <div class="box">
                <marquee height="310" width="90%" behavior="scroll" direction="up" scrollamount="2"
                    onmouseover="this.stop();" onmouseout="this.start();">

                    <ul>
                        <p style="text-align: center;" id="news"></p>
                    </ul>
                </marquee>
            </div> -->

            <style>
                .box {
                    border: 2px solid #000;

                    width: 100%;
                }

                ul li {
                    line-height: 30px;
                    color: #007CC7;
                    font-size: 18px;
                }
            </style>
            <!--News Ticker End-->
            <br>


            <div class="text-center">
                <h6><b style="color: #000;">Developed By </b><a class="text-white" href="https://cragx.netlify.app"
                        target="_blank"><span style="color: #f7c128;"><b>Team CragX</b></span></a></h6>
            </div>






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

    <script>
        $(".packages-carousel").owlCarousel({
            autoplay: true,
            smartSpeed: 1000,
            center: false,
            dots: false,
            loop: true,
            margin: 25,
            nav: true,
            navText: [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!--user js-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <script src="./requiredFiles/js/index.js"></script>

</body>

</html>