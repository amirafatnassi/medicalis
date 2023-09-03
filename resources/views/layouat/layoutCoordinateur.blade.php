<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dossier Medical Partagé</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/dmp_logo.ico')}}">

    <!-- Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.min.css')}}">

    <!-- Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">

    <!-- Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">

    <!-- Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <!--editeur de texte-->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <!-- choose multiple destinatires demande devis form -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="navbar-brand" href="{{url('/coordinateur/dashboard')}}">
                        <span class="brand-logo"></span>
                        <h2 class="brand-text mb-0">Dossier Medical partagé</h2>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item">
                        <a class="nav-link menu-toggle" href="javascript:void(0);">
                            <i class="ficon" data-feather="menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{auth()->user()->unreadNotifications->count()}}</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="badge badge-pill badge-light-primary">{{auth::user()->unreadNotifications->count()}}</div>
                                <h5></h5>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                                @foreach(auth::user()->unreadNotifications as $notification)
                                <a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder"> {{ $notification->data['message'] }}</span>&nbsp;
                                                {{ $notification->created_at->format('d/m/Y H:m')  }}
                                            </p>
                                            <div class="row">
                                                @if($notification->type==="App\Notifications\NewDemandeConsNotification")
                                                <form method="POST" action="{{url('coordinateur/prendre-en-charge/'.$notification->id.'/'.$notification->data['demande'])}}" enctype="multipart/form-data"> {{csrf_field()}}
                                                    <button class="btn btn-link" type="submit">
                                                        <i data-feather="check"></i>
                                                    </button>
                                                </form>
                                                <a class="btn btn-link" type="submit" href="{{url('coordinateur/demandeCons/demande/'.$notification->data['demande'])}}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                @endif

                                                <form method="POST" action="{{url('coordinateur/mark-as-read/'.$notification->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                                                    <button class="btn btn-link" type="submit">
                                                        <i data-feather="bell-off"></i>
                                                    </button>
                                                </form>
                                                @if($notification->type==="App\Notifications\RepDemandeInfosNotification")
                                                <a class="btn btn-link" type="submit" href="{{url('coordinateur/demandeCons/consulter/'.$notification->data['demande_infos'].'/'.$notification->id)}}">
                                                    <i data-feather="eye"></i>
                                                    Consulter
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{url('coordinateur/dashboard')}}">Lire toutes les notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder"> {{Auth::user()->prenom}} {{Auth::user()->nom}}</span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{asset('uploads/users/'. (Auth::user()->image??'user.png'))}}" alt="avatar" height="40" width="40">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{url('coordinateur/myProfil')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('/logout')}}"><i class="mr-50" data-feather="power"></i>
                            Déconnexion
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/dossiers/index')}}">Mes dossiers</a>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/medecins/index')}}">Médecins</a>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/representants/index')}}"><i data-feather="user"></i> Mes représentants</a>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/coordinateurChef/show')}}"><i data-feather="users"></i> Mon superviseur</a>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/discussionsCoordPatient')}}" data-toggle="dropdown"><i data-feather="mail"></i><span data-i18n="UI Elements">Courrier Patient</span></a>
                        <ul class="dropdown-menu">
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('coordinateur/discussionsCoordPatient')}}" data-toggle="dropdown" data-i18n="Email"><i data-feather="mail"></i><span data-i18n="Email">Tout</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('coordinateur/discussionsCoordPatient/create')}}" data-toggle="dropdown" data-i18n="Chat"><i data-feather="message-square"></i><span data-i18n="Chat">Nouvelle Discussion</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('coordinateur/discussionsCoordPatient/recu')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="inbox"></i><span data-i18n="Todo">Recu</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('coordinateur/discussionsCoordPatient/envoye')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="send"></i><span data-i18n="Todo">Envoyé</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('coordinateur/demandeCons/index')}}">
                            Demandes de consultations <span class="sr-only">9</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce">

                    @yield('contenu')

                    <div class="sidenav-overlay"></div>
                    <div class="drag-target"></div>

                    <!-- Footer-->
                    <footer class="footer footer-static footer-light">
                        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="" target="_blank">LGR Group</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
                    </footer>
                    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

                    <!--  Vendor JS-->
                    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>

                    <!-- Page Vendor JS-->
                    <script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
                    <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
                    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.j')}}s"></script>

                    <!--  Theme JS-->
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