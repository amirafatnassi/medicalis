@extends('menus.layoutCoordinateurChef')
@section('contenu')

<form method="post" action="{{url('coordinateurChef/dossiers/store')}}" enctype="multipart/form-data"> @csrf
    <div class="row">
        <div class="col-4">
            <label for="nom"><b>Nom:</b></label>
            <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom')}}" required>
        </div>
        <div class="col-4">
            <label for="prenom"><b>Prénom:</b></label>
            <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom')}}" required>
        </div>
        <div class="col-4">
            <label for="sexe"><b>Sexe:</b></label>
            <select class="form-control" name="sexe" id="" required>
                @foreach ($sexes as $sexe)
                <option value="{{$sexe->id}}">{{$sexe->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="profession"><b>Profession:</b></label>
            <select class="form-control" name="profession" id="profession">
                <option value="">sélectionnez profession</option>
                @foreach ($liste_professions as $list_prof)
                <option value="{{$list_prof->id}}">{{$list_prof->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="convention"><b>Convention:</b></label>
            <select class="form-control" name="convention" id="convention">
                <option value="">sélectionnez votre convention</option>
                @foreach ($liste_conventions as $convention)
                <option value="{{$convention->id}}">{{$convention->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="datenaissance"><b>Date de naissance:</b></label>
            <input class="form-control" name="datenaissance" id="datenaissance" type="date" value="{{old('datenaissance')}}" required>
        </div>
        <div class="col-6">
            <label for="lieunaissance"><b>Lieu de naissance:</b></label>
            <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance')}}">
        </div>
        <div class="col-6">
            <label for="tel"><b>Tel:</b></label>
            <input class="form-control" name="tel" id="tel" type="number" value="{{old('tel')}}">
        </div>
        <div class="col-6">
            <label for="email"><b>E-mail:</b></label>
            <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}" required>
        </div>
        <div class="col-6">
            <label for="image"><b>Image:</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="col-6">
            <label for="contactdurgence"><b>Contact d'urgence:</b></label>
            <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence')}}">
        </div>
        <div class="col-4">
            <label for="pays"><b>pays:</b></label>
            <select id="pays" name="pays" class="form-control" required>
                <option value="">Sélectionnez votre pays</option>
                @foreach($liste_countries as $key=>$country)
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
        <div class="col-4">
            <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
            <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                <option value="">sélectionnez votre groupe sanguin</option>
                @foreach ($liste_groupesanguins as $liste_gsang)
                <option value="{{$liste_gsang->id}}"> {{$liste_gsang->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="taille"><b>Taille:</b></label>
            <input class="form-control" name="taille" id="taille" type="text" placeholder="170cm" value="{{old('taille')}}">
        </div>
        <div class="col-4">
            <label for="poids"><b>Poids:</b></label>
            <input class="form-control" name="poids" id="poids" type="text" placeholder="70kg" value="{{old('poids')}}">
        </div>
        <div class="col-12">
            <label for="antecedants_med"><b>Antécédants medicaux:</b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_med" id="antecedants_med" type="text">{{old('antecedants_me')}}</textarea>
        </div>
        <div class="col-12">
            <label for="antecedants_chirg"><b>Antécédants chirurgicaux: </b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_chirg" id="antecedants_chirg" type="text">{{old('antecedants_chirg')}}</textarea>
        </div>
        <div class="col-12">
            <label for="antecedants_fam"><b>Antécédants familials:</b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_fam" id="antecedants_fam" type="text">{{old('antecedants_fam')}}</textarea>
        </div>
        <div class="col-12">
            <label for="allergies"><b>Allergies: </b></label>
            <textarea class="CKEDITOR form-control" name="allergies" id="allergies" type="text">{{old('allergies')}}</textarea>
        </div>
        <div class="col-12">
            <label for="indicateur_bio"><b>Indicateurs biologiques:</b></label>
            <textarea class="CKEDITOR form-control" name="indicateur_bio" id="indicateur_bio" type="text">{{old('indicateur_bio')}}</textarea>
        </div>
        <div class="col-12">
            <label for="traitement_chr"><b>Traitements chroniques:</b></label>
            <textarea class="CKEDITOR form-control" name="traitement_chr" id="traitement_chr" type="text">{{old('traitement_chr')}}</textarea>
        </div>
        <div class="col-12">
            <label for="fileup"><b>Compléments d'informations:</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="fileup" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class=" d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save"></i>Enregistrer</button>
        </div>
    </div>
</form>
</body>
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
    CKEDITOR.replace('antecedants_med');
    CKEDITOR.replace('antecedants_chirg');
    CKEDITOR.replace('antecedants_fam');
    CKEDITOR.replace('allergies');
    CKEDITOR.replace('indicateur_bio');
    CKEDITOR.replace('traitement_chr');
</script>

@endsection