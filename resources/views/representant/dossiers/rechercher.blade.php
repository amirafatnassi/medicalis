@extends('menus.layoutRepresentant')
@section('contenu')

<form method="post" action="{{url('representant/dossiers/rechercher')}}" enctype="multipart/form-data"> @csrf
    <div class="row">
        <div class="col-4">
            <label for="prenom"><b>N° Dossier:</b></label>
            <input class="form-control" name="dossier" id="prenom" type="text" value="{{old('prenom')}}" >
        </div>
        <div class="col-4">
            <label for="nom"><b>Nom:</b></label>
            <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom')}}" >
        </div>
        <div class="col-4">
            <label for="prenom"><b>Prénom:</b></label>
            <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom')}}" >
        </div>
        <div class="col-6">
            <label for="datenaissance"><b>Date de naissance:</b></label>
            <input class="form-control" name="datenaissance" id="datenaissance" type="date" value="{{old('datenaissance')}}" >
        </div>
        <div class="col-6">
            <label for="lieunaissance"><b>Lieu de naissance:</b></label>
            <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance')}}">
        </div>
        <div class="col-6">
            <label for="email"><b>E-mail:</b></label>
            <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}" >
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="pays"><b>pays:</b></label>
            <select id="pays" name="pays" class="form-control" >
                <option value="">Sélectionnez votre pays</option>
                @foreach($Countries as $key=>$country)
                <option value="{{$country->code}}">{{$country->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="title"><b>ville:</b></label>
                <select name="state" id="state" class="form-control" > </select>
            </div>
        </div>
        
        <div class=" d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="search"></i>Rechercher</button>
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