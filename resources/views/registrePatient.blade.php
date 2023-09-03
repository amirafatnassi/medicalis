<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dossier médical partagé, bienvenue</title>
    <link href="assets/css/style1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope"></i> <a href="mailto:dmp@newimaging.tn">dmp@newimaging.tn</a>
                <i class="bi bi-phone"></i> +1 5589 55488 55
            </div>
            <div class="d-none d-lg-flex social-links align-items-center">
                <a href="#"><i data-feather="twitter" style="color: #7367f0;"></i></a>
                <a href="#"><i data-feather="facebook" style="color: #7367f0;"></i></a>
                <a href="#"><i data-feather="instagram" style="color: #7367f0;"></i></a>
                <a href="#"><i data-feather="linkedin" style="color: #7367f0;"></i></a>
            </div>
        </div>
    </div>

    <section id="hero" class="d-flex align-items-center">
        <div class="d-flex col-lg-8 align-items-center auth-bg px-2 p-lg-5">
            <form class="form form-vertical" action=" {{url('EnregistrerPatient')}}" method="post">{{csrf_field()}}
                <div class="card-title">Créer un compte patient</div>
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
                    <div class="col-2">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe" class="form-control" required>
                            <option value="" selected>Choisir sexe</option>
                            @foreach($Sexes as $sexe)
                            <option value="{{$sexe->id}}">{{$sexe->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control" required>
                    </div>
                    <div class="col-5">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" class="form-control" required name="prenom" placeholder="Prénom" />
                    </div>
                    <div class="col-4">
                        <label for="taille">Taille</label>
                        <input type="number" id="taille" class="form-control" name="taille" placeholder="175" />
                    </div>
                    <div class="col-4">
                        <label for="poids">Poids</label>
                        <input type="number" id="poids" class="form-control" name="poids" placeholder="75" />
                    </div>
                    <div class="col-4">
                        <label for="groupe-sanguin">Groupe Sanguin</label>
                        <select name="groupe_sanguin" id="groupe_sanguin" class="form-control">
                            @foreach($Bloodtypes as $list_btype)
                            <option value="{{$list_btype->id}}">{{$list_btype->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="country">Pays</label>
                        <select name="country" id="country" class="form-control" required>
                            <option value="" selected>Choisir un pays</option>
                            @foreach($Countries as $country)
                            <option value="{{$country->code}}"> {{$country->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="ville">Ville</label>
                        <select name="ville" id="ville" class="form-control" value="" required></select>
                    </div>
                    <div class="col-2">
                        <label for="cp">Code Postal</label>
                        <input type="number" id="cp" class="form-control" name="cp" placeholder="1000" />
                    </div>
                    <div class="col-5">
                        <label for="rue">Rue</label>
                        <input type="texte" id="rue" class="form-control" name="rue" placeholder="appartment n°1 rue cité " />
                    </div>
                    <div class="col-4">
                        <label for="datenaissance">Date de naissance</label>
                        <input type="date" id="datenaissance" class="form-control" required name="datenaissance" placeholder="01/01/1960" />
                    </div>
                    <div class="col-4">
                        <label for="lieunaissance">Lieu de naissance</label>
                        <input type="texte" id="lieunaissance" class="form-control" name="lieunaissance" placeholder="lieu de naissance" />
                    </div>
                    <div class="col-4">
                        <label for="nss">N° Sécurité Social</label>
                        <input type="number" id="nss" class="form-control" name="nss" placeholder="12132313131313" />
                    </div>
                    <div class="col-4">
                        <label for="profession">Profession</label>
                        <select name="profession" id="profession" class="form-control">
                            @foreach($Professions as $liste_prof)
                            <option value="{{$liste_prof->id}}">{{$liste_prof->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="email-id-icon">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="exemple@email.com" required />
                    </div>
                    <div class="col-4">
                        <label for="contact-info-icon">Mobile</label>
                        <input type="number" id="tel" class="form-control" required name="tel" placeholder="123456789" />
                    </div>
                    <div class="col-4">
                        <label for="login">login</label>
                        <input type="texte" id="login" class="form-control" required name="login" placeholder="login" />
                    </div>
                    <div class="col-4">
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="password" />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer toggle-password" toggle="#password"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="password_confirmation" type="password" name="password_confirmation" placeholder="password" />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer toggle-password" toggle="#password_confirmation"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm"><i data-feather="send"></i> Envoyer</button>
                    <button type="reset" class="btn btn-outline-primary btn-sm"><i data-feather="refresh-cw"></i> Réinitialiser</button>
                </div>
            </form>
        </div>
    </section>
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="assets/js/main1.js"></script>
    <script type="text/javascript">
        $('#country').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-ville-medecin')}}?country_id=" + countryID,
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
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            feather.replace();
            $('.toggle-password').click(function() {
                $(this).toggleClass('fa-eye fa-eye-slash');
                var input = $($(this).attr('toggle'));
                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
            $('.toggle-passwordConfirmation').click(function() {
                $(this).toggleClass('fa-eye fa-eye-slash');
                var input = $($(this).attr('toggle'));
                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });

            const checkPassword = () => {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity("Passwords don't match");
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            };

            password.addEventListener('change', checkPassword);
            passwordConfirmation.addEventListener('keyup', checkPassword);
        });
    </script>
</body>

</html>