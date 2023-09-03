<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dossier médical partagé, bienvenue</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style1.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat-list.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
</head>
<body>
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:dmp@newimaging.tn">dmp@newimaging.tn</a>
        <i class="bi bi-phone"></i> +1 5589 55488 55
       
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
       
        <a href="#" class="twitter"><i class="bi bi-twitter" style="color: #7367f0;"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook" style="color: #7367f0;"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram" style="color: #7367f0;"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin" style="color: #7367f0;"></i></i></a>
      </div>
    </div>
  </div>
  <section id="hero" class="d-flex align-items-center">
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <form class="auth-login-form mt-2" method="POST" action="{{ url('loginMedecin')}}"> {{csrf_field()}}
                    <h4 class="card-title mb-1">Bienvenue à DMP!! 👋</h4>
                    <p class="card-text mb-2">Veuillez vous connecter à votre compte médecin.</p>
                    <div class="form-group">
                        <label class="form-label" for="login-email">Login</label>
                        <input class="form-control" id="login" type="text" name="login" placeholder="Login" autofocus="" tabindex="1" />
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="login-password">Password</label><a href="{{url('/motdepasseoubliemedecin')}}"><small>Mot de passe oublié?</small></a>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="pwd" type="password" name="pwd" placeholder="············" aria-describedby="login-password" tabindex="2" />
                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                            <label class="custom-control-label" for="remember-me"> Remember Me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                </form>
                <p class="text-center mt-2"><span>Nouveau sur notre plateforme?</span><a href="{{url('/registreMedecin')}}"><span>&nbsp;Créer un compte</span></a></p>
            </div>
        </div>
  </section>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main1.js"></script>
</body>
</html>