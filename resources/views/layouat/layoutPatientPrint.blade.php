<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dossier Medical Partagé</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/dmp_logo.ico')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
</head>

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
  <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        <li class="nav-item"><a class="navbar-brand" href="{{url('/patient')}}"><span class="brand-logo">
            </span>
            <h2 class="brand-text mb-0">Dossier Medical partagé</h2>
          </a></li>
      </ul>
    </div>
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none">
              <span class="user-name font-weight-bolder"> {{Auth()->user()->nom}} {{Auth()->user()->prenom}}</span>
              <span class="user-status"></span>
            </div>
            <span class="avatar">
              <img class="round" src="{{asset('uploads/dossier/'. Auth()->user()->image)}}" alt="avatar" height="40" width="40">
              <span class="avatar-status-online"></span>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{url('/patient/profile')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('/deconnexionPatient')}}"><i class="mr-50" data-feather="power"></i>
              Déconnexion
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
      <div class="shadow-bottom"></div>
      <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="active" class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/patient')}}" data-toggle="dropdown"><i data-feather="home"></i><span data-i18n="Dashboards">Dashboards</span></a>
          </li>

          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/patient/mondossier')}}" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-medical" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
              </svg>Mon dossier médical</span></a>
            <ul class="dropdown-menu">
              <li class="active" data-menu="">
                <a class="dropdown-item d-flex align-items-center" href="{{url('/patient/mondossier')}}" data-toggle="dropdown" data-i18n="Email">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-medical" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                  </svg>
                  Mon dossier médical
                </a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/consultations/index')}}" data-toggle="dropdown" data-i18n="Chat"><i data-feather="clipboard"></i><span data-i18n="Chat">Consultations</span></a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/examenbios/index')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="clipboard"></i><span data-i18n="Todo">Examens bio</span></a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/examenradios/index')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="clipboard"></i><span data-i18n="Todo">Examens radio</span></a>
              </li>
            </ul>
          </li>
          <li class="active" class="nav navbar-nav"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/patient/mesmedecins')}}"><i data-feather="user"></i><span data-i18n="Pages">Mes Médecins</span></a> </li>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="mail"></i><span data-i18n="Email">Courriers</span></a>
            <ul class="dropdown-menu">
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/discussions/forum')}}" data-toggle="dropdown" data-i18n="Email"><i data-feather="mail"></i><span data-i18n="Email">Tout</span></a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/discussions/create')}}" data-toggle="dropdown" data-i18n="Chat"><i data-feather="message-square"></i><span data-i18n="Chat">Nouvelle Discussion</span></a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/discussions/recu')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="inbox"></i><span data-i18n="Todo">Reçu</span></a>
              </li>
              <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/patient/discussions/envoye')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="send"></i><span data-i18n="Todo">Envoyé</span></a>
              </li>
            </ul>
          </li>
          <li class="active" class="nav navbar-nav"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/patient/tousmedecins')}}"><i data-feather="user"></i><span data-i18n="user">Les medecins sur le platforme</span></a> </li>
          <li class="active" class="nav navbar-nav"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/patient/about')}}"><i data-feather="info"></i><span data-i18n="UI Elements">A propos</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  @yield('contenu')
  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>
  <footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="" target="_blank">LGR Group</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
  </footer>
  <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
  <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
  <script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
  <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
  <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.j')}}s"></script>
  <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
  <script src="{{asset('app-assets/js/core/app.js')}}"></script>
  <script>
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })
  </script>
</body>

</html>