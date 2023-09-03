<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dossier médical partagé, bienvenue</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style1.css') }}" rel="stylesheet">


    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat-list.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope"></i> <a href="mailto:dmp@newimaging.tn">dmp@newimaging.tn</a>

            </div>
            <div class="d-none d-lg-flex social-links align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter" style="color: #7367f0;"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook" style="color: #7367f0;"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram" style="color: #7367f0;"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin" style="color: #7367f0;"></i></i></a>
            </div>
        </div>
    </div>

    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">Medicalys</a></h1>
            <a href="index.html" class="logo me-auto"><img src="{{ asset('assets/img/logo.png')}}" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
                    <li><a class="nav-link scrollto" href="#about">A propos</a></li>
                    <li><a class="nav-link scrollto" href="#counts">Statistiques</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#faq">Questions fréquentes</a></li>
                    <li><a class="nav-link scrollto" href="#partners">Nos partenaires</a></li>
                    <li><a class="nav-link scrollto" href="#footer">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>
        </div>
    </header>
    <section id="hero" class="d-flex align-items-center mt-2">
        <div class="container">
            <h1>Bienvenue à DMP</h1>
            <a href="{{ url('/login')}}" class="btn btn-primary rounded-pill">Login</a>
        </div>
    </section>
    <main id="main">
        <section id="why-us" class="why-us">
            <div class="container">
                <h4 class="alert-heading">Vérification d'Email Réussie!</h4>
                <p>Votre email a été vérifié avec succès !</p>
                <p>Votre compte est en attente de confirmation manuelle. Un email vous sera envoyé une fois que votre compte aura été confirmé.</p>
                <p>Après confirmation, vous pourrez vous connecter à notre plateforme en utilisant vos identifiants.</p>
            </div>
        </section>
    </main>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>DMP</h3>
                        <p>
                            avenue ... <br>
                            cité ....<br>
                            Tunisie <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> dmp@newimaging.tn<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>LGR 2021</span></strong>. All Rights Reserved
                </div>
            </div> &nbsp; &nbsp;
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter bg-primary"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook bg-primary"><i class="bx bxl-facebook "></i></a>
                <a href="#" class="instagram bg-primary"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus bg-primary"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin bg-primary"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main1.js')}}"></script>
    <script>
        var swiper = new Swiper('.testimonials-slider', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            }
        });
    </script>
</body>

</html>