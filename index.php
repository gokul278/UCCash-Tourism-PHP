<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UCCASH TOURISM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:rgba(255,255,255,0)">
                <div style="width: 100%;" align="end">
                    <button type="button" style="background-color: red;" class="btn-close btn-warning p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color:rgba(255,255,255,0)">
                    <img id="flashbanner" style="width: 100%; height: 80vh;" alt="image">
                </div>
            </div>
        </div>
    </div>


    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <!-- <span class="sr-only">Loading...</span> -->
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <a href="index.php"><img class=" me-3" src="img/logo.png" alt="UCCASH LOGO" style="width:130px"></a>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About Us</a>
                    <a href="services.php" class="nav-item nav-link">Services</a>
                    <a href="places.php" class="nav-item nav-link">Places</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sign Up / Login</a>
                        <div class="dropdown-menu m-0">
                            <a href="signup.php" class="dropdown-item">Sign Up</a>
                            <a href="signin.php" class="dropdown-item">Sign In</a>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
    </div>
    <!-- Carousel Start -->
    <div class="carousel-header">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="img/main-banner.jpg" class="img-fluid" alt="UCCASH MAINBANNER">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 style="color:white;margin-top:-30px;padding-bottom:100px">Save Less! Fly More !!</h2>
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">UCCASH TOURS
                                & TRAVELS</h4>
                            <h3 class="display-8 text-capitalize text-white mb-4">REACH YOUR DREAM DESTINATION EASY WITH
                                US !</h3>
                            <p class="mb-5 fs-5">Make use of our travel system and explore all your dream destinations
                                without any worries.
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-2 px-4"
                                    href="services.php">Know More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="h-100">
                        <img src="img/about-img.jpg" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <h5 class="section-about-title pe-3">About Us</h5>
                    <h1 class="mb-4">Hi! Welcome to <span class="text-primary">UCCash Tour & Travels</span></h1>

                    <br>
                    <p style="text-align: justify;color: black;" class="mb-4">Our well-established travel agency has
                        been in business for over a decade. We are experts in every aspect of this business and have
                        earned the respect of many people over the years. Our firm is well versed in the difficulties
                        and annoyances associated with obtaining mandatory documents . So here we are , bringing you the
                        stress -free foldaway.</p>
                    <p style="text-align: justify;color: black;" class="mb-4">We provide first-class service whether you
                        are travelling Domestically or Internationally. We offer our clients the best in class service
                        at reasonable prices. Our services are much more prompt and competent.</p>
                    <p style="text-align: justify;color: black;" class="mb-4">People who have travelled with us attest
                        to our extremely efficient and advanced services. they have shared their excellent travel
                        experience with our company on our website. If you're interested in hearing more about it,
                        please let us know and we'll get back to you as soon as possible.</p>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Packages Start -->
    <div class="container-fluid packages py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">

                <h1 class="mb-0">Our <span style="color: #f7c128;">Packages</span></h1>
            </div>
            <div class="packages-carousel owl-carousel">
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="img/honeymoon package.jpg" class="img-fluid w-100 rounded-top"
                            alt="honeymoon package">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt me-2"></i>7 DAYS / 6 NIGHTS</small>
                        </div>
                    </div>
                    <div class="packages-content bg-light">
                        <div style="text-align: center;" class="p-4 pb-0">
                            <h5 class="mb-0">Honeymoon Package</h5>
                            <small class="text-uppercase">7 DAYS / 6 NIGHTS</small>

                            <p class="mb-4">We provides differnt types of packages to various happy destinations.</p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="services.php" class="btn-hover btn text-white py-2 px-4">Read More</a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <a href="signin.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="packages-item">
                    <div class="packages-img">
                        <img src="img/family package.jpg" class="img-fluid w-100 rounded-top" alt="family package">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">

                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt me-2"></i>14 DAYS / 13 NIGHTS</small>

                        </div>

                    </div>
                    <div class="packages-content bg-light">
                        <div style="text-align: center;" class="p-4 pb-0">
                            <h5 class="mb-0">Family Package</h5>
                            <small class="text-uppercase">14 DAYS / 13 NIGHTS</small>

                            <p class="mb-4">Spend your time with family and expolre various destination over the world.
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="services.php" class="btn-hover btn text-white py-2 px-4">Read More</a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <a href="signin.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="packages-item">
                    <div class="packages-img">
                        <img src="img/weekend package.jpg" class="img-fluid w-100 rounded-top" alt="weekend package">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">

                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt me-2"></i>3 DAYS / 2 NIGHTS</small>

                        </div>

                    </div>
                    <div class="packages-content bg-light">
                        <div style="text-align: center;" class="p-4 pb-0">
                            <h5 class="mb-0">Weekend Package</h5>
                            <small class="text-uppercase">3 DAYS / 2 NIGHTS</small>

                            <p class="mb-4">Specially organized for the customers who where obsessed with travelling.
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="services.php" class="btn-hover btn text-white py-2 px-4">Read More</a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <a href="signin.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="img/group package.jpg" class="img-fluid w-100 rounded-top" alt="group package">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">

                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt me-2"></i>10 DAYS / 9 NIGHTS</small>

                        </div>

                    </div>
                    <div class="packages-content bg-light">
                        <div style="text-align: center;" class="p-4 pb-0">
                            <h5 class="mb-0">Group Package</h5>
                            <small class="text-uppercase">10 DAYS / 9 NIGHTS</small>

                            <p class="mb-4">We organizes group packages for a team-out and for commercial gaterings.</p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="services.php" class="btn-hover btn text-white py-2 px-4">Read More</a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <a href="signin.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Packages End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">TRAVEL BOOKING</h5>
                                    <p style="text-align: center;">We provides best services in booking to your dream
                                        destinations at easy and budget friendly manner.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">EVENTS BOOKING</h5>
                                    <p style="text-align: center;">With your travel booking we have our fun activites as
                                        a added one which makes your travel as memorable one.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">TOUR SPOTS</h5>
                                    <p style="text-align: center;">All our packages are planed with combaining unique
                                        places which were not bounded in any other packages.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">HOTEL BOOKING</h5>
                                    <p style="text-align: center;">We have tie ups with popular hotels and bookes your
                                        stays which, makes your journey a comfortable one.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">
                                        SIGHT SEEING BOOKING</h5>
                                    <p style="text-align: center;">Prior to your journey we plan and reserve all the
                                        mandatory bookings for sight seeings which makes you happy.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                <div class="service-content text-end">
                                    <h5 style="text-align: center;" class="mb-4">TOP BRANDINGS</h5>
                                    <p style="text-align: center;">We have tie ups with worlds leading travel advisors
                                        and make use of them in achiving top branding stage.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="services.php">Service More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!--Tips before travel strat-->

    <section class="adv_sec">
        <div class="container">


            <div class="mx-auto text-center mb-5" style="max-width: 900px;"></div>
            <h1 style="text-align: center;" class="mb-0">Tips <span style="color: #f7c128;">Before Travel</span></h1>

            <div class="adv_in">

                <div class="row">

                    <div class="col-lg-4 col-md-6 col-12">

                        <div class="adv_box">
                            <div class="media">

                                <div class="media-body">
                                    <h5 style="text-align: center;">Bring copies of your documents</h5>
                                    <p style="text-align: center;">Its advisable to carry copies of all mandatory
                                        documents in your journey.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="adv_box">
                            <div class="media">
                                <div class="media-body">
                                    <h5 style="text-align: center;">Register with trusted agents</h5>
                                    <p style="text-align: center;">In-order to make your travel comfort, register with a
                                        trusted agent.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="adv_box">
                            <div class="media">
                                <div class="media-body">
                                    <h5 style="text-align: center;">Always have cash</h5>
                                    <p style="text-align: center;">Its advisable to carry local cash in your journey for
                                        emergency.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <style>
        .adv_sec {
            width: 100%;
            padding-top: 20px;
        }

        .adv_in {
            width: 100%;
            padding-top: 60px;
        }

        .adv_box {
            width: 100%;
            position: relative;
            transition: 0.3s ease-in-out;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            -webkit-box-shadow: -10px 17px 46px -25px rgba(0, 0, 0, 0.68);
            -moz-box-shadow: -10px 17px 46px -25px rgba(0, 0, 0, 0.68);
            box-shadow: -10px 17px 46px -25px rgba(0, 0, 0, 0.68);
            padding: 15px 5px 15px 0;
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .adv_box img {
            max-width: 100%;
            -webkit-filter: invert(100%);
            filter: invert(100%);
        }

        .adv_box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0px;
            width: 100%;
            height: 100%;
            background: url(../images/bx.png) no-repeat center center;
            background-size: contain;
            opacity: 0.1;
        }

        .adv_in .row .col-12:nth-child(1) .adv_box {
            background: #f4bfbf;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(2) .adv_box {
            background: #ffd9c0;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(3) .adv_box {
            background: #faf0d7;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(4) .adv_box {
            background: #8cc0de;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(5) .adv_box {
            background: #effffd;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(6) .adv_box {
            background: #b8fff9;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(7) .adv_box {
            background: #85f4ff;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(8) .adv_box {
            background: #42c2ff;
            color: #000;
        }

        .adv_in .row .col-12:nth-child(9) .adv_box {
            background: #f0ffc2;
        }

        .adv_box .media-body h5 {
            font-size: 16px;
            color: #000;
            font-weight: bold;
            text-align: left;
        }

        .adv_box .media-body p {
            font-size: 15px;
            color: #000;
            text-align: justify;
            text-align: left;
        }

        .adv_box .media {
            align-items: center !important;
        }

        .adv_box:hover {
            background: #f7c128 !important;
        }
    </style>

    <!--Tips before travel end-->


    <!-- Arrangements & Helps Start -->
    <div class="container-fluid guide py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">

                <h1 style="color: #f7c128;" class="mb-0">Arrangements <span style="color: #000;">and</span> Helps</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="">
                                <img src="img/location.jpg" class="img-fluid w-100 rounded-top" alt="location">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="">
                                <img src="img/guide.jpg" class="img-fluid w-100 rounded-top" alt="guide">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="">
                                <img src="img/arrangements.jpg" class="img-fluid w-100 rounded-top" alt="arrangements">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="">
                                <img src="img/events.jpg" class="img-fluid w-100 rounded-top" alt="events">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Arrangements & Helps End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">

                <h1 class="mb-0">Customer <span style="color: #f7c128;">Testimonials</span></h1>
            </div>
            <div class="testimonial-carousel owl-carousel">
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">I have travel experience over years with them, all their plans where
                            designed in unique manner and i enjoy travelling with them.
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="img/testimonial.png" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">Ashok Kumar</h5>
                        <p class="mb-0">Tamilnadu, India</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">I have travel experience over years with them, all their plans where
                            designed in unique manner and i enjoy travelling with them.
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="img/testimonial.png" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">Ashok Kumar</h5>
                        <p class="mb-0">Tamilnadu, India</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">I have travel experience over years with them, all their plans where
                            designed in unique manner and i enjoy travelling with them.
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="img/testimonial.png" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">Ashok Kumar</h5>
                        <p class="mb-0">Tamilnadu, India</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">I have travel experience over years with them, all their plans where
                            designed in unique manner and i enjoy travelling with them.
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="img/testimonial.png" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">Ashok Kumar</h5>
                        <p class="mb-0">Tamilnadu, India</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <a href="index.php"><img class=" me-3" src="img/logo2.png" alt="UCCASH LOGO"
                                style="width:150px;height:100px;"></a>
                        <br>
                        <p style="text-align: justify;color: white;">UCCASH Tourism is a leading tour's and travel company. we providing best tour packages with savings and free tour with Earning platform. book travel packages and enjoy your holidays distinctive experience with us.<br>
                        <br>Tour with savings,<br>
                        Tour with Discount,<br>
                        Free Tour with Earnings.</p>

                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <a href="#"><i class="fas fa-home me-2"></i> 1st Floor, Selvam Complex, Kurukkuppatti Junction,
                            Tharamangalam, Salem DT, Tamilnadu, India, PIN-636502</a>
                        <br>
                        <a href="mailto:support@uccashtourism.com" target="_blank"><i class="fas fa-envelope me-2"></i>
                            support@uccashtourism.com</a>
                        <br>
                        <a href="tel: +91 8124779993"><i class="fas fa-phone me-2"></i> +91 8124779993</a>
                        <br>
                        <div class="d-flex align-items-center">
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://www.whatsapp.com/channel/0029VaNZVU117En3yKTBiu2b" target="_blank"><i
                                    class="fab fa-whatsapp"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://www.facebook.com/uccashtourism" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://t.me/uccashtourism"
                                target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://twitter.com/uccashtourism" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://www.instagram.com/uccashtourism" target="_blank"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://www.youtube.com/@UCCASHTOURISM" target="_blank"><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1"
                                href="https://www.linkedin.com/in/uccashtourism/" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Pages</h4>
                        <a href="index.php"><i class="fas fa-angle-right me-2"></i> Home</a>
                        <a href="about.php"><i class="fas fa-angle-right me-2"></i> About Us</a>
                        <a href="services.php"><i class="fas fa-angle-right me-2"></i> Services</a>
                        <a href="places.php"><i class="fas fa-angle-right me-2"></i> Places</a>
                        <a href="contact.php"><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                        <a href="signup.php"><i class="fas fa-angle-right me-2"></i> Signup / Login</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Disclosure</h4>
                        <a href="../UC User/img/UCCASH Tourism Privacy Policy.pdf"><i
                                class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                        <a href="../UC User/img/UCCASH Tourism Terms and Conditions.pdf"><i
                                class="fas fa-angle-right me-2"></i> Terms of Service</a>
                        <a href="../UC User/img/UCCASH Tourism Payment Agreement.pdf"><i
                                class="fas fa-angle-right me-2"></i> Payment Terms</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Refund Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright text-body py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div style="color: white;" class="col-md-6 text-center text-md-end mb-md-0">
                    <i style="color: white;" class="fas fa-copyright me-2"></i><a class="text-white" href="#"><span
                            style="color: #f7c128;"><b>UCCASH TOURISM</b></span></a> , All right reserved.
                </div>
                <div style="color: white;" class="col-md-6 text-center text-md-start">

                    Developed By <a class="text-white" href="https://cragx.netlify.app" target="_blank"><span
                            style="color: #f7c128;"><b>Team CragX</b></span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="./requiredFiles/js/index.js"></script>
</body>

</html>