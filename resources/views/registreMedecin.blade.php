<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dossier Medical Partagé</title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>

<body class="horizontal-layout horizontal-menu  navbar-floating" data-menu="horizontal-menu" data-col="">
    <div class="app-content">
        <section id="basic-vertical-layouts">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            Créer un compte médecin traitant
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" action=" {{url('EnregistrerMedecin')}}" method="post">{{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12  col-lg-2 col-xl-2">
                                        <label for="sexe">Sexe</label>
                                        <div class="input-group input-group-merge">
                                            <select name="sexe" id="sexe" class="form-control" required>
                                                <option value="" selected>Choisir sexe</option>
                                                @foreach($Sexes as $sexe)
                                                <option value="{{$sexe->id}}">{{$sexe->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                        <label for="nom">Nom</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control" required />
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                        <label for="prenom">Prénom</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="prenom" class="form-control" name="prenom" placeholder="Prénom" required />
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="organisme">Organisme</label>
                                        <div class="input-group input-group-merge">
                                            <select name="organisme" id="organisme" class="form-control">
                                                @foreach($Organismes as $liste_organisme)
                                                <option value="{{ $liste_organisme->id }}">{{ $liste_organisme->lib }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="first-name-icon">Specialité</label>
                                        <div class="input-group input-group-merge">
                                            <select name="specialite" id="specialite" class="form-control" required>
                                                @foreach($Specialites as $liste_Specialite)
                                                <option value="{{ $liste_Specialite->id }}">{{ $liste_Specialite->lib }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                        <label for="country">Pays</label>
                                        <div class="input-group input-group-merge">
                                            <select name="country" id="country" class="form-control" required>
                                                <option selected>Choisir un pays</option>
                                                @foreach($Countries as $country)
                                                <option value="{{$country->code}}"> {{$country->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                        <label for="ville">Ville</label>
                                        <div class="input-group input-group-merge">
                                            <select name="ville" id="ville" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                        <label for="cp">CP</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="cp" class="form-control" name="cp" placeholder="1000" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                        <label for="rue">Rue</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="rue" class="form-control" name="rue" placeholder="appartment n° rue cité" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="email">Email</label>
                                        <div class="input-group input-group-merge">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="exemple@€mail.com" required />
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="tel">Mobile</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" id="tel" class="form-control" name="tel" placeholder="123456789" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="url_pacs">URL PACS</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="url_pacs" class="form-control" name="url_pacs" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="url_bio">URL BIO</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="url_bio" class="form-control" name="url_bio" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="first-name-icon">N° CNOM</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="first-name-icon" class="form-control" name="ncom" placeholder="123456789" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="password-icon">login</label>
                                        <div class="input-group input-group-merge">
                                            <input type="texte" id="password-icon" class="form-control" name="login" placeholder="login" required />
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                        <label for="password-icon">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password-icon" class="form-control" name="pwd" required />
                                        </div>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            champ obligatoire
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                        <button type="submit" class="btn btn-primary mr-1"><i data-feather="send"></i>Envoyer</button>
                                        <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </section>
    </div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <script type="text/javascript">
        $('#country').change(function() {
            var countryID = $(this).val();

            console.log(countryID);
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-ville-medecin')}}?country_id=" + countryID,
                    success: function(res) {
                        if (res) {
                            $("#ville").empty();
                            $("#ville").append('<option>Select</option>');
                            $.each(res, function(key, value) {
                                $("#ville").append('<option value="' + key + '">' + value + '</option>');
                            });
                        } else {
                            $("#ville").empty();
                        }
                    }
                });
            }

        });
    </script>
</body> 
</html>