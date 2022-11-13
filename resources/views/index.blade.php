<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="BarberShop & Hair Salon HTML Template" />
    <meta name="author" content="DynamicLayers" />

    <title>Barber Shop || BarberShop Hair Salon HTML Template</title>

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />

    <!-- Elegant Font Icons CSS -->
    <link rel="stylesheet" href="css/elegant-font-icons.css" />
    <!-- Elegant Line Icons CSS -->
    <link rel="stylesheet" href="css/elegant-line-icons.css" />
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="css/themify-icons.css" />
    <!-- Barber Icons CSS -->
    <link rel="stylesheet" href="css/barber-icons.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css" />
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="css/venobox/venobox.css" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css" />
    <!-- OWL-Carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="css/slicknav.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <img src="img/loading.gif" width="80" alt="" />
        </div>
    </div>

    <header id="header" class="header-section">
        <div class="container">
            <nav class="navbar">
                <a href="index.html#" class="navbar-brand"><img src="img/logo.png" alt="Barbershop" /></a>
                <div class="d-flex menu-wrap align-items-center">
                    <div id="mainmenu" class="mainmenu">
                        <ul class="nav d-lg-flex align-items-center">
                            <li>
                                <a data-scroll class="nav-link active" href="index.html">Home<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li>
                                <a href="https://html.dynamiclayers.net/dl/barbershop/services.html">Services</a>
                            </li>
                            <li>
                                <a href="https://html.dynamiclayers.net/dl/barbershop/services.html">Portfólio</a>
                            </li>
                            <li>
                                <a href="https://html.dynamiclayers.net/dl/barbershop/contact.html">Contact</a>
                            </li>
                            <li>
                                <div class="header-btn">
                                    <a href="index.html#" class="menu-btn">Make Appointment</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section id="about" class="about_section bd-bottom padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about_content align-center">
                        <h2 class="wow fadeInUp" data-wow-delay="200ms">
                            The Barber Shop <br />Science 1991
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="600ms">
                            Barber is a person whose occupation is mainly to
                            cut dress groom style and shave men's and boys'
                            hair. A barber's place of work is known as a
                            "barbershop" or a "barber's". Barbershops are
                            also places of social interaction and public
                            discourse. In some instances, barbershops are
                            also public forums.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="book_section padding">
        <div class="book_bg"></div>
        <div class="map_pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-6">
                    <form action="https://html.dynamiclayers.net/dl/barbershop/appointment.php" method="post"
                        id="appointment_form" class="form-horizontal appointment_form">
                        <div class="book_content">
                            <h2>Make an appointment</h2>
                            <p>
                                Barber is a person whose occupation is
                                mainly to cut dress groom <br />style and
                                shave men's and boys hair.
                            </p>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" id="app_name" name="app_name" class="form-control"
                                    placeholder="Name" required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <input type="email" id="app_email" name="app_email" class="form-control"
                                    placeholder="Your Email" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" id="app_phone" name="app_phone" class="form-control"
                                    placeholder="Your Phone No" required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <select class="form-control" id="app_services" name="app_services">
                                    <option>Services</option>
                                    <option>Hair Styling</option>
                                    <option>Shaving</option>
                                    <option>Face Mask</option>
                                    <option>Hair Wash</option>
                                    <option>Beard Triming</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" id="cpf" name="cpf" class="form-control"
                                    placeholder="CPF" required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <input type="datetime-local" id="app_free_time" name="app_free_time"
                                    class="form-control" placeholder="Your Free Time" required />
                            </div>
                        </div>
                        <button id="app_submit" class="default_btn" type="submit">
                            Make Appointment
                        </button>
                        <div id="msg-status" class="alert" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing_section bg-grey bd-bottom padding">
        <div class="container">
            <div class="section_heading text-center mb-40 wow fadeInUp" data-wow-delay="300ms">
                <h3>Save 20% On Beauty Spa</h3>
                <h2>Our Barber Pricing</h2>
                <div class="heading-line"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 sm-padding">
                    <div class="price_wrap">
                        <h3>Hair Styling</h3>
                        <ul class="price_list">
                            <li>
                                <h4>Hair Cut</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$8</span>
                            </li>
                            <li>
                                <h4>Hair Styling</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$9</span>
                            </li>
                            <li>
                                <h4>Hair Triming</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$10</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 sm-padding">
                    <div class="price_wrap">
                        <h3>Shaving</h3>
                        <ul class="price_list">
                            <li>
                                <h4>Clean Shaving</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$8</span>
                            </li>
                            <li>
                                <h4>Beard Triming</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$9</span>
                            </li>
                            <li>
                                <h4>Smooth Shave</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$10</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 sm-padding">
                    <div class="price_wrap">
                        <h3>Face Masking</h3>
                        <ul class="price_list">
                            <li>
                                <h4>White Facial</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$8</span>
                            </li>
                            <li>
                                <h4>Face Cleaning</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$9</span>
                            </li>
                            <li>
                                <h4>Bright Tuning</h4>
                                <p>
                                    Barber is a person whose occupation is
                                    mainly to cut dress groom style and
                                    shave men.
                                </p>
                                <span class="price">$10</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="widget_section padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 sm-padding">
                    <div class="footer_widget">
                        <img class="mb-15" src="img/logo.png" alt="Brand" />
                        <p>
                            Our barbershop is the created for men who
                            appreciate premium quality, time and flawless
                            look.
                        </p>
                        <ul class="widget_social">
                            <li>
                                <a href="index.html#"><i class="social_facebook"></i></a>
                            </li>
                            <li>
                                <a href="index.html#"><i class="social_instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 sm-padding">
                    <div class="footer_widget">
                        <h3>Headquaters</h3>
                        <p>962 Fifth Avenue, 3rd Floor New York, NY10022</p>
                        <p>
                            Hello@dynamiclayers.net <br />(+123) 456 789 101
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 sm-padding">
                    <div class="footer_widget">
                        <h3>Opening Hours</h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Saturday – Monday: 9am – 8pm</li>
                            <li>Monday - Friday 5:30am - 11:008pm</li>
                            <li>Saturday - Sunday 4:30am - 1:00pm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 xs-padding">
                    <div class="copyright">
                        &copy;
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script>
                        Barber Shop Powered by DynamicLayers
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a data-scroll href="index.html#header" id="scroll-to-top"><i class="arrow_up"></i></a>

    <!-- jQuery Lib -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/vendor/bootstrap.min.js"></script>
    <!-- Imagesloaded JS -->
    <script src="js/vendor/imagesloaded.pkgd.min.js"></script>
    <!-- OWL-Carousel JS -->
    <script src="js/vendor/owl.carousel.min.js"></script>
    <!-- isotope JS -->
    <script src="js/vendor/jquery.isotope.v3.0.2.js"></script>
    <!-- Smooth Scroll JS -->
    <script src="js/vendor/smooth-scroll.min.js"></script>
    <!-- venobox JS -->
    <script src="js/vendor/venobox.min.js"></script>
    <!-- ajaxchimp JS -->
    <script src="js/vendor/jquery.ajaxchimp.min.js"></script>
    <!--Slicknav-->
    <script src="js/vendor/jquery.slicknav.min.js"></script>
    <!--Nice Select-->
    <script src="js/vendor/jquery.nice-select.min.js"></script>
    <!-- YTPlayer JS -->
    <script src="js/vendor/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow JS -->
    <script src="js/vendor/wow.min.js"></script>
    <!-- Contact JS -->
    <script src="js/contact.js"></script>
    <!-- Appointment JS -->
    <script src="js/appointment.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>

</html>
