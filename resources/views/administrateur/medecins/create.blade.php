@extends('layouat.layoutAdmin')
@section('contenu')

<form method="POST" action="{{url('administrateur/medecins/store')}}"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouveau médecin</div>
        </div>
        <div class="card-body row">
            <div class="col-2 col-lg-12">
                <label for="sexe"><b>Sexe:</b></label>
                <select class="form-control" name="sexe" id="sexe">
                    @foreach ($Sexes as $s)
                    <option value="{{$s->id}}">{{$s->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5">
                <label for="prenom"><b>Prénom:</b></label>
                <input class="form-control" name="prenom" type="text" id="d" value="{{old('prenom')}}">
            </div>
            <div class="col-5">
                <label for="nom"><b>Nom:</b></label>
                <input class="form-control" name="nom" type="text" id="d" value="{{old('nom')}}">
            </div>
            <div class="col-6">
                <label for="specialite"><b>Spécialité:</b></label>
                <select class="form-control" name="specialite" id="specialite">
                    @foreach ($Specialites as $spe)
                    <option value="{{$spe->id}}">{{$spe->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="organisme"><b>Organisme:</b></label>
                <select class="form-control" name="organisme" id="organisme">
                    @foreach ($Organismes as $org)
                    <option value="{{$org->id}}">{{$org->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="form-group"><label for="tel"><b>Tel: </b></label>
                    <input class="form-control" name="tel" id="tel" type="number" value="{{old('tel' ?? null)}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email"><b>E-mail:</b></label>
                    <input class="form-control" name="email" id="email" type="text" value="{{old('email' ?? null)}}">
                </div>
            </div>
            <div class="col-4">
                <label for="pays"><b>pays:</b></label>
                <select id="pays" name="pays" class="form-control" required>
                    <option value="">Sélectionnez votre pays</option>
                    @foreach($Countries as $key=>$country)
                    <option value="{{$country->code}}">{{$country->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="title"><b>ville:</b></label>
                    <select name="state" id="state" class="form-control" required> </select>
                </div>
            </div>
            <div class="col-4">
                <label for="cp"><b>Code postal:</b></label>
                <input type="number" class="form-control" id="cp" name="cp" value="{{old('cp')}}">
            </div>
            <div class="col-12">
                <label for="rue"><b>Rue:</b></label>
                <input type="text" class="form-control" id="rue" name="rue" value="{{old('rue')}}">
            </div>
            <div class="col-6">
                <label for="login">Login:</label>
                <input type="text" class="form-control" id="login" name="login" value="{{old('login')}}"><br>
            </div>
            <div class="col-6">
                <label for="password">Password:</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i data-feather="eye" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i>
                Enregistrer nouveau médecin
            </button>
        </div>
    </div>
</form>
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
                        $("#state").empty();
                        $("#state").append('<option value="">Selectionnez votre ville</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });
</script>
<script>
    function togglePasswordVisibility() {
    var password = document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";
        document.querySelector(".fa-eye-slash").classList.add("fa-eye");
        document.querySelector(".fa-eye-slash").classList.remove("fa-eye-slash");
    } else {
        password.type = "password";
        document.querySelector(".fa-eye").classList.add("fa-eye-slash");
        document.querySelector(".fa-eye").classList.remove("fa-eye");
    }
}
</script>
@endsection