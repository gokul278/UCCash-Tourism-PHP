<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Create a Member Account</title>
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
    </head>

    <style>
        .form-container {
            padding-top: 10px; /* Adjust the value as needed */
        }

        body {
            /* background-image: url('./img/tour.jpg'); */
            background-image: linear-gradient(to bottom, #0d7ef4, #00d4ff);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-container {
            padding-top: 10px; /* Adjust the value as needed */
        }
    </style>

<body>
    
    <form style="color: #000;">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-6">
                    <strong><form>
                        <div class="bg-light rounded h-100 p-4">
                            <img src="./img/uc logo.png" alt="UCCash Tours & Travels Logo" style="width: 150px; display: block; margin: 15px auto;"><br>
                            <h3 style="text-align: center;" >Create an Account</h3>
                            <p style="text-align: center;" >Sign Up to access <span style="color: #f7c128;">UCCASH TOURISM</span></p>
                            <hr>

                            <label for="Sponser ID"><a href="#"><span style="color: #000;">Sponser ID</a></span><a href="#">
                                <span style="font-size:13px;">I don't know →</span>
                            </a>
                            
                            </label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tel" placeholder="Sponser ID" value="UCT123456">
                                <p style="color: #66e0ac;">Ashok Kumar</p>
                            </div>

                            <label for="Name">Name<span style="color: red;"> *</span></label>
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="name" placeholder="Full Name">
                            </div>

                            <label for="email">Email ID</label>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email Address">
                            </div>

                            <label for="tel">Phone No<span style="color: red;"> *</span></label>
                            
                            <div class="form-floating mb-3">
                                <div class="input-group">
                                    <select id="country-code" class="form-select form-select-sm" style="width: auto;">
                                        <option value="+1">+1 (USA)</option>
                                        <option value="+44">+44 (UK)</option>
                                        <!-- Add more options for different countries -->
                                    </select>
                                    <input type="tel" id="phone-number" class="form-control" placeholder="Enter phone number">
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            <label for="text">Address<span style="color: red;"> *</span></label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Address" type="address" name="address" id="address" style="height: 110px;"></textarea>
                            </div>
                            <br>

                            <label for="city">City</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="city" placeholder="city">   
                            </div>

                            <label for="pin">Postal Code/ZIP</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg mb-1  mt-1" name="pin"
                                   value=""
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                   id="pin">
                            </div>

                            <!-- <label for="country">Country</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="country" placeholder="country">   
                            </div> -->

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="country">
                                            <option value="" selected disabled>Select Country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="China">China</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="North Korea">North Korea</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Yemen">Yemen</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="state">
                                            <option value="" selected disabled>Select State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Puducherry">Puducherry</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <label for="Password">Password<span style="color: red;"> *</span></label>
                            <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                <input type="password" class="form-control" id="Password" placeholder="">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                </button>
                            </div>

                            <label for="rePassword">Re-enter Password<span style="color: red;"> *</span></label>
                            <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                <input type="password" class="form-control" id="rePassword" placeholder="">
                                <button class="btn btn-outline-secondary" type="button" id="togglerePassword">
                                    <i class="bi bi-eye-slash" id="reeyeIcon"></i>
                                </button>
                            </div>
                            <br>

                            <div class="form-check">
                                <input class="form-check-input" name="terms" checked type="checkbox" value="1"
                                       id="invalidCheck2"
                                       required="">
                                <label class="form-check-label" for="invalidCheck2">
                                    I Agree to the <a id="terms_conditions" data-terms="" href="./img/UCCASH Tourism Terms and Conditions.pdf">terms and conditions</a> and <a id="privacy_policy" data-privacy="" href="./img/UCCASH Tourism Privacy Policy.pdf">Privacy Policy</a> and <a id="payment_agreement" data-payment="" href="./img/UCCASH Tourism Payment Agreement.pdf">Payment Agreement</a>
                                    mentioned in this site.
                                </label>
                            </div>
                            <br>
                            <div class="container text-center">
                                <a href="#">
                                    <button style="height: 60px;" class="btn btn-primary w-100 m-2" type="button">Register</button>
                                </a>
                            </div><br>
                            <p style="text-align: center;">I have an Account <a href="./logout.php"><span> Login →</span></a></p>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form></strong>

  
  

</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
 <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript"></script>




   <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('Password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        }
    });
</script>

<!-- <script>
    const togglerePassword = document.getElementById('togglerePassword');
    const repasswordField = document.getElementById('Password');
    const reeyeIcon = document.getElementById('reeyeIcon');

    togglePassword.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        }
    });
</script> -->

</body>
</html>