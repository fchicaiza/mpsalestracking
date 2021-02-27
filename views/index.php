<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MPSalesTracking</title>
        <meta name="description" content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic" />
        <meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
        <meta name="author" content="Luka Cvetinovic for Codrops" />
        <!-- Favicons (created with http://realfavicongenerator.net/)-->
        <link rel="apple-touch-icon" sizes="57x57" href="../LandingPageMP/img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../LandingPageMP/img/favicons/apple-touch-icon-60x60.png">
        <link rel="icon" type="image/png" href="../LandingPageMP/img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="../LandingPageMP/img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="../LandingPageMP/img/favicons/manifest.json">
        <link rel="shortcut icon" href="../LandingPageMP/img/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#00a8ff">
        <meta name="msapplication-config" content="../LandingPageMPimg/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!-- Normalize -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/css/normalize.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/css/bootstrap.css">
        <!-- Owl -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/css/owl.css">
        <!-- Animate.css -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/css/animate.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/fonts/font-awesome-4.1.0/css/font-awesome.min.css">
        <!-- Elegant Icons -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/fonts/eleganticons/et-icons.css">
        <!-- Main style -->
        <link rel="stylesheet" type="text/css" href="../LandingPageMP/css/cardio.css">
    </head>

    <body>
        <div class="preloader">
            <img src="../LandingPageMP/img/loader.gif" alt="Preloader image">
        </div>
        <nav class="navbar">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="../LandingPageMP/img/logo.png" data-active-url="../LandingPageMP/img/logo-active.png" alt=""></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-nav">
                        <li><a href="registrarse.php"  data-target="#modal1" class="btn btn-blue">Registrarse</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <header id="intro">
            <div class="container">
                <div class="table">
                    <div class="header-text">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="light white">Mpsalestracking</h3>
                                <h1 class="white typed">MAS PIÑAS</h1>
                                <span class="typed-cursor">|</span>
                            </div>
                            <ul class="nav navbar-nav  vertical-center">
                                <li><a href="capacitaciones.php" data-toggle="capacitaciones.php" class="btn btn-blue-fill">Capacitaciones</a></li>
                                <li><a href="login.php" data-toggle="modal" data-target="#modal1" class="btn btn-info">Login</a></li>
                               </ul>
                            
                        </div>
                    </div>
                </div>
                 
            </div>
            
        </header>
        
   
 
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-popup">
                    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                    <h3 class="white">Sign Up</h3>
                    <form action="" class="popup-form">
                        <input type="text" class="form-control form-white" placeholder="Full Name">
                        <input type="text" class="form-control form-white" placeholder="Email Address">
                        <div class="dropdown">
                            <button id="dLabel" class="form-control form-white dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pricing Plan
                            </button>
                            <ul class="dropdown-menu animated fadeIn" role="menu" aria-labelledby="dLabel">
                                <li class="animated lightSpeedIn"><a href="#">1 month membership ($150)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">3 month membership ($350)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">1 year membership ($1000)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">Free trial class</a></li>
                            </ul>
                        </div>
                        <div class="checkbox-holder text-left">
                            <div class="checkbox">
                                <input type="checkbox" value="None" id="squaredOne" name="check" />
                                <label for="squaredOne"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
          
                <div class="row bottom-footer text-center-mobile">
                    <div class="col-sm-8">
                        <p>&copy; 2015 All Rights Reserved. Powered by <a href="http://www.phir.co/">PHIr</a> exclusively for <a href="http://tympanus.net/codrops/">Codrops</a></p>
                    </div>
                    <div class="col-sm-4 text-right text-center-mobile">
                        <ul class="social-footer">
                            <li><a href="http://www.facebook.com/pages/Codrops/159107397912"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="http://www.twitter.com/codrops"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/101095823814290637419"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Holder for mobile navigation -->
        <div class="mobile-nav">
            <ul>
            </ul>
            <a href="#" class="close-link"><i class="arrow_up"></i></a>
        </div>
        <!-- Scripts -->
        <script src="../LandingPageMP/js/jquery-1.11.1.min.js"></script>
        <script src="../LandingPageMP/js/owl.carousel.min.js"></script>
        <script src="../LandingPageMP/js/bootstrap.min.js"></script>
        <script src="../LandingPageMP/js/wow.min.js"></script>
        <script src="../LandingPageMP/js/typewriter.js"></script>
        <script src="../LandingPageMP/js/jquery.onepagenav.js"></script>
        <script src="../LandingPageMP/js/main.js"></script>
    </body>

</html>
