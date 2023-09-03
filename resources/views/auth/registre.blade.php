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

<body class="horizontal-layout  navbar-floating">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-10">
                <form class="form form-vertical" action=" {{url('enregistrer')}}" method="post"> @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Créer un nouveau compte</div>
                        </div>
                        <div class="card-body row">
                            @if ($errors->any())
                            <div class="alert alert-danger col-12">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-sm-12 col-md-12  col-lg-2 col-xl-2">
                                <label for="sexe">Sexe</label>
                                <div class="input-group input-group-merge">
                                    <select name="sexe_id" id="sexe_id" class="form-control" required>
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
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="datenaissance">Date de naissance</label>
                                <input type="date" id="datenaissance" class="form-control" required name="datenaissance" placeholder="01/01/1960" />
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="lieunaissance">Lieu de naissance</label>
                                <input type="texte" id="lieunaissance" class="form-control" name="lieunaissance" placeholder="lieu de naissance" />
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="role_id">Role</label>
                                <div class="input-group input-group-merge">
                                    <select name="role_id" id="role_id" class="form-control">
                                        @foreach($Roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" id="professionDiv" style="display: none;">
                                <label for="profession">Profession</label>
                                <div class="input-group input-group-merge">
                                    <select name="professionid" id="professionid" class="form-control">
                                        @foreach($Professions as $profession)
                                        <option value="{{ $profession->id }}">{{ $profession->lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" id="organismeDiv" style="display: none;">
                                <label for="organisme">Organisme</label>
                                <div class="input-group input-group-merge">
                                    <select name="organisme_id" id="organisme_id" class="form-control">
                                        @foreach($Organismes as $liste_organisme)
                                        <option value="{{ $liste_organisme->id }}">{{ $liste_organisme->lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" id="specialiteDiv" style="display: none;">
                                <label for="specialite">Specialité</label>
                                <div class="input-group input-group-merge">
                                    <select name="specialite_id" id="specialite_id" class="form-control" required>
                                        @foreach($Specialites as $liste_Specialite)
                                        <option value="{{ $liste_Specialite->id }}">{{ $liste_Specialite->lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Champ obligatoire
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                <label for="pays">pays:</label>
                                <select id="pays" name="pays" class="form-control">
                                    <option selected>Choisir un pays</option>
                                    @foreach($Countries as $key=>$country)
                                    <option value="{{$country->code}}">{{$country->lib}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" style="width: 100%;">
                                    champ obligatoire
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                <label for="ville">Ville</label>
                                <select name="ville" id="ville" class="form-control">
                                    <option value="">Choisir une ville</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3">
                                <label for="cp">CP</label>
                                <div class="input-group input-group-merge">
                                    <input type="number" id="cp" class="form-control" name="cp" placeholder="1000" />
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
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" id="urlPacsDiv" style="display: none;">
                                <label for="url_pacs">URL PACS</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="url_pacs" class="form-control" name="url_pacs" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" id="urlBioDiv" style="display: none;">
                                <label for="url_bio">URL BIO</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="url_bio" class="form-control" name="url_bio" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">
                                <label for="password-icon">Password</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback" style="width: 100%;">
                                    champ obligatoire
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="confirm-password">Confirmer le mot de passe</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="confirm-password" type="password" name="confirm-password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Veuillez confirmer votre mot de passe
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-1"><i data-feather="send"></i>Envoyer</button>
                            <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
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

    <script type="text/javascript">
        $('#pays').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-ville-list')}}?pays=" + countryID,
                    success: function(res) {
                        if (res) {
                            $("#ville").empty();
                            $("#ville").append('<option value="">Select</option>');
                            $.each(res, function(key, value) {
                                $("#ville").append('<option value="' + key + '">' + value + '</option>');
                            });
                        } else {
                            $("#ville").empty();
                        }
                    }
                });
            } else {
                $("#ville").empty();
            }
        });
    </script>

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

    <script>
        // JavaScript to toggle visibility based on selected role
        const roleSelect = document.getElementById('role_id');
        const specialiteSelect = document.getElementById('specialite_id');
        const professionDiv = document.getElementById('professionDiv');
        const organismeDiv = document.getElementById('organismeDiv');
        const urlPacsDiv = document.getElementById('urlPacsDiv');
        const urlBioDiv = document.getElementById('urlBioDiv');
        const specialiteDiv = document.getElementById('specialiteDiv');

        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;
            professionDiv.style.display = selectedRole === '2' ? 'block' : 'none';
            organismeDiv.style.display = selectedRole === '3' ? 'block' : 'none';
            specialiteDiv.style.display = selectedRole === '3' ? 'block' : 'none';
        });

        specialiteSelect.addEventListener('change', function() {
            const selectedSpecialite = this.value;
            const showUrlPacsDiv = ['41', '42', '43', '44', '45', '46', '49'].includes(selectedSpecialite);
            const showUrlBioDiv = selectedSpecialite === '21';

            urlPacsDiv.style.display = showUrlPacsDiv ? 'block' : 'none';
            urlBioDiv.style.display = showUrlBioDiv ? 'block' : 'none';
        });
    </script>


</body>

</html>