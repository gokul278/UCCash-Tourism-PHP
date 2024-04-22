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


    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


         <!-- Sidebar Start -->
         <div class="sidebar pe-4 pb-3">
            <nav  class="navbar bg-light navbar-light">
                <img src="./img/uc logo.png" alt="UCCASH" class="navbar-brand mx-4 mb-3" style="width: 150px; height: 60px;">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><b>Gowtham</b></h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Profiles</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile.php" class="dropdown-item">Profile</a>
                            <a href="user bank details.php" class="dropdown-item">Bank Details</a>
                            <a href="address.php" class="dropdown-item">Address</a>
                            <a href="member info.php" class="dropdown-item">Member Info</a>
                            <a href="walllet.php" class="dropdown-item">Wallet Address</a>
                            <a href="security.php" class="dropdown-item">Security</a>
                            <!-- <a href="trans PWD.php" class="dropdown-item">Change Trans PWD</a> -->
                            <a href="id card.php" class="dropdown-item">ID Card</a>
                        </div>
                    </div>
                    <a href="referral.php" class="nav-item nav-link"><i class="fa fa-user-plus me-2"></i>Refferal Link</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>My Team</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="genealogy.php" class="dropdown-item">Genealogy</a>
                            <a href="team list.php" class="dropdown-item">Team List</a>
                            <a href="direct member list.php" class="dropdown-item">Direct Member List</a>
                            <a href="ranking member list.php" class="dropdown-item">Ranking Member List</a>
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>ID Activation<p style="text-align: center;" > Deposit</p></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="id activation.php" class="dropdown-item">ID Activation</a>
                            <a href="id reactivation.php" class="dropdown-item">ID Reactivation</a>
                        </div>
                    </div>
                    <a href="distributor activation status.php" class="nav-item nav-link"><i class="fa fa-signal me-2"></i>ID Activation <p style="text-align: center;">History</p></a>
                    <!-- <a href="coupon purchase history.php" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Coupon <p style="text-align: center;">Purchase History</p></a> -->
                    <a href="coupon usage history.php" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Travel Coupon <p style="text-align: center;">Usage History</p></a>
                    <!-- <a href="monthly TP savings.php" class="nav-item nav-link"><i class="fa fa-comment-dollar me-2"></i>Monthly TP <p style="text-align: center;">Savings</p></a> -->
                    <a href="monthly TP savings status.php" class="nav-item nav-link"><i class="fa fa-donate me-2"></i>Monthly TP <p style="text-align: center;">Saving History</p></a>
                    <a href="monthly savings pending invoice.php" class="nav-item nav-link"><i class="fa fa-file-invoice-dollar me-2"></i>Monthly Savings <p style="text-align: center;">Pending Invoice</p></a>
                    <a href="rank board.php" class="nav-item nav-link"><i class="fa fa-star me-2"></i>Rank Board</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-wallet me-2"></i>Income History</a>
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
                    <a href="transfer history.php" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer History</a>
                   
                    <a href="withdraw.php" class="nav-item nav-link"><i class="fa fa-university me-2"></i>Withdraw</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.php" class="dropdown-item active">Tour Booking</a>
                            <a href="hotel booking.php" class="dropdown-item">Hotel Booking</a>
                        </div>
                    </div>
                    <a href="booking history.php" class="nav-item nav-link"><i class="fa fa-bookmark me-2"></i>Booking History</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-tools me-2"></i>Business Tools</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">1 PDF </a>
                            <a href="#" class="dropdown-item">2 PDF</a>
                            <a href="#" class="dropdown-item">3 PDF</a>
                            <a href="#" class="dropdown-item">4 PDF</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-info-circle me-2"></i>Information</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./img/UCCASH Tourism Terms and Conditions.pdf" class="dropdown-item">Terms & Conditions</a>
                            <a href="./img/UCCASH Tourism Privacy Policy.pdf" class="dropdown-item">Privacy Policies</a>
                            <a href="./img/UCCASH Tourism Payment Agreement.pdf" class="dropdown-item">Payment Agriments</a>
                            <a href="./img/UCCASH Tourism Indipendent Distributor Agreement.pdf" class="dropdown-item">Independent Distributor<p>Agreement</p></a>
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
                        <img class="rounded-circle me-lg-2" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex"><b>Gowtham</b></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="./logout.php" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
<!--user start-->
<style></style>

<!--user end-->

            <!-- Sale & Revenue Start -->
            <!-- Packages stat-->
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            
            <h1 class="mb-0">Popular <span style="color: #f7c128;">Destinations</span></h1>
        </div>
        <div class="packages-carousel owl-carousel">
            <div class="packages-item">
                <div class="packages-img">
                    <img src="img/honeymoon package.jpg" class="img-fluid w-100 rounded-top" alt="honeymoon package" width="275" height="183">
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>4 DAYS / 3 NIGHTS</small>
                    </div>
                </div>
                <div class="packages-content bg-light">
                    <div style="text-align: center;" class="p-4 pb-0">
                        <h5 class="mb-0">Thailand</h5>
                        <small  class="text-uppercase">4 DAYS / 3 NIGHTS</small>
                        
                        <p class="mb-4">500 TP</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="#" class="btn-hover btn text-white py-2 px-4">Booking Code-001</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="confirm page.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="packages-item">
                <div class="packages-img">
                <img src="img/family package.jpg" class="img-fluid rounded-top" alt="family package" width="275" height="183">
  
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                       
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>5 DAYS / 4 NIGHTS</small>
                        
                    </div>
                    
                </div>
                <div class="packages-content bg-light">
                    <div style="text-align: center;" class="p-4 pb-0">
                        <h5 class="mb-0">Malaysia</h5>
                        <small class="text-uppercase">5 DAYS / 4 NIGHTS</small>
                        
                        <p class="mb-4">650 TP</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="#" class="btn text-white py-2 px-4">Booking code-002</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="confirm page.php" class="btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
                
            </div>
  
            <div class="packages-item">
                <div class="packages-img">
                <img src="img/singapore.jpg" class="img-fluid rounded-top" alt="family package" width="275" height="183">
  
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                       
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>7 DAYS / 8 NIGHTS</small>
                        
                    </div>
                    
                </div>
                <div class="packages-content bg-light">
                    <div style="text-align: center;" class="p-4 pb-0">
                        <h5 class="mb-0">Singapore</h5>
                        <small class="text-uppercase">7 DAYS / 8 NIGHTS</small>
                        
                        <p class="mb-4">820 TP</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="#"  class="btn-hover btn text-white py-2 px-4">Booking code-003</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="confirm page.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
  
            <div class="packages-item">
                <div class="packages-img">
                <img src="img/manarola1.png" class="img-fluid rounded-top" alt="family package" width="275" height="183">
  
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                       
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>6 DAYS / 7 NIGHTS</small>
                        
                    </div>
                    
                </div>
                <div class="packages-content bg-light">
                    <div style="text-align: center;" class="p-4 pb-0">
                        <h5 class="mb-0">Manarola</h5>
                        <small class="text-uppercase">6 DAYS / 7 NIGHTS</small>
                        
                        <p class="mb-4">700 TP</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="#"  class="btn-hover btn text-white py-2 px-4">Booking code-004</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="confirm page.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


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
      $(".packages-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });
    </script>
    <!--user js-->
   
</body>

</html>