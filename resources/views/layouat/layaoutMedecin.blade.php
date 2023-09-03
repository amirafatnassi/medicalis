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
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat-list.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('app-assets/css/fontawesome.min.css') }}">
</head>

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{url('/medecin')}}">
                        <span class="brand-logo"></span>
                        <h2 class="brand-text mb-0">Dossier Medical partagé</h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{Auth::user()->prenom}} {{Auth::user()->nom}}
                                <span class="user-status"></span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{asset('uploads/users/'.Auth::user()->image)}}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{url('/medecin/profile')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{url('/logout')}}">
                            <i class="mr-50" data-feather="power"></i>Déconnexion
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/horizontal-menu-template/index.html"><span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                                <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>
                            <h2 class="brand-text mb-0">Vuexy</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="active" class="dropdown nav-item" data-menu="dropdown"><a href="{{url('/medecin')}}"><i data-feather="home"></i><span data-i18n="Dashboards">Dashboards</span></a>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a href="{{url('/medecin/')}}"><i data-feather="package"></i><span data-i18n="Apps">Mes Patients</span></a>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/medecin/forum')}}" data-toggle="dropdown"><i data-feather="mail"></i><span data-i18n="UI Elements">Courrier Medecin</span></a>
                        <ul class="dropdown-menu">
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forum')}}" data-toggle="dropdown" data-i18n="Email"><i data-feather="mail"></i><span data-i18n="Email">Tout</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forum/create')}}" data-toggle="dropdown" data-i18n="Chat"><i data-feather="message-square"></i><span data-i18n="Chat">Nouvelle Discussion</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forum/recu')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="inbox"></i><span data-i18n="Todo">Recu</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forum/envoye')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="send"></i><span data-i18n="Todo">Envoyé</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('/medecin/forumMedPatient')}}" data-toggle="dropdown"><i data-feather="mail"></i><span data-i18n="UI Elements">Courrier Patient</span></a>
                        <ul class="dropdown-menu">
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forumMedPatient')}}" data-toggle="dropdown" data-i18n="Email"><i data-feather="mail"></i><span data-i18n="Email">Tout</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forumMedPatient/create')}}" data-toggle="dropdown" data-i18n="Chat"><i data-feather="message-square"></i><span data-i18n="Chat">Nouvelle Discussion</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forumMedPatient/recu')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="inbox"></i><span data-i18n="Todo">Recu</span></a>
                            </li>
                            <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/medecin/forumMedPatient/envoye')}}" data-toggle="dropdown" data-i18n="Todo"><i data-feather="send"></i><span data-i18n="Todo">Envoyé</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="active" class="nav navbar-nav">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{url('medecin/demandeDevis/index')}}">Demandes de devis</a>
                    </li>
                    <li class="active" class="nav navbar-nav"><a href="{{url('/medecin/lesmedecins')}}"><i data-feather="file-text"></i><span data-i18n="Pages">Tous les Medecins</span></a></li>
                    <li class="active" class="nav navbar-nav"><a href="{{url('/about')}}"><i data-feather="file-text"></i><span data-i18n="Pages">A Propos</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="app-content">
        <section id="dashboard-ecommerce">
            @yield('contenu')

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
            <script src="{{asset('app-assets/js/scripts/pages/app-chat.js')}}"></script>
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
        </section>
    </div>
</body>

</html>