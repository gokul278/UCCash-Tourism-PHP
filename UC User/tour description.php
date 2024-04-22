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
    <style>
        /* Style for disabled buttons */
        button:disabled {
            background-color: #6d6d6d;
        }
    </style>
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
                    <a href="index.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Profiles</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile.html" class="dropdown-item">Profile</a>
                            <a href="user bank details.html" class="dropdown-item">Bank Details</a>
                            <a href="address.html" class="dropdown-item">Address</a>
                            <a href="member info.html" class="dropdown-item">Member Info</a>
                            <a href="walllet.html" class="dropdown-item">Wallet Address</a>
                            <a href="security.html" class="dropdown-item">Security</a>
                            <!-- <a href="trans PWD.html" class="dropdown-item">Change Trans PWD</a> -->
                            <a href="id card.html" class="dropdown-item">ID Card</a>
                        </div>
                    </div>
                    <a href="referral.html" class="nav-item nav-link"><i class="fa fa-user-plus me-2"></i>Refferal Link</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>My Team</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="genealogy.html" class="dropdown-item">Genealogy</a>
                            <a href="team list.html" class="dropdown-item">Team List</a>
                            <a href="direct member list.html" class="dropdown-item">Direct Member List</a>
                            <a href="ranking member list.html" class="dropdown-item">Ranking Member List</a>
                        </div>
                    </div>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Coupon<p style="text-align: center;" > Activation Deposit</p></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="crypto deposit.html" class="dropdown-item">Crypto Deposit</a>
                            <a href="bank deposit.html" class="dropdown-item">Bank Deposit</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>ID Activation<p style="text-align: center;" > Deposit</p></a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="id activation.html" class="dropdown-item">ID Activation</a>
                            <a href="id reactivation.html" class="dropdown-item">ID Reactivation</a>
                        </div>
                    </div>
                    <a href="distributor activation status.html" class="nav-item nav-link"><i class="fa fa-signal me-2"></i>ID Activation <p style="text-align: center;">History</p></a>
                    <!-- <a href="coupon purchase history.html" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Coupon <p style="text-align: center;">Purchase History</p></a> -->
                    <a href="coupon usage history.html" class="nav-item nav-link"><i class="fa fa-gift me-2"></i>Travel Coupon <p style="text-align: center;">Usage History</p></a>
                    <!-- <a href="monthly TP savings.html" class="nav-item nav-link"><i class="fa fa-comment-dollar me-2"></i>Monthly TP <p style="text-align: center;">Savings</p></a> -->
                    <a href="monthly TP savings status.html" class="nav-item nav-link"><i class="fa fa-donate me-2"></i>Monthly TP <p style="text-align: center;">Saving History</p></a>
                    <a href="monthly savings pending invoice.html" class="nav-item nav-link"><i class="fa fa-file-invoice-dollar me-2"></i>Monthly Savings <p style="text-align: center;">Pending Invoice</p></a>
                    <a href="rank board.html" class="nav-item nav-link"><i class="fa fa-star me-2"></i>Rank Board</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-wallet me-2"></i>Income History</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="savings income.html" class="dropdown-item">Savings Income</a>
                            <a href="bonus travel point.html" class="dropdown-item">Bonus Travel Point</a>
                            <a href="networking income.html" class="dropdown-item">Networking Income</a>
                            <a href="leadership income.html" class="dropdown-item">Leadership Income</a>
                            <a href="car & house fund.html" class="dropdown-item">Car & House Fund</a>
                            <a href="royalty income.html" class="dropdown-item">Royalty Income</a>
                        </div>
                    </div>
                    <a href="transfer.html" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer</a>
                    <a href="transfer history.html" class="nav-item nav-link"><i class="fa fa-exchange-alt me-2"></i>Transfer History</a>
                   
                    <a href="withdraw.html" class="nav-item nav-link"><i class="fa fa-university me-2"></i>Withdraw</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.html" class="dropdown-item">Tour Booking</a>
                            <a href="hotel booking.html" class="dropdown-item">Hotel Booking</a>
                        </div>
                    </div>
                    <a href="booking history.html" class="nav-item nav-link"><i class="fa fa-bookmark me-2"></i>Booking History</a>

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
                    <a href="../signin.html" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                    
                    
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
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
                            <a href="../signin.html" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
<style>
.description-box {
    width: 600px; /* Adjust the width as needed */
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .description-box h2 {
    color: #333;
    font-size: 18px;
    margin-top: 0;
  }
  
  .description-box p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
  }
  
  </style>
<style>
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
  <br><br>
<!--user start-->
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <div class="description-box">
                            <h1 style="color: #f7c128; text-align: center;">Tour Description</h1>
                            <br>
                            <h6 style="text-align: justify; margin-bottom: 20px;">1) Capture the essence of the tour in an engaging opening sentence.</h6>
                            <h6 style="text-align: justify; margin-bottom: 20px;">2) Showcase the most exciting attractions or experiences participants will encounter.</h6>
                            <h6 style="text-align: justify; margin-bottom: 20px;">3) Provide a clear breakdown of the tour's schedule and activities.</h6>
                            <h6 style="text-align: justify; margin-bottom: 20px;">4) Clearly state what's included in the package and what's not.</h6>
                            <h6 style="text-align: justify; margin-bottom: 20px;">5) Encourage readers to book their spot with a compelling closing statement.</h6>
                            <div style="text-align: center; margin-top: 20px;">
                                <a href="confirm page.html">
                                    <button style="background-color: #f7c128; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; animation: pulse 1.5s infinite;">Book Now</button>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="container-fluid packages py-5">
                        <div class="container py-5">
                            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                                
                                <h1 class="mb-0">Explore Our <span style="color: #f7c128;">Gallery</span></h1>
                            </div>
                            <br>
                            <div class="packages-carousel owl-carousel">
                                <div class="packages-item">
                                    <div class="packages-img">
                                        <img src="img/honeymoon package.jpg" class="img-fluid w-100 rounded-top" alt="honeymoon package" width="275" height="183" style="border-radius: 10px;">
                                    </div>
                                </div>
                                
                                
                                <div class="packages-item">
                                    <div class="packages-img">
                                    <img src="img/family package.jpg" class="img-fluid rounded-top" alt="family package" width="275" height="183" style="border-radius: 10px;">
                                    </div>
                                </div>
                      
                                <div class="packages-item">
                                    <div class="packages-img">
                                    <img src="img/singapore.jpg" class="img-fluid rounded-top" alt="family package" width="275" height="183" style="border-radius: 10px;">
                                    </div> 
                                </div>
                      
                                <div class="packages-item">
                                    <div class="packages-img">
                                    <img src="img/manarola1.png" class="img-fluid rounded-top" alt="family package" width="275" height="183" style="border-radius: 10px;">
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
                        background: rgba(0, 0, 0, 0.3);
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
                      </div>
                        <!-- Back to Top -->
                        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                <!-- </div> -->

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
   









</body>

</html>