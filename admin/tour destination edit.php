<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tour Destination Edit</title>
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
        .file-input-container {
            display: block;
            width: 100%;
            max-width: 423px;
            height: 70px;
            padding: 10px;
            border: 3px solid white;
            border-radius: 5px;
            background-color: #000;
            text-align: center;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
            position: relative;
        }

        .file-input-container::before {
            content: attr(data-placeholder);
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: calc(100% - 20px);
        }

        .file-input-container input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-input-container:hover {
            border: 3px solid #f7c128;
            background-color: #000;
            color
        }

        .file-input-container.file-selected::after {
            content: attr(data-filename);
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: calc(100% - 20px);
            font-size: 14px;
            color: #f7c128;
        }

        input[readonly] {
            background-color: black !important;
            color: white !important;
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
                    <a href="tour destination edit.php" class="nav-item nav-link active"><i
                            class="far fa-map me-2"></i>Tour<p style="text-align: center;">Destinations</p></a>
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
                            <a href="admin settings.html" class="dropdown-item">My Profile</a>
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
                            <h4 style="color: #f7c128;" class="mb-5">Tour Destination Edit</h4>

                            <div class="table-responsive">
                                <div class="container">
                                    <br>
                                    <button id="addTableRow" class="btn btn-primary mb-3 float-right"
                                        data-toggle="modal" data-target="#exampleModal" style="color: #000;">Add
                                        Table</button>
                                    <!--Model Start-->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">
                                                        Add Tour Destination Details</h5>
                                                    <button type="button" class="close btn btn-danger"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <strong>
                                                        <form class="custom-form" id="newdestination">
                                                            <div class="mb-3" style="margin-bottom: 15px;">
                                                                <div class="image-upload-model">
                                                                    <!-- Image 1 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Thumbnail"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="thumbnail" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                    <!-- Image 2 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Image1"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="image1" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                    <!-- Image 3 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Image2"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="image2" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                    <!-- Image 4 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Image3"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="image3" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                    <!-- Image 5 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Image4"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="image4" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                    <!-- Image 6 -->
                                                                    <div class="file-input-container"
                                                                        data-placeholder="Choose Image5"
                                                                        data-filename="">
                                                                        <input type="file" accept="image/*"
                                                                            name="image5" required
                                                                            onchange="this.parentNode.setAttribute('data-filename', this.files[0].name); this.parentNode.classList.add('file-selected');">
                                                                    </div>
                                                                    <br>
                                                                </div>

                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="imgdescribe">Image Country :</label>
                                                                <input type="text" class="form-control"
                                                                    name="imgdescribe" id="imgdescribe"
                                                                    placeholder="Enter Image Country" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="bookingCode">Booking Code :</label>
                                                                <input type="text" class="form-control"
                                                                    name="bookingcode" id="bookingCode"
                                                                    placeholder="Enter booking code" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="days">Days :</label>
                                                                <input type="text" class="form-control" name="days"
                                                                    id="days" placeholder="Enter days" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="fromDate">From Date :</label>
                                                                <input type="date" class="form-control" name="fromDate"
                                                                    id="fromDate" placeholder="Enter from date"
                                                                    required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="toDate">To Date :</label>
                                                                <input type="date" class="form-control" name="toDate"
                                                                    id="toDate" placeholder="Enter to date" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="amount">Amount :</label>
                                                                <input type="number" class="form-control" name="amount"
                                                                    id="amount" placeholder="Enter amount" required>
                                                            </div>
                                                            <div id="form-container">
                                                                <div id="textboxes0">
                                                                    <div class="form-group mb-2">
                                                                        <label for="days01">Day 1</label>
                                                                        <textarea class="form-control day-1-textbox"
                                                                            name="days1" id="days01" placeholder=""
                                                                            style="height: 100px;" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <button type="button" id="textboxbtn0"
                                                                        class="btn btn-success" max="1"
                                                                        onclick="addtextbox(this)"
                                                                        boxid='0'>Add</button>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="removetextbox(this)"
                                                                        boxid='0'>Delete</button>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="form-container mb-3">
                                                                <div class="form-group">
                                                                    <label for="days-1">Inclusion</label>
                                                                    <textarea name="inclusion"
                                                                        class="form-control day-1-textbox"
                                                                        placeholder="Inclusion" style="height: 100px;"
                                                                        required></textarea>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="form-container mb-3">
                                                                <div class="form-group">
                                                                    <label for="days-1">Exclusion</label>
                                                                    <textarea name="exclusion"
                                                                        class="form-control day-1-textbox"
                                                                        placeholder="Exclusion" style="height: 100px;"
                                                                        required></textarea>
                                                                </div>
                                                            </div>
                                                            <p align="center" style="color:red">Use &lt;br/&gt; to give
                                                                new line</p>
                                                    </strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal"><strong>Close</strong></button>
                                                    <button type="submit" id="addbtn" class="btn btn-primary"><strong
                                                            style="color: #000;">Add Destination</strong></button>
                                                    <input type="hidden" name="way" value="newdestination">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table-to-print" style="text-align: center;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.NO</th>
                                                <th scope="col">Photos</th>
                                                <th scope="col">Booking Code</th>
                                                <th scope="col">Days</th>
                                                <th scope="col">From Date</th>
                                                <th scope="col">To Date</th>

                                                <th scope="col">Amount</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">

                                        </tbody>
                                    </table>
                                </div>
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



    </div>
    <!-- Content End -->


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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="./requiredFiles/js/tourdestinationedit.js"></script>


</body>

</html>