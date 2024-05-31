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
        /* Style for disabled buttons */
        button:disabled {
            background-color: #6d6d6d;
        }
    </style>

<style>
    .product-count {
    position: absolute;
    top: 25%;
    left: 45%;
    height: 30px;
    }
    .product-count a {
    text-decoration: none;
    font-weight: 700;
    color: black;
    }
    .button-count {
    display: inline-block;
    width: 30px;
    height: 30px;
    background-color: #2196F3;
    color: white;
    font-size: 24px;
    line-height: 30px;
    text-align: center;
    border: none;
    outline: none;
    }
    .button-count:active {
    background-color: #1565C0;
    }
    .number-product {
    display: inline-block;
    width: 46px;
    height: 28px;
    font-size: 24px;
    border: 1px solid silver;
    text-align: center;
    }
    :disabled {
    background-color: silver;
    }
    /* Styling for adult and child fields */
#field1,
#field2 {
margin-bottom: 15px;
display: flex;
align-items: center;
justify-content: space-between;
}

#field1 button,
#field2 button {
width: 30px;
height: 30px;
background-color: #f7c128;
color: #fff;
border: none;
border-radius: 50%;
cursor: pointer;
font-size: 16px;
line-height: 1;
}

#field1 input,
#field2 input {
width: 60px;
height: 30px;
padding: 0 10px;
border: 1px solid #ccc;
border-radius: 5px;
font-size: 16px;
text-align: center;
}

#field1 button:hover,
#field2 button:hover {
background-color: #f7c128;
}

/* Style for minus button */
.minus {
margin-right: 10px;
}

/* Style for plus button */
.plus {
margin-left: 10px;
}
.amnt {
  background-color:#f3f6f9;
  padding: 20px;
  border-radius: 10px;
  max-width: 300px; /* Adjust as needed */
  margin: 0 auto; /* Center the container */
  text-align: center;
}

/* Optional: Making text responsive */
p {
  font-size: 16px;
  /* Add any other text styles as needed */
}
 </style>
<style>
    .booking-amount-container {
        display: none;
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
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Booking</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="tour booking.php" class="dropdown-item">Tour Booking</a>
                            <a href="hotel booking.php" class="dropdown-item">Hotel Booking</a>
                        </div>
                    </div> -->
                    <a href="tour booking.php" class="nav-item nav-link active"><i class="far fa-map me-2"></i>Tour
                        Booking</a>
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
<style>
    .product-count {
    position: absolute;
    top: 25%;
    left: 45%;
    height: 30px;
    }
    .product-count a {
    text-decoration: none;
    font-weight: 700;
    color: black;
    }
    .button-count {
    display: inline-block;
    width: 30px;
    height: 30px;
    background-color: #2196F3;
    color: white;
    font-size: 24px;
    line-height: 30px;
    text-align: center;
    border: none;
    outline: none;
    }
    .button-count:active {
    background-color: #1565C0;
    }
    .number-product {
    display: inline-block;
    width: 46px;
    height: 28px;
    font-size: 24px;
    border: 1px solid silver;
    text-align: center;
    }
    :disabled {
    background-color: silver;
    }
    /* Styling for adult and child fields */
#field1,
#field2 {
margin-bottom: 15px;
display: flex;
align-items: center;
justify-content: space-between;
}

#field1 button,
#field2 button {
width: 30px;
height: 30px;
background-color: #f7c128;
color: #fff;
border: none;
border-radius: 50%;
cursor: pointer;
font-size: 16px;
line-height: 1;
}

#field1 input,
#field2 input {
width: 60px;
height: 30px;
padding: 0 10px;
border: 1px solid #ccc;
border-radius: 5px;
font-size: 16px;
text-align: center;
}

#field1 button:hover,
#field2 button:hover {
background-color: #f7c128;
}

/* Style for minus button */
.minus {
margin-right: 10px;
}

/* Style for plus button */
.plus {
margin-left: 10px;
}
.amnt {
  background-color:#f3f6f9;
  padding: 20px;
  border-radius: 10px;
  max-width: 300px; /* Adjust as needed */
  margin: 0 auto; /* Center the container */
  text-align: center;
}

/* Optional: Making text responsive */
p {
  font-size: 16px;
  /* Add any other text styles as needed */
}
 </style>

<br><br>
<div class="container">
    <div class="d-flex justify-content-center">
       <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4">
          <div class="bg-light rounded h-100 p-4">
             <h4 style="text-align: center;" class="mb-4"></h4>
             <div style="text-align:center;" class="alert alert-warning" role="alert">
                <strong>THIS BOOKING IS NON-REFUNDABLE</strong>
             </div>
             <br>
             <div id="field1"><b>Adult</b>
                <button type="button" class="minus">-</button>
                <input type="number" value="0" min="0" class='adult' max="20" />
                <button type="button" class="plus">+</button>
             </div>
             <div id="field2"><b>Child</b>
                <button type="button" class="minus">-</button>
                <input type="number" value="0" min="0" class='child' max="20" />
                <button type="button" class="plus">+</button>
             </div>
          </div>
       </div>
    </div>
    <br>
    <div class="container">
        <br>
        
        
        
        
    </div>
    <div class="container">
    
      
        <div style="text-align:center; width:300px; margin: 0 auto;" class="alert alert-warning" role="alert">
            <strong>PAYMENT DETAILS</strong>
        </div>
        
        
        
        
        
            <br>
            <div class="d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary m-2 rounded-pill" for="btnradio1">Saving's TP</label>
            
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-primary m-2 rounded-pill" for="btnradio2">Bonus TP</label>
            
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary m-2 rounded-pill" for="btnradio3">Travel Coupon</label>
                </div>
            </div>
            
            
            
            
            <br>
            <div class="amnt" id="savingsTP">
                <h4>Booking Amount</h4>
                <h4 style="color:#f7c128;">$ 100 TP</h4>
            </div>
            
            <div class="amnt" id="bonusTP" style="display: none;">
                <h4>Booking Amount</h4>
                <h4 style="color:#f7c128;">$ 500 TP</h4>
            </div>

            <div class="amnt" id="travelTP" style="display: none;">
                <h4>Booking Amount</h4>
                <h4 style="color:#f7c128;">$ 1000 TP</h4>
            </div>
            <br>
            <div class="text-center">
                
                    <button type="button" id="OTPButton" class="btn btn-warning">Get OTP</button>
                
            </div>
            <br>
            <div class="container">
                <div class="row gx-3 mb-3 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <input class="form-control" id="tel" type="tel" placeholder="Enter OTP" style="height: 50px;">
                    </div>
                </div>
        
                <br>
                <div class="d-flex justify-content-center">
                    <div class="form-check text-center">
                        <input class="form-check-input" name="terms" type="checkbox" value="1" id="invalidCheck2" required>
                        <label class="form-check-label" for="invalidCheck2">
                            <b style="color: #000;">
                                I Agree to the <a id="terms_conditions" data-terms="" href="../UC User/img/UCCASH Tourism Terms and Conditions.pdf">terms and conditions</a> and <a id="privacy_policy" data-privacy="" href="../UC User/img/UCCASH Tourism Privacy Policy.pdf">Privacy Policy</a> and <a id="payment_agreement" data-payment="" href="../UC User/img/UCCASH Tourism Payment Agreement.pdf">Payment Agreement</a> mentioned in this site.
                            </b>
                        </label>
                    </div>
                </div>
                
                <br>
                <div class="text-center">
                    <button type="button" id="confirmButton" class="btn btn-warning disabled-button" disabled title="Please enter the OTP">Confirm Booking</button>
                </div>
            </div>
            
            <style>
                .disabled-button {
                    pointer-events: none;
                    opacity: 0.65;
                }
            </style>
            <br>
            
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script>
            $(document).ready(function() {
                $('.plus').click(function() {
                    var inputField = $(this).siblings('input[type="number"]');
                    var currentValue = parseInt(inputField.val());
                    var maxValue = parseInt(inputField.attr('max'));
                    if (currentValue < maxValue) {
                        inputField.val(currentValue + 1);
                    }
                });
            
                $('.minus').click(function() {
                    var inputField = $(this).siblings('input[type="number"]');
                    var currentValue = parseInt(inputField.val());
                    var minValue = parseInt(inputField.attr('min'));
                    if (currentValue > minValue) {
                        inputField.val(currentValue - 1);
                    }
                });
            });
         </script>
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
     var num;

$('.button-count:first-child').click(function(){
  num = parseInt($('input:text').val());
  if (num > 1) {
    $('input:text').val(num - 1);
  }
  if (num == 2) {
    $('.button-count:first-child').prop('disabled', true);
  }
  if (num == 10) {
    $('.button-count:last-child').prop('disabled', false);
  }
});

$('.button-count:last-child').click(function(){
  num = parseInt($('input:text').val());
  if (num < 10) {
    $('input:text').val(num + 1);
  }
  if (num > 0) {
    $('.button-count:first-child').prop('disabled', false);
  }
  if (num == 9) {
    $('.button-count:last-child').prop('disabled', true);
  }
});



    </script>
    <!--user js-->


    
   




   


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var confirmButton = document.getElementById("confirmButton");
    
   
        confirmButton.addEventListener("click", function() {
           
            alert("𝐁𝐨𝐨𝐤𝐢𝐧𝐠 𝐒𝐮𝐜𝐜𝐞𝐬𝐬𝐟𝐮𝐥𝐥𝐲 😉💫");
        });
    });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var OTPButton = document.getElementById("OTPButton");
    
   
        OTPButton.addEventListener("click", function() {
           
            alert("OTP Sended Successfully to your Registered Email Address");
        });
    });
    </script>



<script>
document.querySelectorAll('input[name="btnradio"]').forEach((elem) => {
    elem.addEventListener("change", function(event) {
        if (event.target.id === "btnradio1") {
            document.getElementById("savingsTP").style.display = "block";
            document.getElementById("bonusTP").style.display = "none";
            document.getElementById("travelTP").style.display = "none";
        } else if (event.target.id === "btnradio2") {
            document.getElementById("savingsTP").style.display = "none";
            document.getElementById("bonusTP").style.display = "block";
            document.getElementById("travelTP").style.display = "none";
        } else if (event.target.id === "btnradio3") {
            document.getElementById("savingsTP").style.display = "none";
            document.getElementById("bonusTP").style.display = "none";
            document.getElementById("travelTP").style.display = "block";
        }
    });
});

</script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const otpInput = document.getElementById('tel');
        const confirmButton = document.getElementById('confirmButton');

        otpInput.addEventListener('input', function() {
            if (otpInput.value.trim() !== '') {
                confirmButton.removeAttribute('disabled');
            } else {
                confirmButton.setAttribute('disabled', 'disabled');
            }
        });
    });
</script>

 <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>


<script>
    document.getElementById('invalidCheck2').addEventListener('change', function () {
        var confirmButton = document.getElementById('confirmButton');
        if (this.checked) {
            confirmButton.disabled = false;
            confirmButton.classList.remove('disabled-button');
        } else {
            confirmButton.disabled = true;
            confirmButton.classList.add('disabled-button');
        }
    });
</script>


</body>

</html>