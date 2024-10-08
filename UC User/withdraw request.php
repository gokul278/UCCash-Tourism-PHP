<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UC USER</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/favicon.png">

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

    <!-- Simple Notifier -->
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-users me-2"></i>My Team</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="genealogy.php" class="dropdown-item">Genealogy</a>
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
                    <a href="wallet transfer.php" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Wallet Transfer</a>
                    <a href="transfer.php" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer</a>
                    <a href="transfer history.php" class="nav-item nav-link"><i
                            class="fa fa-exchange-alt me-2"></i>Transfer History</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                class="fa fa-university me-2"></i>Withdraw</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="coin withdraw.php" class="dropdown-item">Coin Withdraw</a>
                            <a href="withdraw request.php" class="dropdown-item active">Withdraw Request</a>
                            <a href="withdraw history.php" class="dropdown-item">Withdraw History</a>
                        </div>
                    </div>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-id-card me-2"></i>Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.php" class="dropdown-item">Tour Booking</a>
                            <a href="hotel booking.php" class="dropdown-item">Hotel Booking</a>
                        </div>
                    </div> -->
                    <a href="tour booking.php" class="nav-item nav-link"><i class="far fa-map me-2"></i>Tour
                        Booking</a>
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
                            <span class="d-none d-lg-inline-flex user_name"><b></b></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="./logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!--user start-->

            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 500px;
                    margin: 0 auto;
                    padding: 20px;
                }

                .card {
                    background-color: #fff;
                    border-radius: 5px;
                    padding: 20px;
                    text-align: center;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .profile-picture {
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                    overflow: hidden;
                    margin: 0 auto 20px;
                }

                .profile-picture img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .name {
                    font-size: 24px;
                    margin: 0;
                }

                .username {
                    font-size: 18px;
                    color: #777;
                    margin: 10px 0;
                }

                .tagline,
                .description {
                    color: #555;
                    margin: 10px 0;
                }

                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #075175;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: background-color 0.3s;
                }

                .button:hover {
                    background-color: #f7c128;
                }

                /* Add this CSS in your stylesheet or in a <style> tag within your HTML */
                .small-textbox {
                    width: 70%;
                    /* Adjust the width as needed */
                    padding: 0.375rem 0.75rem;
                    /* Adjust the padding as needed */
                    font-size: 0.875rem;
                    /* Adjust the font size as needed */
                }

                @keyframes runningBalance {
                    0% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-5px);
                    }

                    100% {
                        transform: translateY(0);
                    }
                }

                .running-balance {
                    color: #f7c128;
                    animation: runningBalance 2s infinite;
                    /* Adjust the animation duration as needed */
                }





                .center-container {
                    text-align: center;
                }
            </style>
            <!--user end-->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="d-flex justify-content-center">
                        <div class="col-sm-12 col-xl-6">

                            <div class="bg-light rounded h-100 p-4">
                                <div class="container">
                                    <div class="card">
                                        <h2 class="">Available Balance</h2>
                                        <h2 class="running-balance mt-2">
                                            <p id="availablewithdrwabalance"></p>
                                        </h2>
                                        <h6 id="minwithdraw">Minimum Withdraw 50$</h6>
                                    </div>
                                </div>

                                <br>
                                <h6 class="mb-4">Withdraw Type</h6>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation" onclick="changeminbank()">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Crypto</button>
                                    </li>
                                    <li class="nav-item" role="presentation" onclick="changemincrypto()">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile"  aria-selected="false">Bank Acc</button>
                                    </li>
                                </ul>
                                <strong id="payoption">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">

                                            <div class="mb-3">
                                                <label for="cryptoType" class="form-label">Crypto Type:</label>
                                                <input type="text" class="form-control" id="walletAddress"
                                                    placeholder="Enter your crypto wallet address" disabled
                                                    value="USDT (TRC20)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="walletAddress" class="form-label">Crypto Wallet
                                                    Address:</label>
                                                <input type="text" class="form-control" id="trc20_address"
                                                    placeholder="Enter your crypto wallet address" disabled required>
                                            </div>
                                            <form id="cryptosubmit">
                                                <input type="hidden" name="way" value="cryptowithdraw">
                                                <div class="mb-3">
                                                    <label for="WithdrawAmount" class="form-label">Withdraw
                                                        Amount:</label>
                                                    <input type="text" class="form-control" id="cryptovalue"
                                                        name="withdrawvalue" onclick="clearmsgcrypto()"
                                                        placeholder="Enter your Withdraw amount" oninput="checkcrypto()"
                                                        required>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="otp">Enter OTP</label>
                                                        <input class="form-control" id="otpvalue1" name="otp"
                                                            onclick="clearmsgcrypto()" type="number"
                                                            placeholder="Enter OTP" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" id="cryptootpbtn" onclick="cryptootp()"
                                                            style="width:100%;height:40px;margin-top:25px"
                                                            class="btn btn-primary" disabled>Get OTP</button>
                                                    </div>
                                                </div>

                                                <div style="color:red;width:100%" id="errormsgcrypto" align="center"
                                                    class="mb-3"></div>

                                                <div class="center-container">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="cryptowiithdrawbtn" disabled>Withdraw</button>
                                                </div>
                                            </form>
                                        </div>



                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab">
                                            <div class="mb-3">
                                                <label for="bankName" class="form-label">Bank Name:</label>
                                                <input type="text" class="form-control" id="ac_bankname"
                                                    placeholder="Enter the name of your bank" disabled required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="accountHolder" class="form-label">Account Holder's
                                                    Name:</label>
                                                <input type="text" class="form-control" id="ac_holdername"
                                                    placeholder="Enter the account holder's name" disabled required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="accountNumber" class="form-label">Account
                                                    Number:</label>
                                                <input type="text" class="form-control" id="ac_number"
                                                    placeholder="Enter the account number" disabled required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="IFSC" class="form-label">IFSC:</label>
                                                <input type="text" class="form-control" id="ifsc_code"
                                                    placeholder="Enter the IFSC code" disabled required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="branch" class="form-label">Branch:</label>
                                                <input type="text" class="form-control" id="branch"
                                                    placeholder="Enter the branch name" disabled required>
                                            </div>
                                            <form id="banksubmit">
                                                <input type="hidden" name="way" value="bankwithdraw">
                                                <div class="mb-3">
                                                    <label for="WithdrawAmount" class="form-label">Withdraw Amount with
                                                        Dollar:</label>
                                                    <input type="text" class="form-control" id="bankvalue"
                                                        name="withdrawvalue" placeholder="Enter your Withdraw amount"
                                                        oninput="checkbank()" onclick="clearmsgbank()" required>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="otpvalue2">Enter OTP</label>
                                                        <input class="form-control" id="otpvalue2" name="otp"
                                                            name="inputFirstName" onclick="clearmsgbank()" type="number" placeholder="Enter OTP"
                                                            required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" id="bankotpbtn" onclick="bankotp()"
                                                            style="width:100%;height:40px;margin-top:25px"
                                                            class="btn btn-primary" disabled>Get OTP</button>
                                                    </div>
                                                </div>
                                                <div style="color:red;width:100%" id="errormsgbank" align="center"
                                                    class="mb-3"></div>
                                                <div class="center-container">
                                                    <button type="submit" class="btn btn-primary" id="bankwithdrawbtn"
                                                        disabled>Withdraw</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </strong>
                            </div>
                        </div>



                    </div>

                </div>

                <br><br>
                <!--News Ticker Start-->


                <!--News Ticker End-->





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
        <!--user js-->

        <script src="./requiredFiles/js/withdrawrequest.js"></script>

</body>

</html>