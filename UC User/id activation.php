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


    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <style>
        .btn-custom-color {
            background-color: #075175 !important;
            border-color: #075175 !important;
        }

        .btn-custom-color:hover {
            background-color: #064e64 !important;
            border-color: #064e64 !important;
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                class="fa fa-id-card me-2"></i>ID Activation<p style="text-align: center;"> Deposit</p>
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="id activation.php" class="dropdown-item active">ID Activation</a>
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-university me-2"></i>Withdraw</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="coin withdraw.php" class="dropdown-item">Coin Withdraw</a>
                            <a href="withdraw request.php" class="dropdown-item">Withdraw Request</a>
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
                .page-container {
                    /* text-align: center; */
                    margin-top: 50px;
                    /* Adjust as needed */
                }

                .page {
                    display: none;
                    margin-top: 20px;
                    /* Adjust as needed */
                }

                .page.active {
                    display: block;
                }

                .toggle-button-container {
                    margin-top: 20px;
                    /* Adjust as needed */
                    text-align: center;
                }

                .toggle-button {
                    background-color: #f7c128;
                    /* Green */
                    border: none;
                    color: white;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px;
                    cursor: pointer;
                    border-radius: 5px;
                }

                .toggle-button-alt {
                    background-color: #075175;
                    /* Blue */
                }
            </style>


            <style type="text/css">
                body {

                    background-color: #f2f6fc;
                    color: #69707a;
                }

                .img-account-profile {
                    height: 10rem;
                }

                .rounded-circle {
                    border-radius: 50% !important;
                }

                .card {
                    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
                }

                .card .card-header {
                    font-weight: 500;
                }

                .card-header:first-child {
                    border-radius: 0.35rem 0.35rem 0 0;
                }

                .card-header {
                    padding: 1rem 1.35rem;
                    margin-bottom: 0;
                    background-color: rgba(33, 40, 50, 0.03);
                    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
                }

                .form-control,
                .dataTable-input {
                    display: block;
                    width: 100%;
                    padding: 0.875rem 1.125rem;
                    font-size: 0.875rem;
                    font-weight: 400;
                    line-height: 1;
                    color: #000;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 3px solid #075175;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
                    border-radius: 0.35rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .nav-borders .nav-link.active {
                    color: #0061f2;
                    border-bottom-color: #0061f2;
                }

                .nav-borders .nav-link {
                    color: #69707a;
                    border-bottom-width: 0.125rem;
                    border-bottom-style: solid;
                    border-bottom-color: transparent;
                    padding-top: 0.5rem;
                    padding-bottom: 0.5rem;
                    padding-left: 0;
                    padding-right: 0;
                    margin-left: 1rem;
                    margin-right: 1rem;
                }

                .copy-button {
                    border: 3px solid black;
                }

                .paste-button {
                    border: 3px solid black;
                }
            </style>

            <style type="text/css">
                body {
                    background: #f7f7ff;
                    margin-top: 0px;
                }

                .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 0 solid transparent;
                    border-radius: .25rem;
                    margin-bottom: 1.5rem;
                    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
                }

                .me-2 {
                    margin-right: .5rem !important;
                }
            </style>

            <!--user end-->

            <!-- Sale & Revenue Start -->

            <div class="toggle-button-container">
                <button id="toggle-button-1" class="toggle-button" onclick="showPage('page1')"><b>Crypto
                        Deposit</b></button>
                <button id="toggle-button-2" class="toggle-button toggle-button-alt" onclick="showPage('page2')"><b>Bank
                        Deposit</b></button>
            </div>

            <div id="pagecontent" class="page-container">
                <div id="page1" class="page active">
                    <!-- Content of page 1 -->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <div class="col-xl-8 mx-auto">
                                <div class="card mb-4">
                                    <div class="card-header">Crypto Deposit</div>
                                    <div class="card-body">
                                        <strong>
                                            <form id="activationcrypto" style="color: #000;">
                                                <div class="col-md-6 mx-auto text-center">
                                                    <img id="imgaddress" src="" alt="Profile Image"
                                                        class="img-fluid mx-auto d-block mb-3"
                                                        style="max-width: 35%; height:40%;">
                                                    <p>USDT (TRC20)</p>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6 mx-auto">
                                                        <label class="small mb-1" for="deposit address">Deposit
                                                            Address</label>
                                                        <div class="input-group">
                                                            <span class="form-control" id="deposit address"></span>
                                                            <button class="btn btn-outline-secondary copy-button"
                                                                type="button"
                                                                onclick="copyText('deposit address')"><b>Copy</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3 justify-content-center">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="deposit value">Deposit
                                                            Value</label>
                                                        <input class="form-control" id="deposit value" type="text"
                                                            placeholder="Enter Deposit Value" readonly>
                                                        <input type="hidden" name="cryptovalue" id="cryptovalue">
                                                        <input type="hidden" name="user_id" id="user_id">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="way" value="cryptoaddress">
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6 mx-auto">
                                                        <label class="small mb-1" for="pasteBox">TXN Hash ID</label>
                                                        <div class="copy-paste-box input-group">
                                                            <textarea class="form-control" name="txnhashid"
                                                                id="pasteBox" placeholder="Paste here"
                                                                required></textarea>
                                                            <button class="btn btn-outline-secondary paste-button"
                                                                type="button"
                                                                onclick="pasteContent()"><b>Paste</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="page2" class="page">
                    <!-- Content of page 2 -->
                    <div class="container mx-auto">
                        <div class="main-body">
                            <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h6 style="color: #69707a;" class="mb-4">Bank Deposit</h6>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">A/C Holder Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="input-group">
                                                        <span class="form-control" id="ac_holdername"></span>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="copyholdername()"><b>Copy</b></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">A/C Number</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="input-group">
                                                        <span class="form-control" id="ac_number"></span>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="copyaccnum()"><b>Copy</b></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">IFS Code</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="input-group">
                                                        <span class="form-control" id="ifsc_code"></span>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="copyifsc()"><b>Copy</b></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Branch</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <span class="form-control" id="branch"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">UPI ID</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="input-group">
                                                        <span class="form-control" id="upi_id"></span>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="copyUpiId()"><b>Copy</b></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <div class="dropdown">
                                                        <button class="btn btn-custom-color" type="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="color: #fff;">
                                                            <b>Show QR</b>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <div class="dropdown-item" id="qrContainer"
                                                                style="background-color: #fff;">
                                                                <img src="" id="bankaddress" alt="QR Code"
                                                                    style="width:250px; height: 280px; align-items: center; border-radius: 10px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <form id="activationbank">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Deposit Value</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <span class="form-control" id="deposit_value"></span>
                                                        </div>
                                                    </div>
                                                    <br><br><br>

                                                    <input type="hidden" name="way" value="activationbank">
                                                    <input type="hidden" name="user_id" id="userid">
                                                    <input type="hidden" name="depositevalue" id="bankvalue">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Transaction ID</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="text" name="transaction_id"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3" style="margin-bottom: 15px;">
                                                        <label for="formFileMultiple"
                                                            style="font-weight: bold; color: #333;">Upload Payment
                                                            Proof</label>
                                                        <div
                                                            style="background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
                                                            <input class="form-control" type="file"
                                                                id="formFileMultiple" accept="image/*"
                                                                style="display: none;" name="proofimage" required>
                                                            <label for="formFileMultiple"
                                                                style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;">Choose
                                                                Image</label>
                                                            <span id="fileName" style="margin-left: 10px;"></span>
                                                        </div>
                                                    </div>

                                                    <br><br><br>

                                                    <div class="row">
                                                        <div class="col-sm-3"></div>
                                                        <div
                                                            class="col-sm-9 text-secondary d-flex justify-content-center">
                                                            <input type="submit" class="btn btn-primary px-4"
                                                                value="Submit">
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
                        <script type="text/javascript"></script>





                        <!-- Content End -->


                        <!-- Back to Top -->
                        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                                class="bi bi-arrow-up"></i></a>
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
                    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script type="text/javascript"></script>

                    <script>
                        function showPage(pageId) {
                            var pages = document.querySelectorAll('.page');
                            pages.forEach(function (page) {
                                if (page.id === pageId) {
                                    page.classList.add('active');
                                } else {
                                    page.classList.remove('active');
                                }
                            });

                            var buttons = document.querySelectorAll('.toggle-button');
                            buttons.forEach(function (button) {
                                if (button.id === 'toggle-button-' + pageId.slice(-1)) {
                                    button.classList.add('active');
                                } else {
                                    button.classList.remove('active');
                                }
                            });
                        }
                    </script>



                    <script>
                        function pasteContent() {
                            // Get the textarea element
                            var pasteBox = document.getElementById('pasteBox');

                            // Get the clipboard data
                            navigator.clipboard.readText()
                                .then((clipboardData) => {
                                    // Set the clipboard content to the textarea
                                    pasteBox.value = clipboardData;
                                })
                                .catch((err) => {
                                    console.error('Failed to read clipboard content: ', err);
                                });
                        }
                    </script>


                    <script>
                        function copyText(elementId) {
                            var element = document.getElementById(elementId);

                            // Create a range to select the text
                            var range = document.createRange();
                            range.selectNode(element);

                            // Select the text
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(range);

                            // Copy to clipboard
                            document.execCommand("copy");

                            // Deselect the text
                            window.getSelection().removeAllRanges();

                            // Display alert
                            showAlert("Text copied: " + element.innerText);
                        }

                        function showAlert(message) {
                            alert(message);
                        }
                    </script>




                    <script>
                        function copyUpiId() {
                            var copyText = document.getElementById("upiId");
                            var tempInput = document.createElement("input");
                            tempInput.value = copyText.textContent;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("UPI ID copied: " + tempInput.value);
                        }
                    </script>

                    <script>
                        function copyholdername() {
                            var copyText = document.getElementById("holdername");
                            var tempInput = document.createElement("input");
                            tempInput.value = copyText.textContent;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("Holder Name copied: " + tempInput.value);
                        }
                    </script>

                    <script>
                        function copyaccnum() {
                            var copyText = document.getElementById("accnum");
                            var tempInput = document.createElement("input");
                            tempInput.value = copyText.textContent;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("A/C Number copied: " + tempInput.value);
                        }
                    </script>

                    <script>
                        function copyifsc() {
                            var copyText = document.getElementById("ifsc");
                            var tempInput = document.createElement("input");
                            tempInput.value = copyText.textContent;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("IFSC Code copied: " + tempInput.value);
                        }
                    </script>

                    <script>
                        document.getElementById('formFileMultiple').addEventListener('change', function () {
                            document.getElementById('fileName').textContent = this.files[0].name;
                        });
                    </script>
                    <!--user js-->

                    <script src="./requiredFiles/js/idactivation.js"></script>
</body>

</html>